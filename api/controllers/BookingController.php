<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 29.05.17
 * Time: 23:57
 */

namespace api\controllers;


use reception\forms\BookingForm;
use reception\repositories\Booking\BookingRepository;
use reception\useCases\manage\Booking\BookingManageService;
use Yii;
use reception\entities\Booking\Booking;
use reception\services\MyRent\MyRent;
use reception\entities\User\User;
use reception\entities\Booking\Guest;
use backend\models\BookingSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;



/**
 * BookingController implements the CRUD actions for Booking model.
 */
class  BookingController extends Controller
{
    private $booking;
    private $service;


    public function __construct($id, $module, BookingManageService $service, BookingRepository $booking, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->booking = $booking;
        $this->service = $service;

    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete','view','view-external','bookings','booking'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete','view','view-external','bookings','booking','create-for-owner'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['receptionist','owner'],
                ],
                [
                    'allow' => true,
                    'actions'=>['bookings'],
                    'roles' => ['tourist'],
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
            'delete' => ['delete']
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['create'])) {
            if (!Yii::$app->user->can('createBooking',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['delete'])) {
            if (!Yii::$app->user->can('deleteBooking',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['view'])) {
            if (!Yii::$app->user->can('viewBooking',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['update'])) {
            if (!Yii::$app->user->can('updateBooking',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['view-external'])) {
            if (!Yii::$app->user->can('viewBooking',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['bookings'])) {
            if (!Yii::$app->user->can('viewBooking',[])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
    }

    public function prepareDataProvider()
    {
        $searchModel = new BookingSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * @SWG\Post(
     *     path="/booking?XDEBUG_SESSION_START=123456",
     *     tags={"Booking"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     description="Booking confirmation and door lock application init. Return parameters for booking confirmation (link to Application, user login/password, booking_id, keyboard password for door lock opening), as well send letter to tourist with those parameters",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),

     *     @SWG\Parameter( name = "booking", in="body", required=true, description = "New booking",  @SWG\Schema(ref="#/definitions/BookingNew")),

     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Booking")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Creates a new Booking model.
     * If creation is successful, return Response as Json string
     * @return mixed
     */
    public function actionCreateOld()
    {
        $model = new Booking();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //по хорошему бы грузить данные в форму и ее валидировать, а потом передавать содержимое формы в модель для добавления букинга....
        $modelAdded =  $model->addNewBooking(true); //добавляем букинг и посылаем писмьо пользователю (true)
        if ($modelAdded) {
            //$modelAdded->sendEmail($modelAdded->contact_email,$modelAdded); //пока письмо шлем сами
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($modelAdded->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
            return  $this->serializeBookingInfo($modelAdded);
        }
        throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
    }
    /**
     * Creates a new Booking model.
     * If creation is successful, return Response as Json string
     * @return mixed
     */
    public function actionCreateForOwner()
    {
        $form = new BookingForm();
        $form->load(Yii::$app->getRequest()->getBodyParams(),'');
        if ( $form->validate()) {
            try {
                $booking = $this->service->create($form,false,false, true); //без письма и потенциальным пользователем
                if ($booking) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $booking->id], true));
                } elseif (!$booking->hasErrors()) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
                return $this->serializeBooking($booking);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        else {
            throw new ServerErrorHttpException('Failed to create the object => '. \GuzzleHttp\json_encode($form->getFirstErrors()) );
        }
    }
    /**
     * @SWG\Get(
     *     path="/bookings",
     *     tags={"Booking"},
     *     description="Return all bookings model for authorized user",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/BookingViewByUser")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Displays all bookings model for guest(user)
     * @return mixed
     */
    public function actionBookings()
    {
        $bookings=[];
        if (Yii::$app->user->can('owner',[])) {
            //Запускаем длинный процесс получения заявок из MyRenta -> добавление букингов в базу и выдачу
            $user = User::findOne(Yii::$app->user->id);
            // затем списка для регистрации туристов
//            foreach ($user->owner->apartments as $object) {
                $response = MyRent::getBookingsForOwner($user->owner->external_id);//, $object->external_id);
                //в ответе должен быть массив Json  c букингами - их надо разобрать
                $response= \GuzzleHttp\json_decode($response,true);
                foreach ($response as $rentInfo) {
                    //$rentInfo = \GuzzleHttp\json_decode($rentInfo,true);
                    $config['externalId'] = $rentInfo["id"];
                    $config['startDateTimestamp'] = strtotime($rentInfo["from_date"]);
                    $config['endDateTimestamp'] = strtotime($rentInfo["until_date"]);
                   // $config['apartmentId'] = $object->id;
                    $config['externalApartmentId'] = $rentInfo["object_id"];
                    $config['apartmentName'] = $rentInfo["object_name"];//$object->external_id;
                    $names = explode(' ', $rentInfo["contact_name"] );
                    $config['firstName'] = (is_array($names) && array_key_exists (1,$names))? $names[1]:'';//$rentInfo["contact_name"];
                    $config['secondName'] = (is_array($names) && array_key_exists (0,$names))? $names[0]:'';//$rentInfo["contact_name"];
                    $config['contactEmail'] = $rentInfo["contact_email"];
                    $config['owner'] = (isset($user->owner))?$user->owner : null;
                    $config['numberOfTourist'] = $rentInfo["total_guests"];
                    $config['status']=  ($rentInfo["total_guests"]=="Y")?Booking::STATUS_ACTIVE:Booking::STATUS_CANCELLED;  // $rentInfo["rent_status"];

                    $bookingForm = new BookingForm( $config);
                    if ($bookingForm->load($bookingForm, '') && $bookingForm->validate()) {
                        try {
                            $bookings[] = $this->service->create($bookingForm,false,false, false); //ни писем, ни пользователей
                        } catch (\DomainException $e) {
                            throw new BadRequestHttpException($e->getMessage(), null, $e);
                        }
                    } else {
                        throw new ServerErrorHttpException('Failed to create the object => ' . \GuzzleHttp\json_encode($bookingForm->getFirstErrors()));
                    }
                }
//            }

        }
//        $guest = Guest::find()->where(['user_id'=>Yii::$app->user->getId()])->one();
       else {
           $guest = Guest::find()->where(['user_id' => Yii::$app->user->getId()])->one();
//        $bookings = $guest->getBookings()->fromToday()->all();//$guest->bookings;
           if ($guest) {
//            $authorBookings = \backend\models\Booking::find()->where(['guest_id'=>$guest->id])->all();
//            foreach($guest->bookings as $booking){
//                if (!key_exists($booking->id, $bookings))
               $bookings = \backend\models\Booking::find()
                   ->where(['>=', 'end_date', date("Y-m-d", time()) . " 00:00:01"])
                   ->andWhere(['guest_id' => $guest->id])->all();
           }
//            }
       }
        return $bookings;
    }

    public function actionMyRent()
    {
        //$result=[];
        if (Yii::$app->user->can('owner', [])) {
            //Запускаем длинный процесс получения заявок из MyRenta -> добавление букингов в базу и выдачу
            $user = User::findOne(Yii::$app->user->id);
            // затем списка для регистрации туристов
            foreach ($user->owner->apartments as $object) {
                //$response = MyRent::getBookingsForOwner($user->owner->external_id, $object->external_id);
                $response = Yii::$app->getRequest()->getBodyParams();
//                $response = $bookingForm->load(Yii::$app->getRequest()->getBodyParams(),'');
                //в ответе должен быть массив Json  c букингами - их надо разобрать
                foreach ($response as $rentInfo) {

                    $config['externalId'] = $rentInfo["id"];
                    $config['startDateTimestamp'] = strtotime($rentInfo["from_date"])+ strtotime($rentInfo["from_time"],0);
                    $config['endDateTimestamp'] = strtotime($rentInfo["until_date"])+strtotime($rentInfo["until_time"],0);
                    //$config['apartmentId'] = $rentInfo["object_id"]//$object->id;
                    $config['externalApartmentId'] = $rentInfo["object_id"];//$object->external_id;
                    $config['apartmentName'] = $rentInfo["object_name"];
                    $config['firstName'] = $rentInfo["contact_name"];
                    $config['secondName'] = $rentInfo["contact_name"];
                    $config['contactEmail'] = $rentInfo["contact_email"];
                    $config['numberOfTourist'] = $rentInfo["total_guests"];
                    $config['status'] = Booking::STATUS_ACTIVE;  // $rentInfo["rent_status"];

                    $bookingForm = new BookingForm($config);
                    if ($bookingForm->validate()) {
                        try {
                            $booking = $this->service->create($bookingForm);
                        } catch (\DomainException $e) {
                            throw new BadRequestHttpException($e->getMessage(), null, $e);
                        }
                    } else {
                        throw new ServerErrorHttpException('Failed to create the object => ' . \GuzzleHttp\json_encode($bookingForm->getFirstErrors()));
                    }
                }
            }
        }
    }

    /**
     * @SWG\Get(
     *     path="/booking/view",
     *     tags={"Booking"},
     *     description="Return booking model finding by booking_id (internal door lock management system identity)",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name="id", in="query", required=true, type="integer", description = "Identity of booking from internal systems"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/BookingView")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Displays a single Booking model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * @SWG\Get(
     *     path="/booking/view-external",
     *     tags={"Booking"},
     *     description= "Return booking model finding by external id (external identity, which was gotten when booking created)",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization") ) ,
     *     @SWG\Parameter( name="externalId", in="query", required=true, type="string", description = "Identity of booking from external systems"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/BookingView")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     * Displays a single Booking model by external identity
     * @param string $externalId
     * @return mixed
     */
    public function actionViewExternal($externalId)
    {
        return $this->findModelExternal($externalId);
    }
    /**
     * @SWG\Put(
     *     path="/booking/update",
     *     tags={"Booking"},
     *     description="Change model finding by external id (external identity, which was gotten when booking created)",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name = "booking", in="body", required=true, description = "Update booking data",  @SWG\Schema(ref="#/definitions/BookingUpdate")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/BookingView")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Updates an existing Booking model.
     * If update is successful, return model
     * @param string $externalId
     * @return mixed
     */
    public function actionUpdate($externalId)
    {
        $model = $this->findModelExternal($externalId);

        $model->load(Yii::$app->request->getBodyParams(), '');

        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model;
    }
    /**
     * @SWG\Delete(
     *     path="/booking/delete",
     *     tags={"Booking"},
     *     description="Delete booking with this externalId",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name="externalId", in="query", required=true, type="string", description = "Identity of booking from external systems"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */


    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($externalId)
    {
        return  $this->findModelExternal($externalId)->delete();
    }

    /**
     * Finds the Booking model based on its primary key value from external system.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $externalId
     * @return Key the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelExternal($externalId)
    {
        if (($model = Booking::findOne(['external_id'=>$externalId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Key the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function serializeBookingInfo(Booking $booking): array
    {
        $listOfKeyboardPwd = $booking->keyboardPwds;
        $keyboardPwds = [];
        foreach ($listOfKeyboardPwd as $keyboardPwd){
            $keyboardPwds = array_merge( $keyboardPwds, $keyboardPwd->serializeKeyboardPwd());
        }
        return [
            'id' => $booking->id,
            'apartment_id' => $booking->apartment_id,
            'external_apartment_id' => $booking->apartment->external_id,
            'username' => $booking->author->user->username,
            'password' => $booking->temporary_password, //$booking->author->user->getNewReadablePassword(),
            'keyboardPwds' => $keyboardPwds,
        ];
    }

    public function serializeBooking($booking): array
    {
        $listOfKeyboardPwd = $booking->keyboardPwds;
        $keyboardPwds = [];
        foreach ($listOfKeyboardPwd as $keyboardPwd){
            $keyboardPwds = array_merge( $keyboardPwds, $keyboardPwd->serializeKeyboardPwd());
        }
        return [
            'id' => $booking->id,
            'apartment_id' => $booking->apartment_id,
            'external_apartment_id' => $booking->apartment->external_id,
            'author' => $booking->author->first_name.''.$booking->author->second_name,//$booking->author->user->username,
            'login'=>  str_replace(" ","_",trim($booking->author->first_name)),
            'password'=> $booking->external_id,
//            'password' => ($booking->author->user->temporaryPassword)? $booking->author->user->temporaryPassword :'',
            'keyboardPwds' => $keyboardPwds,

        ];
    }
    
}

/**
 *  @SWG\Definition(
 *     definition="Booking",
 *     type="object",
 *     @SWG\Property(property="booking_id", type="integer", description = "Internal booking identity",example="12"),
 *     @SWG\Property(property="apartment_id", type="integer", description = "Internal apartment identity",example="1"),
 *     @SWG\Property(property="apartment_name", type="string", description = "External apartment name",example="Zizi"),
 *     @SWG\Property(property="external_apartment_id", type="string", description = "External apartment identity",example="ID 45"),
 *     @SWG\Property(property="author", type="string", description = "Login username for DoorLock Mobile App",example="admin"),
 *     @SWG\Property(property="password", type="string", description = "Login password for DoorLock Mobile App - could not be in answer if user is already exist",example="admin"),
 *     @SWG\Property(property="keyboardPwds", type="array", @SWG\Items(ref="#/definitions/KeyboardPwd"),description = "Array of keyborad passwords for opening door locks (usually only one)"),
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="Guest",
 *     type="object",
 *     @SWG\Property(property="id", type="integer", description = "Internal guest identity",example="12"),
 *     @SWG\Property(property="first_name", type="string", description = "Guest's first name"),
 *     @SWG\Property(property="second_name", type="string", description = "Guest's second name"),
 *     @SWG\Property(property="contact_email", type="string", description = "Guest's e-mail, using for Mobile App username", example= "example@exa.com" ),
 *     @SWG\Property(property="user_id", type="integer",  description = "Mobile User id",example="2"),
 * )
 */

/**
 *  @SWG\Definition(
 *     definition="KeyboardPwd",
 *     type="object",
 *     @SWG\Property(property="door_lock_id", type="integer",description = "Internal booking door lock identity",example="46"),
 *     @SWG\Property(property="password_id", type="integer", description = "Internal booking keyboard password identity",example="345"),
 *     @SWG\Property(property="password_type", type="string" ,description = "Could be Permanent, Period, Cycle, Single",example="Permanent"),
 *     @SWG\Property(property="password", type="string",description = "Digital code for opening the door lock",example="73429034"),
 *     @SWG\Property(property="start_date", type="string",example="2017-05-29 14:00:00"),
 *     @SWG\Property(property="end_date", type="string",example="2017-06-01 12:30:00"),
 * )
 */



/**
 *  @SWG\Definition(
 *     definition="BookingNew",
 *     type="object",
 *     required= {
 *          "externalId",
 *          "externalApartmentId",
 *          "firstName",
 *          "secondName",
 *          "contactEmail",
 *          "startDate",
 *          "endDate",
 *          "numberOfTourist",
 *     "startDateTimestamp",
 *     "endDateTimestamp"
 *      },
 *     @SWG\Property(property="externalId", type="integer",description = "Identity of booking from external systems", example= "615731"),
 *     @SWG\Property(property="externalApartmentId", type="integer",description = "Identity of apartment from external systems", example= "249"),
 *     @SWG\Property(property="firstName", type="string", description = "Guest's first name"),
 *     @SWG\Property(property="secondName", type="string", description = "Guest's second name"),
 *     @SWG\Property(property="contactEmail", type="string", description = "Guest's e-mail, using for Mobile App username", example= "example@exa.com" ),
 *     @SWG\Property(property="startDate", type="string", description = "arrival date",example="2017-05-29 12:00:00"),
 *     @SWG\Property(property="endDate", type="string", description = "departure date",example="2017-06-05 14:00:00"),
 *     @SWG\Property(property="numberOfTourist", type="integer", description = "Total number of tourist in booking", example="3"),
 *     @SWG\Property(property="startDateTimestamp", type="long", description = "UNIX timestamp for arrival date",example="1501098754"),
 *     @SWG\Property(property="endDateTimestamp", type="long", description = "UNIX timestamp for departure date",example="1501357954"),

 * )
 */
/**
*  @SWG\Definition(
 *     definition="BookingUpdate",
 *     type="object",
 *     required= {
 *          "external_id"
 *      },
 *     @SWG\Property(property="external_id", type="string", description = "External booking identity",example="A 514"),
* )
 */

/**
 *  @SWG\Definition(
 *     definition="View",
 *     type="object",
 *     required= {
 *          "id"
 *      },
 *     @SWG\Property(property="id", type="integer",example="1")
 * )
 */

/**
 *  @SWG\Definition(
 *     definition="BookingView",
 *     type="object",
 *     @SWG\Property(property="id", type="integer", description = "Internal booking identity",example="12"),
 *     @SWG\Property(property="external_id", type="string", description = "External booking identity",example="A 514"),
 *     @SWG\Property(property="external_apartment_id", type="string", description = "External apartment identity",example="ID 45"),
 *     @SWG\Property(property="apartment_name", type="string", description = "External apartment name",example="Zizi"),
 *     @SWG\Property(property="start_date", type="string",example="2017-05-29 14:00:00"),
 *     @SWG\Property(property="end_date", type="string",example="2017-06-01 12:30:00"),
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="BookingViewByUser",
 *     type="array",
 *     @SWG\Items( ref="#/definitions/BookingView", description="Booking details"),
 * )
 */
