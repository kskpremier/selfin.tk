<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 29.05.17
 * Time: 23:57
 */

namespace api\controllers;


use backend\models\ApartmentSearch;
use const CURLGSSAPI_DELEGATION_POLICY_FLAG;
use reception\entities\MyRent\Rents;
use reception\forms\BookingForm;
use reception\forms\BookingFormForNewApartments;
use reception\forms\MyRent\ApartmentForm;
use reception\forms\MyRent\ContactForm;
use reception\forms\MyRent\RentForm;
use reception\repositories\Booking\BookingRepository;
use reception\useCases\manage\Booking\BookingManageService;
use reception\useCases\manage\Booking\SynchroService;
use reception\useCases\manage\MyRent\MyRentManageService;
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
    private $myRentService;
    private $synchroService;


    public function __construct($id, $module, BookingManageService $service, MyRentManageService $myRentService, BookingRepository $booking, SynchroService $synchroService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->booking = $booking;
        $this->service = $service;
        $this->myRentService = $myRentService;
        $this->synchroService = $synchroService;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete','view','view-external','bookings','rents','booking'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete','view','view-external','bookings','rents','booking','create-for-owner','apartments'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['receptionist','owner','mobile'],
                ],
                [
                    'allow' => true,
                    'actions'=>['bookings','rents'],
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
                $booking = $this->service->getKeys($form);
                if ($booking) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                } elseif (!$booking->hasErrors()) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
                return $this->serializeBooking($booking);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        else {
            $e = new ServerErrorHttpException('Failed to create the object => '. \GuzzleHttp\json_encode($form->getFirstErrors()));
            Yii::$app->errorHandler->logException($e);
            throw $e;
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
    public function actionBookingsOld()
    {
        $request = Yii::$app->request;
        $user = User::findOne(Yii::$app->user->id);
        $from = (!$request->get('date'))? date("Y-m-d", time()):$request->get('date') ;
        $to = $request->get('to');
        $to = ($to)? $to:$from;
        $bookings=[];
        $updateTime = time();
        $lastUpdate =  $user->myrent_update;
        //если пользователь владелец или рецепционист, то обновим его апартаменты и букинги
        if ( Yii::$app->user->can('mobile',[]) || Yii::$app->user->can('owner',[]) || Yii::$app->user->can('receptionist',[]) ) {
            if (($updateTime - $user->updated_at) > MyRent::MyRent_UPDATE_INTERVAL) {
                //обновляем список апартаментов у пользователя
                try {
                 if  ( Yii::$app->user->can('mobile',[]) ){
                        if ($updateTime - $user->myrent_update > MyRent::MyRent_USER_UPDATE_INTERVAL) {
                            $this->myRentService->updateMyRentUser($user);
                        }
                        $rentList = MyRent::getBookingsUpdateForUser($user->external_id, date("Y-m-d H:i:s",$lastUpdate));
                        $owner_id=null;
                    }
                    else {
                        //$this->myRentService->updateMyRentUser($user);
                        $owner_id = $user->owner->external_id;
                        $rentList = MyRent::getBookingsUpdateForOwner($owner_id, date("Y-m-d H:i:s",$lastUpdate));
                    }
                //Запускаем длинный процесс получения заявок из MyRenta -> добавление букингов в базу и выдачу
                foreach ($rentList as $rentInfo) {
                    $rent = new RentForm($rentInfo);
                    $rent->load($rentInfo, '');
                    try {
                        if ($rent->validate()) {
                            $this->service->updateBookings($rent, $user->id, $updateTime, $owner_id);
                            } else throw new \DomainException ('Failed to create the object => ' . json_encode($rent->getFirstErrors()));
                        } catch  (\DomainException $e) { Yii::$app->errorHandler->logException($e); }
                    }
                } catch (\DomainException $e) { Yii::$app->errorHandler->logException($e); }
                $this->myRentService->saveUpdateTime($user, $updateTime);
            }
            //найти все букинге в базе, независимо от статуса на дату запроса для owner или receptionist
            $bookings = ( Yii::$app->user->can('mobile',[]) )? $this->booking->getBookingsByMobileUser($user->id,$from,$to) :
                $this->booking->getBookingsByOwner($user->owner->external_id,$from,$to);
        }
    else
       { // иначе запрашивающий просто турист
           //найти все букинги , со статусом Активные для данного гостя (?)
           $guest = Guest::find()->where(['user_id' => Yii::$app->user->getId()])->one();
           if ($guest)
            $bookings = $this->booking->getBookingsByGuest($guest,$from,$to);
       }
       return $bookings;
    }

    public function actionBookings(){
        $request = Yii::$app->request;
        $user = User::findOne(Yii::$app->user->id);
        $from = (!$request->get('date'))? date("Y-m-d", time()):$request->get('date') ;
        $to = $request->get('to');
        $to = ($to)? $to:$from;
        $bookings=[];
        $updateTime = time();
        if ( Yii::$app->user->can('mobile',[]) || Yii::$app->user->can('owner',[]) || Yii::$app->user->can('receptionist',[]) ) {
//            if (($updateTime - $user->myrent_update) > MyRent::MyRent_USER_UPDATE_INTERVAL) {
//                $apartments = $this->synchroService->synchroApartmentsForUser($user, $updateTime, (Yii::$app->user->can('owner',[])&&! Yii::$app->user->can('mobile',[]))?$user->owner->id:null);
//                $rents = $this->synchroService->synchroRentsForUser($user, $updateTime, (Yii::$app->user->can('owner',[])&&! Yii::$app->user->can('mobile',[]))?$user->owner->id:null);
//            }
//            else $rents = $this->synchroService->synchroChangesRentsForUser($user, $lastUpdate, $updateTime, (Yii::$app->user->can('owner',[]))?$user->owner->external_id:null);
            if (($updateTime - $user->myrent_update) > MyRent::MyRent_UPDATE_INTERVAL)
                $rents = $this->synchroService->synchroChangesRentsForUser($user, $user->myrent_update,
                    $updateTime, (Yii::$app->user->can('owner',[]))?$user->owner->external_id:null);
            //найти все букинге в базе, независимо от статуса на дату запроса для owner или receptionist
            $bookings = ( Yii::$app->user->can('mobile',[]) )? $this->booking->getBookingsByMobileUser($user->id,$from,$to) :
                                                                                $this->booking->getBookingsByOwner($user->owner->external_id,$from,$to);
        }
        else {
            $guest = Guest::find()->where(['user_id' => Yii::$app->user->getId()])->one();
            if ($guest)
                $bookings = $this->booking->getBookingsByGuest($guest,$from,$to);
        }
        return $this->serializeRents($bookings);
    }

    public function actionMyRent()
    {
        //$result=[];
        if (Yii::$app->user->can('owner', [])) {
            //Запускаем длинный процесс получения заявок из MyRenta -> добавление букингов в базу и выдачу
            $user = User::findOne(Yii::$app->user->id);
            // затем списка для регистрации туристов
            foreach ($user->owner->apartments as $object) {
                //$response = MyRentReception::getBookingsForOwner($user->owner->external_id, $object->external_id);
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


    public function actionApartments()
    {
        $searchModel = new ApartmentSearch(['user'=>Yii::$app->getUser()->getId()]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        foreach ($dataProvider->getModels() as $apartment) {
            $result[] = $this->serializeAaprtment($apartment);
        }
        return $result;
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

    /**
     * Give a unique link on a new User portal model for external MyRentReception User

     * @return string
     */
    public function actionGetLink()
    {
        $user = User::findOne(Yii::$app->user->id);
        if ( Yii::$app->user->can('mobile',[]) )
            return ["url"=>"https://app.my-rent.net/users/login?id=".$user->guid];
        elseif ( Yii::$app->user->can('owner',[]) )
            return ["url"=>"https://ow.my-rent.net/".$user->owner->guid];
       elseif ( Yii::$app->user->can('tourist',[]) ){
            $bookings = $this->service->getGuestBooking($user->guest->id);
            if (count ($bookings) ==0){
                return["url"=>"https://app.my-rent.net"];
            }
            else return ["url"=>"https://rent.my-rent.net/".$bookings[0]->guid];
       }
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

    public function serializeAaprtment ($apartment){
        return [
            'id' => $apartment->id,
            'name' => $apartment->name,
//            'external_apartment_id' => $apartment->external_id,
            'city_name'=>$apartment->city_name,
            'address'=>$apartment->adress,
            'latitude'=>$apartment->latitude,
            'longitude'=>$apartment->longitude,
            'user_id'=>$apartment->user_id
        ];
    }

    public function serializeRents($bookings)
    {
        
        $rents = [];
        foreach ($bookings as $booking) {
            $rent = Rents::findOne($booking->external_id);
            $guests = $booking->guests;
            $number_of_guest = count($guests);
            $duration = intdiv((strtotime($booking->end_date) - strtotime($booking->start_date)) / 24 / 60, 60);
            $rents[] = [
                'booking_id' => $booking->id,
                'external_booking_id' => $booking->external_id,
                'start_date' => date("Y-m-d", strtotime($booking->start_date)) . " " . date("H:i", strtotime($booking->from_time)),
                'end_date' => date("Y-m-d", strtotime($booking->end_date)) . " " . date("H:i", strtotime($booking->until_time)),
                'apartment_id' => $booking->apartment_id,
                'apartment_name' => $booking->apartment->name,
                'external_apartment_id' => $booking->apartment->external_id,
                'rent_status' => $rent->rentStatus ? $rent->rentStatus->name ?? '' : '',


                'url' => "https://app.my-rent.net/users/login_rent?id=" . $booking->guid,
                'color' =>  $rent->rentStatus ? $rent->rentStatus->color ?? '' : '',
                'price' => $booking->price . $booking->label,
                'paid' => ($booking->paid == "N") ? false : true,
                'duration' =>   intdiv((strtotime($booking->end_date) - strtotime($booking->start_date)) / 24 / 60, 60),
                'number_of_guests' => $booking->number_of_tourist,
                'address' => $booking->apartment->adress . ", " . $booking->apartment->city_name,
                'latitude' => $booking->apartment->latitude,
                'longitude' =>  $booking->apartment->longitude,
                'note' =>  $booking->note,
                'contact' => $booking->author->contact_name,
                'contact_email' => $booking->author->contact_email,
                'contact_tel' =>$booking->author->contact_tel,
                "contact_country" => $booking->author->contact_country,
                "contact_country_code" => $booking->author->contact_country_code1
            ];
        }
        return $rents;
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
