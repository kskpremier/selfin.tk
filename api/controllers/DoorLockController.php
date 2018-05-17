<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 10.05.17
 * Time: 20:03
 */

namespace api\controllers;

use api\models\GetKeyboardKey;
use function json_encode;
use reception\entities\User\User;
use reception\forms\DoorLockInstallForm;
use reception\forms\DoorLockNameForm;
use reception\repositories\Apartment\ApartmentRepository;
use reception\repositories\DoorLock\DoorLockRepository;
use Yii;
use reception\entities\DoorLock\DoorLock;
use reception\forms\DoorLockForm;
use backend\models\DoorLockSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

use reception\useCases\manage\DoorLock\DoorLockManageService;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

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
            $behaviors['authenticator']['only'] = ['create', 'update', 'delete','index','install','view', 'uninstall'];
            $behaviors['authenticator']['authMethods'] = [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
            ];
            $behaviors['access'] = [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete','index','install','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['index','view'],
                        'roles' => ['admin', 'mobile','tourist','owner','worker'],
                    ],
                        [
                            'allow' => true,
                            'actions'=>['update','create','view'],
                            'roles' => ['mobile','owner','worker'],
//                            'rules' => ['forUserId']
                        ],
                    [
                        'allow' => true,
                        'actions'=>['install','uninstall','delete','name'],
                        'roles' => ['lockAdmin'],
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
            'install' =>['post'],
            'delete' => ['delete'],
        ];
    }


    public function prepareDataProvider()
    {
       if (Yii::$app->getUser()->can('admin')) {
           $searchModel = new DoorLockSearch();
       }
        else $searchModel = new DoorLockSearch(['user'=>Yii::$app->getUser()->getid()]);

        return $searchModel->search(Yii::$app->request->queryParams);
    }

    public function actionIndex() {
        $dataProvider = $this->prepareDataProvider();
        $result =[];
        foreach ($dataProvider->getModels() as $doorlock) {
            $result[] = $this->serializeDoorLockShort($doorlock);
        }
        return $result;
    }
    /**
     * @SWG\Post(
     *     path="/lock/add",
     *     tags={"DoorLock"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     description="",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),

     *     @SWG\Parameter( name = "doorlock", in="body", required=true, description = "Init door lock data",  @SWG\Schema(ref="#/definitions/DoorLockInit")),

     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/DoorLock")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="DoorLockInit",
     *     type="object",
     *     required= {
     *          "date",
     *          "lockName",
     *          "lockAlias",
     *          "lockMac",
     *          "lockKey",
     *          "lockFlagPos",
     *          "aesKeyStr",
     *          "lockVersion",
     *          "adminPwd",
     *          "noKeyPwd",
     *          "deletePwd",
     *          "pwdInfo",
     *          "timestamp",
     *          "specialValue",
     *          "timezoneRawOffset",
     *          "modelNumber",
     *          "hardwareRevision",
     *          "firmwareRevision",
     *          "electricQuantity"
     *      },
     *          @SWG\Property(property="lockName", type="string",description = "Lockname", example= "M201T_780566"),
     *          @SWG\Property(property="lockAlias", type="string",description = "	Lock alias", example= "M201T_780566"),
     *          @SWG\Property(property="lockMac", type="string",description = "Lock mac address", example= "C0:DE:EE:66:05:78"),
     *          @SWG\Property(property="lockKey", type="string",description = "Critical information locked door, open the door of", example= "OCwxLDAsMTAsMTMsMSw4LDEzLDksOSw3MA=="),
     *          @SWG\Property(property="modelNumber", type="string",description = "", example= "???"),
     *          @SWG\Property(property="hardwareRevision", type="string",description = "", example= "???"),
     *          @SWG\Property(property="firmwareRevision", type="string",description = "", example= "???"),
     *          @SWG\Property(property="electricQuantity", type="integer",description = "% in charging battery level", example= "90"),
     *          @SWG\Property(property="lockFlagPos", type="integer",description = "Lock flag", example= "0"),
     *          @SWG\Property(property="aesKeyStr", type="string",description = "Aes encryption and decryption Key", example= "26,1f,cf,3a,fc,43,bd,41,d9,bb,c9,cc,34,0d,50,4e"),
     *          @SWG\Property(property="adminPwd", type="string",description = "The administrator password lock, lock management related operations required to carry, check administrator privileges", example= "NDEsNDAsNDYsNDEsMzIsNDIsNDAsNDAsNDEsNDAsMTAz"),
     *          @SWG\Property(property="noKeyPwd", type="string",description = "Keyboard administrator password, administrator password to open the door with the", example= "1064267"),
     *          @SWG\Property(property="deletePwd", type="string",description = "Clear codes, passwords for emptying locked", example= "0"),
     *          @SWG\Property(property="pwdInfo", type="string",description = "	Password data, for generating the password, the SDK provides", example= "0"),
     *          @SWG\Property(property="timestamp", type="string",description = "Time stamp, used to initialize the password data, SDK provided", example= "1497475863"),
     *          @SWG\Property(property="specialValue", type="integer",description = "Lock feature value that indicates the function of the lock support", example= "0"),
     *          @SWG\Property(property="timezoneRawOffset", type="double",description = "When the lock area where the number of poor and UTC time zone, the unit milliseconds, default (China time zone) 28,800,000", example= "7200000"),
     *          @SWG\Property(property="date", type="double",description = "Current time (milliseconds)", example= "1495662149000"),
     *          @SWG\Property(property="lockVersion", type="object",
    *           @SWG\Property(property="protocolType", type="integer",description = "agreement type", example= "1"),
     *              @SWG\Property(property="protocolVersion", type="integer",description = "Protocol Version", example= "3"),
     *              @SWG\Property(property="scene", type="integer",description = "Scenes", example= "5"),
     *              @SWG\Property(property="groupId", type="integer",description = "the company", example= "1"),
     *              @SWG\Property(property="orgId", type="integer",description = "Application providers", example= "2")
     * )
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="LockVersion",
     *     type="object",
     *     required= {
     *          "groupId",
     *          "protocolVersion",
     *          "protocolType",
     *          "orgId",
     *          "scene"
     *           },
     * @SWG\Property(property="protocolType", type="integer",description = "agreement type", example= "1"),
     * @SWG\Property(property="protocolVersion", type="integer",description = "Protocol Version", example= "3"),
     * @SWG\Property(property="scene", type="integer",description = "Scenes", example= "5"),
     * @SWG\Property(property="groupId", type="integer",description = "the company", example= "1"),
     * @SWG\Property(property="orgId", type="integer",description = "Application providers", example= "2")
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="DoorLock",
     *     type="object",
     *
     *          @SWG\Property(property="lockName", type="string",description = "Lockname", example= "M201T_780566"),
     *          @SWG\Property(property="lockAlias", type="string",description = "	Lock alias", example= "M201T_780566"),
     *          @SWG\Property(property="lockMac", type="string",description = "Lock mac address", example= "C0:DE:EE:66:05:78"),
     *          @SWG\Property(property="lockKey", type="string",description = "Critical information locked door, open the door of", example= "OCwxLDAsMTAsMTMsMSw4LDEzLDksOSw3MA=="),
     *          @SWG\Property(property="lockFlagPos", type="integer",description = "Lock flag", example= "0"),
     *          @SWG\Property(property="aesKeyStr", type="string",description = "Aes encryption and decryption Key", example= "26,1f,cf,3a,fc,43,bd,41,d9,bb,c9,cc,34,0d,50,4e"),
     *          @SWG\Property(property="adminPwd", type="string",description = "The administrator password lock, lock management related operations required to carry, check administrator privileges", example= "NDEsNDAsNDYsNDEsMzIsNDIsNDAsNDAsNDEsNDAsMTAz"),
     *          @SWG\Property(property="noKeyPwd", type="string",description = "Keyboard administrator password, administrator password to open the door with the", example= "1064267"),
     *          @SWG\Property(property="deletePwd", type="string",description = "Clear codes, passwords for emptying locked", example= "0"),
     *          @SWG\Property(property="pwdInfo", type="string",description = "	Password data, for generating the password, the SDK provides", example= "0"),
     *          @SWG\Property(property="timestamp", type="string",description = "Time stamp, used to initialize the password data, SDK provided", example= "1497475863"),
     *          @SWG\Property(property="modelNumber", type="string",description = "", example= "???"),
     *          @SWG\Property(property="hardwareRevision", type="string",description = "", example= "???"),
     *          @SWG\Property(property="firmwareRevision", type="string",description = "", example= "???"),
     *          @SWG\Property(property="electricQuantity", type="integer",description = "% in charging battery level", example= "90"),
     *          @SWG\Property(property="specialValue", type="integer",description = "Lock feature value that indicates the function of the lock support", example= "0"),
     *          @SWG\Property(property="timezoneRawOffset", type="double",description = "When the lock area where the number of poor and UTC time zone, the unit milliseconds, default (China time zone) 28,800,000", example= "7200000"),
     *          @SWG\Property(property="date", type="double",description = "Current time (milliseconds)", example= "1495662149000"),
     *          @SWG\Property(property="lockId", type="integer",description = "Lock id", example= "50088"),
     *          @SWG\Property(property="keyId", type="integer",description = "Administrator key id", example= "367238"),
     *          @SWG\Property(property="lockVersion",  type="object",
     *              @SWG\Property(property="protocolType", type="integer",description = "agreement type", example= "1"),
     *              @SWG\Property(property="protocolVersion", type="integer",description = "Protocol Version", example= "3"),
     *              @SWG\Property(property="scene", type="integer",description = "Scenes", example= "5"),
     *              @SWG\Property(property="groupId", type="integer",description = "the company", example= "1"),
     *              @SWG\Property(property="orgId", type="integer",description = "Application providers", example= "2")
     *     )
     * )
     */
    /**
     * Creates a new DoorLock model.
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionCreate()
    {
        $form = new DoorLockForm();
        if ($form->load(Yii::$app->getRequest()->getBodyParams(), '') && $form->validate()) {
            try {
                $doorLock = $this->service->init($form,Yii::$app->user->id);
                if ($doorLock) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $doorLock->id], true));
                } else {
                    Yii::error("Something wrong");
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
                return $this->serializeDoorLock($doorLock);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
    }

    public function actionInstall (){

        $model = new DoorLockInstallForm();

        $model->load(Yii::$app->request->getBodyParams(), '');
        if (! $model->validate()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.'. json_encode($model->getErrors()));
        }
        if (!$apartment = $this->apartmentRepository->get($model->apartmentId)) {
            throw new NotFoundHttpException('The requested apartment does not exist.');
        }

        $result = $this->service->addApartment($model->id,  $apartment, $model->lockAlias, Yii::$app->getUser()->getId());

        return json_encode(["result"=>($result)?'success': "errors"]);
    }

    public function actionName (){

        $model = new DoorLockNameForm();

        $model->load(Yii::$app->request->getBodyParams(), '');
        if (! $model->validate()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.'. json_encode($model->getErrors()));
        }

        $result = $this->service->setName($model->id, $model->lockAlias);

        return ["result"=>($result)?'success': "errors"];
    }


    public function actionUninstall (){

        $model = new DoorLockInstallForm();

        $model->load(Yii::$app->request->getBodyParams(), '');
        if (! $model->validate()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        if (!$apartment = $this->apartmentRepository->get($model->apartmentId)) {
            throw new NotFoundHttpException('The requested apartment does not exist.');
        }
        $result = $this->service->removeApartment($model->id,  $apartment->id, $model->lockAlias, $apartment->user_id);

        return json_encode(["result"=>($result)?'success': "errors"]);
    }


    /**
     * @SWG\Get(
     *     path="/lock/view",
     *     tags={"DoorLock"},
     *     description="Return booking model finding by booking_id (internal door lock management system identity)",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name="id", in="query", required=true, type="integer", description = "Identity of door lock from internal systems"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/DoorLock")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     * Displays a single DoorLock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if (!$doorlock = $this->doorLock->get($id)) {
                throw new NotFoundHttpException('The requested doorlock does not exist.');
            }
        return $this->serializeDoorLock($doorlock);
    }

    /**
     * @SWG\Get(
     *     path="/lock/viewByMac",
     *     tags={"DoorLock"},
     *     description="Return booking model finding by booking_id (internal door lock management system identity)",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name="lockMac", in="query", required=true, type="string", description = "Mac address of door lock"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/DoorLock")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Displays a single DoorLock model.
     * @param string $lockMac
     * @return mixed
     */
    public function actionMac($lockMac)
    {
        if (!$doorLock = $this->doorLock->findByMac($lockMac)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->serializeDoorLock($doorLock);
    }

    /**
     * Updates an existing DoorLock model.
     * If update is successful, return model
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!$doorlock = $this->doorLock->get($id)) {
            throw new NotFoundHttpException('The requested doorlock does not exist.');
        }

        $model = new DoorLockForm (['id'=>$id]);

        $model->load(Yii::$app->request->getBodyParams(), '');
        if (! $model->validate()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        $result = $this->service->edit($doorlock, $model, Yii::$app->getUser()->getId());

        return ($result)? 'success': "errors";
    }

    /**
     * Deletes an existing DoorLock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return  $this->findModel($id)->delete();
    }
    /**
     * Генерирует комбинацию цифр для конкретного замка
     *
     * @param integer $id
     * @return mixed
     */
    public function actionKeyboardPwd($id){

        $model = new GetKeyboardKey();
        $model->load(Yii::$app->request->getBodyParams(), '');
        $model->getKeyboardPwd();

        $key = new \backend\models\Key();

        $key->load($this);

        return $key;
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
        if (($model = DoorLock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function serializeDoorLock(DoorLock $doorLock): array
    {
        $apartments =[];
        foreach ($doorLock->apartments as $apartment)
        {
            $apartments[]=[
                'id' => $apartment->id,
                'name' => $apartment->name,
                'external_apartment_id' => $apartment->external_id,
                'city_name'=>$apartment->city_name,
                'address'=>$apartment->adress,
                'latitude'=>$apartment->latitude,
                'longitude'=>$apartment->longitude,
                 'user_id'=>$apartment->user_id
            ];
        }

        return [
            'lockId'=>$doorLock->lock_id,
            'keyId'=>$doorLock->key_id,
            'lockName'=>$doorLock->lock_name,
            'lockAlias'=>$doorLock->lock_alias,
            'lockMac'=>$doorLock->lock_mac,
            'lockKey'=>$doorLock->lock_key,
            'lockFlagPos'=>$doorLock->flag_pos,
            'aesKeyStr'=>$doorLock->aes_key_str,
            'adminPwd'=>$doorLock->admin_pwd,
            'noKeyPwd'=>$doorLock->no_key_pwd,
            'deletePwd'=>$doorLock->delete_pwd,
            'pwdInfo'=>$doorLock->pwd_info,
            'timestamp'=>$doorLock->timestamp,
            'specialValue'=>$doorLock->special_value,
            'timezoneRawOffset'=>$doorLock->timezone_raw_offset,
            'modelNumber'=>$doorLock->model_number,
            'hardwareRevision'=>$doorLock->hardware_revision,
            'firmwareRevision'=>$doorLock->firmware_revision,
            'electricQuantity'=>$doorLock->electric_quantity,
            'lockVersion'=>[
                'groupId'=>$doorLock->lockVersion->group_id,
                'protocolVersion'=>$doorLock->lockVersion->protocol_version,
                'protocolType'=>$doorLock->lockVersion->protocol_type,
                'orgId'=>$doorLock->lockVersion->org_id,
                'scene'=>$doorLock->lockVersion->scene
            ],
            'apartments'=>$apartments

        ];
    }
    public function serializeDoorLockShort(DoorLock $doorLock): array
    {
        $apartments =[];
        foreach ($doorLock->apartments as $apartment)
        {
            $apartments[]=[
                'id' => $apartment->id,
                'name' => $apartment->name,
//                'external_apartment_id' => $apartment->external_id,
                'city_name'=>$apartment->city_name,
                'address'=>$apartment->adress,
                'latitude'=>$apartment->latitude,
                'longitude'=>$apartment->longitude,
                'user_id'=>$apartment->user_id
            ];
        }

        return [
            'id'=>$doorLock->id,
            'lockName'=>$doorLock->lock_name,
            'lockAlias'=>$doorLock->lock_alias,
            'lockMac'=>$doorLock->lock_mac,

            'apartments'=>$apartments

        ];
    }
}
