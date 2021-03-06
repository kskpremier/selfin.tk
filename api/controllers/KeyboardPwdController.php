<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 12:26
 */
namespace api\controllers;

use reception\forms\KeyboardPasswordForm;
use reception\forms\KeyboardPwdForm;
use reception\helpers\TTLHelper;
use Yii;
use reception\repositories\DoorLock\KeyboardPwdRepository;
use reception\useCases\manage\DoorLock\KeyboardPwdManageService;
use reception\forms\KeyboardPwdForBookingForm;
use reception\entities\DoorLock\KeyboardPwd;
use backend\models\KeyboardPwdSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyboardPwdController extends Controller
{
    private $keyboardPwd;
    private $service;


    public function __construct($id, $module, KeyboardPwdManageService $service, KeyboardPwdRepository $keyboardPwd, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->keyboardPwd = $keyboardPwd;
        $this->service = $service;

    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete','index'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete','create-for-booking','index'],
            'rules' => [
                [
                    'allow' => true,
                    // ролей пока нет, поэтому я закоментировал
                    'roles' => ['admin','receptionist','owner','mrz','mobile'],
                ],
                [
                    'allow' => true,
                    'actions'=>['index'],
                    'roles' => ['lock','tourist'],
                ],
            ],
        ];

        return $behaviors;
    }

    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch'],
            'create' => ['post'],
            'delete' => ['delete','put']
        ];
    }
//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['create']);
//        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//        return $actions;
//    }

