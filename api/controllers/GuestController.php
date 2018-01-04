<?php


namespace api\controllers;


use backend\models\GuestSearch;
use reception\forms\eVisitorForm;
use reception\repositories\Booking\GuestRepository;
use reception\useCases\manage\Booking\GuestManageService;
use Yii;
use reception\entities\Booking\Guest;
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
class GuestController extends Controller
{
    private $guest;
    private $service;

    public function __construct($id, $module, GuestManageService $service, GuestRepository $guest, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->guest = $guest;
        $this->service = $service;

    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'view'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete', 'view'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['receptionist'],
                ],
                [
                    'allow' => true,
                    'actions' => ['bookings'],
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
            if (!Yii::$app->user->can('createBooking', [])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['delete'])) {
            if (!Yii::$app->user->can('deleteBooking', [])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['view'])) {
            if (!Yii::$app->user->can('viewBooking', [])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['update'])) {
            if (!Yii::$app->user->can('updateBooking', [])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }

    }

    public function prepareDataProvider()
    {
        $searchModel = new GuestSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * @SWG\Post(
     *     path="/guest",
     *     tags={"Booking"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     description="Adding new guest for rurthe registration in eVisitor",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name = "guestForm", in="body", required=true, description = "Guest info",  @SWG\Schema(ref="#/definitions/GuestNew")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Guest")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Creates a new Guest model.
     * If creation is successful, return Response as Json string
     * @return mixed
     */

    public function actionCreate()
    {
        $form = new eVisitorForm();

        if ($form->load(Yii::$app->getRequest()->getBodyParams(), '') && $form->validate()) {
            try {
                $guest = $this->service->create($form);
                if ($guest) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $guest->id], true));
                } elseif (!$guest->hasErrors()) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
                return $this->serializeBooking($guest);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
    }
    /**
     * @SWG\Get(
     *     path="/guests",
     *     tags={"Booking"},
     *     description="Return all bookings model for authorized user",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name="bookingId", in="query", required=true, type="integer", description = "Identity of booking from external systems"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/GuestList")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */

    /**
     * Displays all bookings model for guest(user)
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuestSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();
        foreach ($models as $model){
            $result[]= $this->serializeGuest($model);
        }
        return $result;

    }

    /**
     * @SWG\Get(
     *     path="/guest/view",
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
     * Displays a single Guest model.
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
    public function actionDelete($externalId)
    {
        return $this->findModelExternal($externalId)->delete();
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
        if (($model = Guest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function serializeGuest(Guest $guest): array
    {

        return [
            'id' => $guest->id,
            'apartment_id' => $guest->apartment_id,
            'external_apartment_id' => $guest->apartment->external_id,
            'username' => $guest->author->user->username,
            'password' => $guest->temporary_password, //$guest->author->user->getNewReadablePassword(),
            //'keyboardPwds' => $guest->bookings->keyboardPwds,
        ];
    }

    public function serializeBooking($guest): array
    {
        $listOfKeyboardPwd = $guest->keyboardPwds;
        $keyboardPwds = [];
        foreach ($listOfKeyboardPwd as $keyboardPwd) {
            $keyboardPwds = array_merge($keyboardPwds, $keyboardPwd->serializeKeyboardPwd());
        }
        return [
            'first_name' => $guest->id,
            'second_name' => $guest->apartment_id,
            'external_apartment_id' => $guest->apartment->external_id,
            'author' => $guest->author->user->username,
//            'password' => ($guest->author->user->temporaryPassword)? $guest->author->user->temporaryPassword :'',
            'keyboardPwds' => $keyboardPwds,
        ];
    }

}


