<?php

namespace backend\controllers;

use reception\forms\manage\User\UserCreateForm;
use reception\forms\manage\User\UserEditForm;
use reception\forms\MyRent\MyRentUserForm;
use reception\useCases\manage\Booking\SynchroService;
use reception\useCases\manage\MyRent\MyRentManageService;
use reception\useCases\manage\UserManageService;
use Yii;
use yii\filters\AccessControl;
use reception\entities\User\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    private $service;
    private $myRent;
    private $synchroService;

    public function __construct($id, $module, UserManageService $service, MyRentManageService $myRent,  SynchroService $synchroService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->myRent = $myRent;
        $this->synchroService = $synchroService;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index','create', 'update', 'delete','view','create-myrent'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['receptionist','admin', 'mobile','create-myrent'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function verbs()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->user->can("admin")) {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else {
            $searchModel = new UserSearch(['user'=>Yii::$app->user->id]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new UserCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->service->create($form);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }
    /**
     * Creates a new User model for MyRentReception.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateMyrent()
    {
        $form = new MyRentUserForm();
        if ($form->load(Yii::$app->request->post(),'MyRentUserForm')&&$form->validate()) {
            try {
                $user = $this->myRent->createMyRentUser($form);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Something went wrong -> '. json_encode ($form->getErrors() ));

            }
        }
        else
        return $this->render('create_my_rent_user', [
            'model' => $form,
        ]);
    }

    /**
     * Update User model for MyRentReception.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSynchroApartments($id)
    {
        $user = $this->findModel($id);
        $updateTime = time();
        if ($user) {
            try {

                if ($user->owners)
                    foreach ($user->owners as $owner){
                        $apartments = $this->synchroService->synchroApartmentsForUser($user, $updateTime, $owner->id,false);
                    }
                else $apartments = $this->synchroService->synchroApartmentsForUser($user, $updateTime, null,false);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(['view', 'id' => $user->id]);
    }

    public function actionSynchroRents($id)
    {
        $user = $this->findModel($id);
        $updateTime = time();
        if ($user) {
            try {
                $rents = $this->synchroService->synchroRentsForUser($user, $updateTime, null, $user->myrent_update,false);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(['view', 'id' => $user->id]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);

        $form = new UserEditForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($user->id, $form);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'user' => $user,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->service->remove($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
