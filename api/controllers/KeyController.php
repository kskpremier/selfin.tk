<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 11:01
 * */
namespace api\controllers;

use reception\forms\KeyForm;
use reception\repositories\DoorLock\KeyRepository;
use reception\useCases\manage\DoorLock\KeyManageService;
use reception\forms\KeyForBookingForm;
use Yii;
use backend\models\Key;
use backend\models\KeySearch;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use backend\models\Booking;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;



/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyController extends Controller
{
    private $key;
    private $service;


    public function __construct($id, $module, KeyManageService $service, KeyRepository $key, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->key = $key;
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
//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'only' => ['create', 'update', 'delete'],
//            'rules' => [
//                [
//                    'allow' => true,
//                    // ролей пока нет, поэтому я закоментировал
//                    'roles' => ['@'],
//                ],
//            ],
//        ];

        return $behaviors;
    }

    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch'],
            'create' => ['post'],
            'delete' => ['delete']
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
       // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['create'])) {
            if (!Yii::$app->user->can('createKey',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['delete'])) {
            if (!Yii::$app->user->can('deleteKey',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['view'])) {
            if (!Yii::$app->user->can('viewKey',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['update'])) {
            if (!Yii::$app->user->can('updateKey',['booking_id'=>$model->booking_id, 'start_date'=>$model->start_date,'end_date'=>$model->end_date])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['index'])) {
            if (!Yii::$app->user->can('tourist',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
    }

    public function prepareDataProvider()
    {
        $searchModel = new KeySearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * @SWG\Get(
     *     path="/keys",
     *     tags={"DoorLock"},
     *     description="Return all existing keys for requested user(by token) or by other params. Parameters info is nessesary for generating E-key for the author of booking, appointed when booking was added. Type of th E-key could be 0 or 2. 0 - E-key for period from startDate untill endDate.
     *          By Default E-key will be generated from current moment until the departure date of booking.",
     *
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name = "key", in="body", required=true, description = "Key parameters",  @SWG\Schema(ref="#/definitions/KeyNew")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/KeysInfo")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="KeyNew",
     *
     *     type="object",
     *     required= {
     *          "bookingId"
     *      },
     *     @SWG\Property(property="bookingId", type="string",description = "Identity of booking from external systems", example= "ID 5"),
     *     @SWG\Property(property="remarks", type="string", description = "Guest's second name"),
     *     @SWG\Property(property="startDate", type="string", description = "Date and time from which key will be valid. For type=2 this field could be empty. If this field is empty, then startDate/endDate will be set for all booking period",example="12-09-2017 12:00:00"),
     *     @SWG\Property(property="endDate", type="string", description = "Date and time from which key will be invalid.", example="10-10-2017 14:00:00"),
     *     @SWG\Property(property="type", type="integer", description = "Type of E-key (could be 0 for Periodic or 2 for Permanent", example="0"),
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="KeysInfo",
     *     type="object",
     *
     *          @SWG\Property(property="lockName", type="string",description = "Lockname", example= "M201T_780566"),
     *      @SWG\Property(property="lockMac", type="string",description = "MAC number of door lock", example= "C0:DE:EE:66:05:79"),
     *      @SWG\Property(property="lockAliases", type="string",description = "Alias of door lock", example= "M201T_780566"),
     *          @SWG\Property(property="unlockKey", type="string",description = "Critical information locked door, open the door of", example= "OCwxLDAsMTAsMTMsMSw4LDEzLDksOSw3MA=="),
     *          @SWG\Property(property="lockFlagPos", type="integer",description = "Lock flag", example= "0"),
     *          @SWG\Property(property="aesKeyStr", type="string",description = "Aes encryption and decryption Key", example= "26,1f,cf,3a,fc,43,bd,41,d9,bb,c9,cc,34,0d,50,4e"),
     *          @SWG\Property(property="timezoneOffset", type="double",description = "When the lock area where the number of poor and UTC time zone, the unit milliseconds, default (China time zone) 28,800,000", example= "7200000"),

     *          @SWG\Property(property="lockVersion",  type="object",
     *              @SWG\Property(property="protocolType", type="integer",description = "agreement type", example= "1"),
     *              @SWG\Property(property="protocolVersion", type="integer",description = "Protocol Version", example= "3"),
     *              @SWG\Property(property="scene", type="integer",description = "Scenes", example= "5"),
     *              @SWG\Property(property="groupId", type="integer",description = "the company", example= "1"),
     *              @SWG\Property(property="orgId", type="integer",description = "Application providers", example= "2")
     *     ),
     *          @SWG\Property(property="apartment",  type="object",
     *              @SWG\Property(property="name", type="integer",description = "name of apartment or room", example= "Zizi")
     * ),
     *           @SWG\Property(property="booking_id",  type="string", description = "booking number from external systems", example= "R 2220/74"),
     * )
     */
    public function actionIndex(){
        $searchModel = new KeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();
        foreach ($models as $model){
            $result[]= $this->serializeKey($model);
        }
        return $result;
    }


    /**
     * @SWG\Post(
     *     path="/key/generate",
     *     tags={"DoorLock"},
     *     description="Generate E-key(s) for the author of existing booking, that was uploaded before, for all door locks for booking apartment. Supposed that every booking has only one apartment, but apartment can have several door locks",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Response(
     *         response=201,
     *         description="Success response",
     *          @SWG\Property(property="Response",  type="object",
     *              @SWG\Property(property="success", type="string",description = "Success", example= "ok"),
     *              @SWG\Property(property="keysId", type="array",description = "List of Keys that were generated", example= "[11,12]")
     *              )
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     * Creates a new Key model.
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionCreate()
    {
        $model = new Key();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $data = json_decode( $model->sendEKeyValueFromChina() , true) ;
        if ( $data['success']) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
            return  $model;
        }
        throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
    }

    /**
     * Creates a new Key model for author of booking
     * If creation is successful, return json with id keys
     * @return string
     */
    public function actionCreateForBooking()
    {
        $form = new KeyForBookingForm();
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $key = $this->service->generateForBooking($form);
                if ($key) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $response->data['success']="ok";
                    $response->data['keysId']=$key;
                }
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

    }

    /**
     * Displays a single Key model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Updates an existing Key model.
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
     * Deletes an existing Key model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return  $this->findModel($id)->delete();
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

    public function serializeKey($key): array
    {
        return [
            'startDate'=>$key->start_date*1000-7200000,
            'endDate'=>$key->end_date*1000-7200000,
            'lockName'=>$key->doorLock->lock_name,
            'lockAlias'=>$key->doorLock->lock_alias,
            'lockMac'=>$key->doorLock->lock_mac,
            'unlockKey'=>$key->doorLock->lock_key,
            'lockFlagPos'=>$key->doorLock->flag_pos,
            'aesKeyStr'=>$key->doorLock->aes_key_str,

            'timezoneOffset'=>$key->doorLock->timezone_raw_offset,

            'lockVersion'=>[
                'groupId'=>$key->doorLock->getLockVersion()->one()->group_id,
                'protocolVersion'=>$key->doorLock->getLockVersion()->one()->protocol_version,
                'protocolType'=>$key->doorLock->getLockVersion()->one()->protocol_type,
                'orgId'=>$key->doorLock->getLockVersion()->one()->org_id,
                'scene'=>$key->doorLock->getLockVersion()->one()->scene
            ],
            'apartment'=>[
                'name'=>($key->doorLock->apartment)?$key->doorLock->apartment->name:'not yet installed',
            ],
            'booking_id'=>($key->booking_id)?$key->booking->external_id:'not match with any booking'
        ];
    }
}