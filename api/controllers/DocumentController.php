<?php


namespace api\controllers;


use backend\models\DocumentSearch;
use Book;
use reception\entities\Booking\Booking;
use reception\entities\User\User;
use reception\forms\eVisitorForm;
use reception\forms\GuestDocumentAddForm;
use reception\repositories\Booking\DocumentRepository;
use reception\useCases\manage\Booking\DocumentManageService;
use function strtotime;
use Yii;
use reception\entities\Booking\Document;
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

use reception\services\MyRent\MyRent;



/**
 * BookingController implements the CRUD actions for Booking model.
 */
class DocumentController extends Controller
{
    private $documentRepository;
    private $service;

    public function __construct($id, $module, DocumentManageService $service, DocumentRepository $documentRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->documentRepository = $documentRepository;
        $this->service = $service;

    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'view','index','get-booking-documents'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete', 'view','index','get-booking-documents'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['receptionist','admin','mrz','owner','mobile','tourist'],
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



    public function prepareDataProvider($bookingId)
    {
        $searchModel = new DocumentSearch();
//        $searchModel->booking
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * @SWG\Post(
     *     path="/document",
     *     tags={"Booking"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     description="Adding new document for rurthe registration in eVisitor",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name = "documentForm", in="body", required=true, description = "Document info",  @SWG\Schema(ref="#/definitions/Document")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Document")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Creates a new Document model. without any photos
     * If creation is successful, return Response as Json string
     * @return mixed
     */

    /**
     * Creates a new Document model. without any photos
     * If creation is successful, return Response as Json string
     * @return mixed
     */
    public function actionCreateDocumentWithPhotos()
    {
        $form = new GuestDocumentAddForm();
        $form->load(Yii::$app->request->post(), '');
        if ($form->validate()) {
            try {
                $user = User::findOne (Yii::$app->user->id);
                $document = $this->service->addDocumentDataWithPhoto($form, $user);
                Yii::$app->getResponse()->setStatusCode(201);
                if ($document) {
                    $booking = $form->eVisitorForm->booking;//Booking::findByBookingIdentity($form->eVisitorForm->bookingId);
                    $registrations = $booking->registrations;
                    $result=[];
                    foreach ($registrations as $model){
                        $result[]= $this->serializeDocument($model->document, null,$booking);
                    }
                    return $result;
//                    $result = MyRentReception::addGuest($document, $form->eVisitorForm->bookingId, $form->eVisitorForm->eVisitor, Yii::$app->user->id);
//                    if ($result) {
//                        $this->service->updateRegistration($result);
//                        $this->service->checkin( $document, $booking );
//                    }
//                    return $this->serializeDocument($document, null ,$form->eVisitorForm->booking);
                }
                else throw new \DomainException("Can not build new document registration");
//                return $this->serializeDocument($document);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        else {
            Yii::$app->getResponse()->setStatusCode(501);
            throw new ServerErrorHttpException('Failed to add the object'.' '.json_encode ($form->PhotosForm->getErrors()).' '.json_encode ($form->eVisitorForm->getErrors()));
        }
    }
    /**
     * @SWG\Post(
     *     path="/document/add?XDEBUG_SESSION_START=123456",
     *     tags={"Booking"},
     *     consumes={"multipart/form-data"},
     *     description="Add document for guest",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name="Document Info", in="body", description = "Document information and images",  @SWG\Schema(ref="#/definitions/DocumentInfo")),
     *      @SWG\Parameter( name = "img1", in="formData", required=true,  type="file", description = "Photoimage of first document page to upload"),
     *      @SWG\Parameter( name = "img2", in="formData",   type="file", description = "Photoimage page file to upload"),
     *      @SWG\Parameter( name = "img3", in="formData",   type="file", description = "Photoimage page  file to upload"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Document")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Displays all bookings model for document(user)
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();
        foreach ($models as $model){
            $result[]= $this->serializeDocument($model);
        }
        return $result;

    }
    /**
     * Displays all documents model for booking($id)
     * @return array
     */
    public function actionGetBookingDocuments($id):array
    {
        $iDs =[];
        $result=[];
        $booking_id = (isset($id))?$id: Yii::$app->request->get()['id'];
        $booking = Booking::findOne($booking_id);

        if (isset($booking) && ( ($booking->apartment->user_id == Yii::$app->user->id) || ($booking->apartment->owner_id == Yii::$app->user->id ) || ($booking->author->user_id ==  Yii::$app->user->id))) {
            foreach ($booking->guests as $guest ) {
                $iDs[]=$guest->id;
            }
            $registrations = $booking->registrations;
            foreach ($registrations as $model){
                $result[]= $this->serializeDocument($model->document, null,$booking);
            }
//            $documents = $this->documentRepository->getForGuests($iDs);
//            foreach ($documents as $model){
//                $result[]= $this->serializeDocument($model);
//            }
        }

        return $result;

    }

    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

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
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
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
        if (($model = Booking::findOne(['external_id' => $externalId])) !== null) {
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
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function serializeDocument($document,$result=null, $booking=null): array
    {
        $images=[];$urls=[];
            foreach($document->images as $image){
                $urls[]=$image->getUploadedFileUrl('file_name');
            }
        return [
            'firstName' => $document->first_name,
            'secondName' => $document->second_name,
            'id' => $document->id,
            'bookingId' => 844,
            'numberOfDocument'=>$document->number,
            'city' =>$document->city,
            'gender' =>$document->gender,
            'date_of_issue' =>$document->date_of_issue,
            'validBefore' =>strtotime($document->valid_before)*1000,
            'country' =>$document->citizenship->name,
            'identityData' =>$document->documentType->code,
            'citizenshipOfBirth'=>$document->birthCitizenship->name,
            'address' =>$document->address,
            'dateOfBirth' => $document->date_of_birth,
            //'image_files'=>$images,
            'image_urls'=>$urls,
            'eVisitorID'=>"",
            "eVisitor"=>true,//$result
            'dateFrom'=>strTotime(date ("Y-m-d", strTotime($booking->start_date))." ".$booking->from_time)*1000,
            'dateTo'=>strTotime(date ("Y-m-d", strTotime($booking->end_date))." ".$booking->until_time)*1000
        ];
    }
}


/**
 * @SWG\Definition(
 *     definition="Document",
 *     type="object",
 *     @SWG\Property(property="id", type="integer", description = "Internal document identity",example="12"),
 *     @SWG\Property(property="first_name", type="string", description = "Document's first name"),
 *     @SWG\Property(property="second_name", type="string", description = "Document's second name"),
 *
 * )
 */

/**
 * @SWG\Definition(
 *     definition="DocumentInfo",
 *     type="object",
 *     required= {
 *     "firstName",
 *     "secondName",
 *     "identityData":"027",
 *     "numberOfDocument":"123456",
 *     "gender":"male",
 *     "country":"syr",
 *     "city":"Damask",
 *     "countryOfBirth":"syr",
 *     "cityOfBirth":"Damask",
 *     "dateOfBirth":"1972-10-08",
 *     "citizenshipOfBirth":"rus",
 *     "bookingId"
 *      },
 *     @SWG\Property(property="firstName", type="string",description = "First name of tourist", example= "serg"),
 *     @SWG\Property(property="secondName", type="string",description = "Second name of tourist", example= "serginio"),
 *
 *     @SWG\Property(property="identityData", type="string", description = "Document's e-mail, using for Mobile App username", example= "027" ),
 *     @SWG\Property(property="numberOfDocument", type="string", description = "Number of document",example="123456"),
 *     @SWG\Property(property="gender", type="string", description = "Gender (male/female)",example="male"),
 *     @SWG\Property(property="country", type="string", description = "Citizenship", example="syr"),
 *     @SWG\Property(property="city", type="string", description = "Current city in adress",example="Damask"),
 *     @SWG\Property(property="countryOfBirth", type="string", description = "Country of birth",example="syr"),
 *      @SWG\Property(property="dateOfBirth", type="string", description = "Date of birth", example="1972-10-08"),
 *      @SWG\Property(property="citizenshipOfBirth", type="string", description = "Citizenship of birth", example="rus"),
 *      @SWG\Property(property="bookingId", type="string", description = "Booking internal or external identity", example="616297"),
 * )
 */





