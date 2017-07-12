<?php

namespace backend\controllers;

use reception\forms\KeyForm;
use reception\forms\KeyEditForm;
use reception\repositories\DoorLock\KeyRepository;
use reception\useCases\manage\DoorLock\KeyManageService;
use Yii;
use reception\entities\DoorLock\Key;
use backend\models\KeySearch;
use backend\models\Booking;
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
        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
        ];
    }

    /**
     * Lists all Key models.
     * @return mixed
     */
    public function actionIndex($userId=null)
    {
        $searchModel = new KeySearch(['userId'=>$userId]);
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
           $model = new Key();
           $model->door_lock_id = (array_key_exists('door_lock_id',Yii::$app->request->queryParams))?Yii::$app->request->queryParams['door_lock_id']:$model->door_lock_id;
       }

        if ($model->load(Yii::$app->request->post()) ) {
            if ($response=$model->sendEKeyByLocal()) {
                Yii::$app->session->setFlash('success', 'E-Key was successfully generated and sent by email');
                return $this->redirect(['view', 'id' => $response]);
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
            $key = $this->service->create ($form);
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
    public function actionCreateForBooking($bookingId)
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
     * Updates an existing Key model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new KeyEditForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            $this->service->edit($form);
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