//    public function checkAccess($action, $model = null, $params = [])
//    {
//        if (in_array($action, ['create'])) {
//            if (!Yii::$app->user->can('createKeyboardPwd',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
//                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
//            }
//        }
//        if (in_array($action, ['delete'])) {
//            if (!Yii::$app->user->can('deleteKeyboardPwd',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
//                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
//            }
//        }
//        if (in_array($action, ['view'])) {
//            if (!Yii::$app->user->can('viewKeyboardPwd',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
//                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
//            }
//        }
//        if (in_array($action, ['update'])) {
//            if (!Yii::$app->user->can('updateKeyboardPwd',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
//                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
//            }
//        }
//    }

    public function prepareDataProvider()
    {
        $searchModel = new KeyboardPwdSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    public function actionIndex(){
        $result=[];
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
        elseif (Yii::$app->user->can("owner")){
            $searchModel = new KeyboardPwdSearch(['owner'=>$user]);
        }
        elseif (Yii::$app->user->can('lock')  ){
            $searchModel = new KeyboardPwdSearch(['lockUser'=>$user]);
        }
        elseif(Yii::$app->user->can('tourist')){
            $searchModel = new KeyboardPwdSearch(['tourist'=>$user]);
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $models = $dataProvider->query->all(); //$dataProvider->getModels();
        foreach ($models as $model){
            $result[]= $this->serializeKeyboardPwd($model);
        }
        return $result;
    }

    /**
     * Creates a new KeyboardPwd .
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionCreate()
    {
        $form = new KeyboardPasswordForm();
        $form->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($form->validate()) {
            try {
                $resultOfGenerating = $this->service->generate($form);
                //собственно само обращение к китайцам и получение ответа
                // $data = json_decode($keyboardPwd->getKeyboardPwdFromChina(), true);
                if (isset ($resultOfGenerating)) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    return $this->serialize($resultOfGenerating);
                }
                throw new ServerErrorHttpException('Failed to get information from China API for some reason -');
            }  catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        throw new ServerErrorHttpException(json_encode($form->getErrors()));
    }

    public function serialize($resultOfGenerating)
    {
        $result =[];
        if ( !($resultOfGenerating instanceof KeyboardPwd) ) {
            foreach ($resultOfGenerating as $keyboardPwd) {
                $result[] = $this->serializeKeyboardPwd($keyboardPwd);
            }
            return $result;
        }
        return $resultOfGenerating->serializeKeyboardPwd();
    }
    /**
     * @SWG\Post(
     *     path="/password/create",
     *     tags={"Booking"},
     *     description="Generate digital keyboard password(s) for existing booking, that was uploaded before, for all door locks for booking apartment. Supposed that every booking has only one apartment, but apartment can have several door locks",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name = "key", in="body", required=true, description = "Key parameters",  @SWG\Schema(ref="#/definitions/KeyboardPwdNew")),
     *     @SWG\Response(
     *         response=201,
     *         description="Success response",
     *      @SWG\Schema(ref="#/definitions/KeybpardPwdsInfo")
     *              ),
     *
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="KeyboardPwdNew",
     *
     *     type="object",
     *     required= {
     *          "bookingId"
     *      },
     *     @SWG\Property(property="bookingId", type="string",description = "Identity of booking from external systems", example= "ID 5"),
     *     @SWG\Property(property="startDate", type="string", description = "Date and time from which keyboard password will be valid. For type=2 this field could be empty. If this field is empty, then startDate/endDate will be set for all booking period",example="12-09-2017 12:00:00"),
     *     @SWG\Property(property="endDate", type="string", description = "Date and time from which keyboard password will be invalid.", example="10-10-2017 14:00:00"),
     *     @SWG\Property(property="type", type="integer", description = "Type of keyboard password (could be 0 for Periodic or 2 for Permanent", example="0"),
     * )
     */
    /**
     * @SWG\Definition(
     *     definition="KeybpardPwdsInfo",
     *     type="object",
     *       @SWG\Property(property="success", type="string", description = "Success", example= "ok"),
     *       @SWG\Property(property="passwords", type="array",  @SWG\Items(ref="#/definitions/Password"), description ="List of password values for all door locks")
     * )
     */

    /**
     * *  @SWG\Definition(
     *     definition="Password",
     *     type="object",
     *          @SWG\Property(property="id", type="inteher", description = "Identity", example= "45"),
     *          @SWG\Property(property="lock_name", type="string", description = "Door Lock name", example= "Zizi entrance door"),
     *          @SWG\Property(property="password", type="string", description = "Value od digital password", example= "2367880")
     * )
     */
    /**
     * Creates a new KeyboardPwd model for author of booking
     * If creation is successful, return json with id keyboardPwds
     * @return string
     */
    public function actionCreateForBooking()
    {
        $form = new KeyboardPwdForBookingForm();
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $keyboards = $this->service->generateForBooking($form);
                if ($keyboards) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $response->data['success']="ok";

                    $response->data['passwords']=$keyboards;
                }
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

    }

    /**
     * Displays a single DoorLock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Updates an existing DoorLock model.
     * If update is successful, return model
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model;
    }

    /**
     * Deletes an existing DoorLock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$deleteType)
    {
        $keyboardPwd = $this->findModel($id);
            if ($keyboardPwd) {
                $respond = $this->service->remove($keyboardPwd,$deleteType);
                if ($respond) {
                    $keyboardPwd->delete();
                    return ['success' => true];
                }
            }
        return  ['success'=>false];
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
        if (($model = KeyboardPwd::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function serializeKeyboardPwd($key): array
    {

        return [
            'value'=>$key->value,
            'type'=>$key->keyboard_pwd_type,
            'version'=>$key->keyboard_pwd_version,
            'id'=>$key->id,
            'sciener_id'=> $key->keyboard_pwd_id,
            'startDate'=>$key->start_date*1000,//-7200000,
            'endDate'=>$key->end_date*1000,//-7200000,
            'lock' => $key->doorLock->serializeDoorLockShort(),
////            'lockName'=>$key->doorLock->lock_name,
//            'lockAlias'=>$key->doorLock->lock_alias,
////            'lockMac'=>$key->doorLock->lock_mac,
////            'unlockKey'=>$key->doorLock->lock_key,
////            'lockFlagPos'=>$key->doorLock->flag_pos,
////            'aesKeyStr'=>$key->doorLock->aes_key_str,
//
//            'timezoneOffset'=>$key->doorLock->timezone_raw_offset,

//            'lockVersion'=>[
//                'groupId'=>$key->doorLock->getLockVersion()->one()->group_id,
//                'protocolVersion'=>$key->doorLock->getLockVersion()->one()->protocol_version,
//                'protocolType'=>$key->doorLock->getLockVersion()->one()->protocol_type,
//                'orgId'=>$key->doorLock->getLockVersion()->one()->org_id,
//                'scene'=>$key->doorLock->getLockVersion()->one()->scene
//            ],
//            'apartment'=>[
//                'name'=>(count($apartments)>=1)?$apartments[0]['name']:'not yet installed',
//            ],
            'booking_id'=>$key->booking_id
        ];
    }

    public function actionGetType()
    {
        return TTLHelper::getKeyboardPwdTypeNameList();
    }
}

/**
 *  @SWG\Definition(
 *     definition="KeyboardPassword",
 *     type="object",
 *     required= {
 *              "door_lock_id",
 *              "booking_id",
 *              "keyboard_pwd_version",
 *              "keyboard_pwd_type",
 *              "start_date",
 *              "end_date",
 *              "accessToken"
 *      },
 *     @SWG\Property(property="door_lock_id", type="integer"),
 *     @SWG\Property(property="booking_id", type="integer"),
 *     @SWG\Property(property="keyboard_pwd_version", type="string"),
 *     @SWG\Property(property="keyboard_pwd_type", type="integer"),
 *     @SWG\Property(property="start_date", type="string"),
 *     @SWG\Property(property="end_date", type="string"),
 *     @SWG\Property(property="accessToken", type="string")
 * )
 */



