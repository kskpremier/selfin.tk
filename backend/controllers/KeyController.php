<?php

namespace backend\controllers;

use backend\models\KeyAdminSearch;
use reception\forms\KeyForm;
use reception\forms\KeyEditForm;
use reception\forms\KeyFormForNewUser;
use reception\repositories\DoorLock\KeyRepository;
use reception\useCases\manage\DoorLock\KeyManageService;
use Yii;
use reception\entities\DoorLock\Key;
use backend\models\KeySearch;
use reception\entities\Booking\Booking;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use reception\entities\DoorLock\DoorLock;
use yii\filters\VerbFilter;



/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyController extends Controller
{
    private $keyRepository;
    private $service;

    public function __construct($id, $module, KeyManageService $service, KeyRepository $keyRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->keyRepository = $keyRepository;
        $this->service = $service;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete','create-for-booking','index'],
            'except' => ['keys-list-for-opening'],
            'rules' => [
                [
                    'allow' => true,
                    'actions'=>['create', 'update', 'delete','create-for-booking','index'],
                    'roles' => ['admin','receptionist','mobile'],
                ],

                [
                    'allow' => true,
                    'actions'=>['create-for-booking','index'],
                    'roles' => ['tourist'],
                ],
                [
                    'allow' => true,
                    'actions'=>['keys-list-for-opening'],
                    'roles' => ['@'],
                ],
            ],
        ];
        $behaviors ['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ]
        ];

        return $behaviors;
    }

    /**
     * Lists all Key models.
     * @return mixed
     */
    public function actionIndex($userId=null,$bookingId=null)
    {
        $user = Yii::$app->user->identity->getUserModel();
        $parentsIDs = (isset($user->parentUsers))?ArrayHelper::getColumn ($user->parentUsers, 'id'):[];

        if (Yii::$app->user->can("admin")) {
            $searchModel = new KeySearch();
        }
        elseif  (Yii::$app->user->can('mobile')) {
                $searchModel = new KeyAdminSearch(['userId'=>$user->id, "parents"=>$parentsIDs]);
            }
        elseif  (Yii::$app->user->can('owner')) {
            $searchModel = new KeyAdminSearch(['userId'=>$user->id, "owner"=>$parentsIDs]);
        }
        elseIf (Yii::$app->user->can('tourist')) {
             $searchModel = new KeySearch(['tourist_user_id' => Yii::$app->user->id] );
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Key models.
     * @return mixed
     */
    public function actionIndexForBooking($userId=null,$bookingId=null)
    {
        $searchModel = new KeySearch(['userId'=>$userId, 'bookingId'=>$bookingId]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Key model.
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
     * Creates a new Key model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($booking_id  = null)
    {
        $booking = ($booking_id) ? Booking::findOne($booking_id) : null;
       if (isset($booking)) {
          // foreach ($booking->apartment->doorLocks) {
               $model = new Key(['start_date' => Yii::$app->formatter->asDateTime($booking->start_date, "php:D, d-M-Y H:i"),
                   'end_date' => Yii::$app->formatter->asDateTime($booking->end_date, "php:D, d-M-Y H:i"),
                   'booking_id' => $booking_id,
                   'door_lock_id' => $booking->apartment->doorLock->id]);
              // $modelsKeyList[]=$modelKey;
      //       }
       } else {
           $model = new KeyForm();
           $model->doorLockId = (array_key_exists('door_lock_id',Yii::$app->request->queryParams))?Yii::$app->request->queryParams['door_lock_id']:$model->doorLockId;
       }

        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
                $key = $this->service->generate($model);
            if ($key) {
                Yii::$app->session->setFlash('success', 'E-Key was successfully generated');
                return $this->redirect(['view', 'id' => $key->id]);
            }
            else {
                Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Key model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateForBooking($booking_id)
    {
        $booking = Booking::findOne($booking_id);
        if (isset($booking)) {
            $keys = $this->service->create($booking, Yii::$app->user->id);

            if (isset($keys)) {
                Yii::$app->session->setFlash('success', 'E-Key was successfully generated');
                return $this->redirect(['index', '$bookingId' => $booking_id]);
            }
            else {
                Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
                return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
            }
        }
        else {
            Yii::$app->session->setFlash('error', 'Booking is not set correctly');
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }
    }

    /**
     * Creates a new Key model for appointed doorLock
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateForDoorLock($doorLockId)
    {
        $doorLock = DoorLock::findOne(['id'=>$doorLockId]);
        if (!isset($doorLock)){
            Yii::$app->session->setFlash('error', 'Can not find doorlock with this Id');
            return $this->redirect(['door-lock/index']);
        }
        $form = new KeyForm(['doorLockId'=>$doorLockId]);
        if ($form->load(Yii::$app->request->post())&& $form->validate() ) {
            $key = $this->service->generate ($form);
            Yii::$app->session->setFlash('success', 'E-Key was successfully generated');
            return $this->redirect(['view', 'id' => $key->id]);
        }
        else {
            return $this->render('_create', [
                'model' => $form,
            ]);
        }
    }
    /**
     * Creates a new Key model for appointed booking
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateKeyForBooking($bookingId)
    {
        $booking = Booking::findOne(['id'=>$bookingId]);
        if (!isset($booking)){
            Yii::$app->session->setFlash('error', 'Can not find booking with this Id');
            return $this->redirect(['booking/index']);
        }
        $form = new KeyForm(['bookingId'=>$bookingId,'startDate'=>$booking->start_date,'endDate'=>$booking->end_date]);
        if ($form->load(Yii::$app->request->post()) && $form->validate() ) {
            $key = $this->service->generate ($form);
            Yii::$app->session->setFlash('success', 'E-Key was successfully generated');
            return $this->redirect(['view', 'id' => $key->id]);
        }
        else {
            return $this->render('_create', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Creates a new Key model for appointed booking
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateKeyForNewUser($id=null)
    {
        $user = Yii::$app->user->identity->getUserModel();
        $form = new KeyFormForNewUser(['doorLockId'=>$id]);
        if ($form->load(Yii::$app->request->post()) && $form->validate() ) {
            $key = $this->service->sendForNewUser ($form, Yii::$app->user->identity->getUserModel());
            Yii::$app->session->setFlash('success', 'E-Key was successfully generated');
            return $this->redirect(['view', 'id' => $key->id]);
        }
        else {
            return $this->render('_sendkey', [
                'model' => $form,
                'user'=> $user

            ]);
        }
    }

    /**
     * Updates an existing Key model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new KeyEditForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($form, $model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_update', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Deletes an existing Key model.
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
     * Finds the Key model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Key the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Key::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
