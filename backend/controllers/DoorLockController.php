<?php

namespace backend\controllers;

use backend\models\KeyAdminSearch;
use backend\models\KeyboardPwdSearch;
use backend\models\KeySearch;
use reception\forms\DoorLockInstallForm;
use reception\repositories\Apartment\ApartmentRepository;
use reception\repositories\DoorLock\DoorLockRepository;
use reception\useCases\manage\DoorLock\DoorLockManageService;
use Yii;
use reception\entities\DoorLock\DoorLock;
use backend\models\DoorLockSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * DoorLockController implements the CRUD actions for DoorLock model.
 */
class DoorLockController extends Controller
{

    private $doorLock;
    private $service;
    private $apartmentRepository;

    public function __construct($id, $module, DoorLockManageService $service, DoorLockRepository $doorLock, ApartmentRepository $apartmentRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->doorLock = $doorLock;
        $this->service = $service;
        $this->apartmentRepository = $apartmentRepository;

    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete','index','install','view'],
            'rules' => [
                [
                    'allow' => true,
                    'actions'=>['index','update','delete','create','view', 'install'],
                    'roles' => ['admin', 'mobile','owner','worker'],
                ],
            ],
        ];
        return $behaviors;
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
    }

    /**
     * Lists all DoorLock models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can("admin")) {
            $searchModel = new DoorLockSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else {
            $searchModel = new DoorLockSearch(['user'=>Yii::$app->getUser()->getId()]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DoorLock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $doorlock = $this->findModel($id);
        $userId = Yii::$app->getUser()->getId();

        $user = Yii::$app->user->identity->getUserModel();
        $parentsIDs = (isset($user->parentUsers))?ArrayHelper::getColumn ($user->parentUsers, 'id'):[];

        if (Yii::$app->user->can("admin")) {
            $keySearchModel = new KeyAdminSearch(['door_lock_id'=>$doorlock->id]);
            $passwordsSearchModel = new KeyboardPwdSearch(['door_lock_id'=>$doorlock->id]);
        }
        elseif  (Yii::$app->user->can("receptionist")) {
            $keySearchModel = new KeyAdminSearch(['userId'=>$userId, 'door_lock_id'=>$doorlock->id,'parents'=>$parentsIDs]);
            $ids=$parentsIDs;
            $ids[]=$user->id;
            $passwordsSearchModel = new KeyboardPwdSearch(['door_lock_id'=>$doorlock->id,'user'=>$ids]);
        }
        elseif (Yii::$app->user->can("owner")){
            $keySearchModel = new KeyAdminSearch(['userId'=>$userId, 'door_lock_id'=>$doorlock->id, 'parents'=>$parentsIDs]);
            $passwordsSearchModel = new KeyboardPwdSearch(['owner'=>$user, 'door_lock_id'=>$doorlock->id,]);
        }
        elseif (Yii::$app->user->can('lock') ){
            $passwordsSearchModel = new KeyboardPwdSearch(['lockUser'=>$user,'door_lock_id'=>$doorlock->id]);
        }
        elseif(Yii::$app->user->can('tourist')){
            $passwordsSearchModel = new KeyboardPwdSearch(['tourist'=>$user,'door_lock_id'=>$doorlock->id]);
        }
       elseif (Yii::$app->user->can('mobile')
            && !Yii::$app->user->can("receptionist")
            && !Yii::$app->user->can("owner")
            && !Yii::$app->user->can("admin")) {
            $keySearchModel = new KeyAdminSearch(['userId'=>$userId, 'door_lock_id'=>$doorlock->id,'parents'=>$parentsIDs]);
            $passwordsSearchModel = new KeyboardPwdSearch(['door_lock_id'=>$doorlock->id, 'user' =>$userId]);
        }

        $keysDataProvider = $keySearchModel->search(Yii::$app->request->queryParams);
        $passwordsDataProvider = $passwordsSearchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $doorlock,
            'keySearch'=>$keySearchModel,
            'passwordSearch'=>$passwordsSearchModel,
            'keysDataProvider'=>$keysDataProvider,
            'passwordsDataProvider'=>$passwordsDataProvider
        ]);
//        }
    }

    /**
     * Creates a new DoorLock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoorLock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    public function actionInstall($id=null)
    {
        $id =($id)?$id: Yii::$app->request->queryParams['lock'];
        $model = new DoorLockInstallForm(['id'=>$id]);
        $doorLock = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
//                $apartments = $this->apartmentRepository->getAllbyIds($model->apartmentId);
//                $result = $this->service->installInApartment($model->id, $apartments, $model->lockAlias, Yii::$app->getUser()->getId());
                $result = $this->service->install($doorLock,$model->apartmentId,$model->lockAlias, Yii::$app->getUser()->getId());
                return  $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('install', [
                'model' => $model,
                'doorLock'=>$doorLock,
                'id'=>$id,
                'user_id'=>Yii::$app->getUser()->getId()
            ]);
    }
    public function actionUninstall($id=null)
    {
        $id =($id)?$id: Yii::$app->request->queryParams['lock'];
        $doorLock = $this->findModel($id);

        $model = new DoorLockInstallForm(['id'=>$id,'lockAlias'=>$doorLock->lock_alias]);

        if ($model->load(Yii::$app->request->post()) && $doorLock->validate()) {
            try {
                $apartmentIds=[];
                foreach ($model->apartmentList as $key=>$value) {
                    if (!$value) $apartmentIds[] =$key;
                }
                $result = $this->service->unsetApartment($doorLock, $apartmentIds, $model->lockAlias, Yii::$app->getUser()->getId());
                return  $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('uninstall', [
            'model' => $model,
            'doorLock'=>$doorLock,
            'apartmentListArray'=> ArrayHelper::map($doorLock->apartments, 'id','name' ),
            'id'=>$id
        ]);
    }

    /**
     * Updates an existing DoorLock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DoorLock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DoorLock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoorLock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \reception\entities\DoorLock\DoorLock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
