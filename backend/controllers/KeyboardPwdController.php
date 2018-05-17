<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 15:58
 */

namespace backend\controllers;

use reception\forms\KeyboardPasswordForm;
use reception\helpers\BookingHelper;
use Yii;
use reception\entities\DoorLock\KeyboardPwd;
use reception\forms\KeyboardPwdForm;
use reception\forms\KeyboardPwdEditForm;
use reception\repositories\DoorLock\KeyboardPwdRepository;
use reception\useCases\manage\DoorLock\KeyboardPwdManageService;
use backend\models\KeyboardPwdSearch;
use backend\models\Booking;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyboardPwdController extends Controller
{
    private $keyboardPwdRepository;
    private $service;

    public function __construct($id, $module, KeyboardPwdManageService $service, KeyboardPwdRepository $keyboardPwdRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->keyboardPwdRepository = $keyboardPwdRepository;
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
                    'actions'=>['index'],
                    'roles' => ['tourist'],
                ],
            ],
        ];
       $behaviors ['verbs'] = [
        'class' => VerbFilter::className(),
            'actions' => [
                 'delete' => ['DELETE','POST'],
            ]
        ];

        return $behaviors;
    }

    /**
     * Lists all Key models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity->getUserModel();
        if (Yii::$app->user->can("admin")) {
            $searchModel = new KeyboardPwdSearch();
        }
        elseif  (Yii::$app->user->can("receptionist")) {
            $parents = $user->parentUsers;
            $ids = ArrayHelper::getColumn($parents, 'id');
            $ids[]=$user->id;
            $searchModel = new KeyboardPwdSearch(['user'=>$ids]);
        }
        elseif (Yii::$app->user->can("mobile")){
            $searchModel = new KeyboardPwdSearch(['user'=>$user->id]);
        }
        elseif (Yii::$app->user->can("owner")){
            $searchModel = new KeyboardPwdSearch(['owner'=>$user]);
        }
        elseif (Yii::$app->user->can('lock') ){
            $searchModel = new KeyboardPwdSearch(['lockUser'=>$user]);
        }
        elseif(Yii::$app->user->can('tourist')){
            $searchModel = new KeyboardPwdSearch(['tourist'=>$user]);
        }

        else $searchModel = new KeyboardPwdSearch(['user'=>$user->id]);

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
     * Displays a single Key model.
     * @param integer $id
     * @return mixed
     */
    public function actionSendEmail()
    {
        $booking = new Booking();
        $booking->sendTestMarcoPoloEmail("sergey.sap@my-rent.net");
    }


//    /**
//     * Creates a new Key model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreateOld($booking_id  = null)
//    {
//        $booking = ($booking_id) ? Booking::findOne($booking_id) : null;
//
//        if (isset($booking)) {
//            $model = new KeyboardPwd(['start_date' => Yii::$app->formatter->asDateTime($booking->start_date, "php:D, d-M-Y H:i"),
//                'end_date' => Yii::$app->formatter->asDateTime($booking->end_date, "php:D, d-M-Y H:i"),
//                'booking_id' => $booking_id,
//                'door_lock_id'=> $booking->apartment->doorLock->id]);
//        } else {
//            $model = new KeyboardPwd();
//            $model->door_lock_id = (array_key_exists('door_lock_id',Yii::$app->request->queryParams))?
//                                    Yii::$app->request->queryParams['door_lock_id']:
//                                    $model->door_lock_id;
//        }
//
//        if ($model->load(Yii::$app->request->post()) ) {
//            $model->start_date = Yii::$app->formatter->asDateTime($model->start_date,'php:d-m-Y H:i');
//            $model->end_date = Yii::$app->formatter->asDateTime($model->end_date,'php:d-m-Y H:i');
//            if ($response = $model->getKeyboardPwdLocal()) {
//
//                Yii::$app->session->setFlash('success', 'Keyboard password is successfully generated  ' );
//                return $this->redirect(['view', 'id' => $response]);
//            }
//            else {
//                Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
//                return $this->render('create', [
//                    'model' => $model,
//                ]);
//            }
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    public function actionCreate($doorLockId=null,$booking_id=null)
    {
        $user = Yii::$app->user->identity->getUserModel();
        $model = new KeyboardPasswordForm(['bookingId'=>$booking_id,'doorLockId'=>$doorLockId]);

        if ($model->load(Yii::$app->request->post() ) && $model->validate() ) {
            $keyboardPwds =  $this->service->generate($model); //в общем случае это может быть массив ключей
            if (count($keyboardPwds)>=1) {
                $value = ArrayHelper::getColumn($keyboardPwds,'value');
                Yii::$app->session->setFlash('success', 'Password(s) was successfully generated',implode ( ',' , $value));
                return $this->redirect(['index']);
            }
            else {
                Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
                return $this->render('create', [
                    'model' => $model,
                    'user'=>$user,
                ]);
            }
        }
        else {
            return $this->render('_form', [
                'model' => $model,
                'user'=>$user,
            ]);
        }
    }

    /**
     * Updates an existing KeyboardPwd model.
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
     * Deletes an existing KeyboardPwd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the KeyboardPwd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Key the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KeyboardPwd::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
