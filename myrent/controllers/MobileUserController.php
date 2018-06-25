<?php

namespace myrent\controllers;

use reception\forms\manage\User\UserCreateForm;
use reception\forms\manage\User\UserEditForm;
use reception\forms\MyRent\MyRentUserForm;
use reception\repositories\Booking\BookingRepository;
use reception\repositories\UserRepository;
use reception\useCases\manage\MyRent\MyRentManageService;
use reception\useCases\manage\UserManageService;
use Yii;
use yii\filters\AccessControl;
use reception\entities\User\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class MobileUserController extends Controller
{
    private $service;
    private $myRent;
    private $userRepository;
    private $bookingRepository;

    public function __construct($id, $module, UserManageService $service, MyRentManageService $myRent,
                                BookingRepository $bookingRepository,
                                UserRepository $userRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->myRent = $myRent;
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index','create', 'update', 'delete','view'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['receptionist','admin'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function verbs()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new UserCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->service->create($form);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }
    /**
     * Creates a new User model for MyRentReception.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateMyrent($user, $booking=null)
    {
        $superuser = $this->userRepository->get($user);
        if ($booking) $booking = $this->bookingRepository->get($booking);
        $form = new MyRentUserForm(['user_id'=>$superuser->external_id, 'booking_id'=>($booking)?$booking->id:null, 'roles'=>[]]);
        $form->load(Yii::$app->request->post());
        if ($form->validate()) {
            try {
                $user = $this->myRent->createMyRentUser($form);
                Yii::$app->session->setFlash('User'.$user->username.' was created successfully');
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        else {
                Yii::$app->session->setFlash('error', 'Something went wrong -> '. json_encode ($form->getErrors() ));
            }
        return $this->render('/users/create_my_rent_user', [
            'model' => $form,
        ]);
    }

    /**
     * Update User model for MyRentReception.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSynchro($id)
    {
        $user = $this->findModel($id);

        if ($user) {
            try {
                $this->myRent->updateMyRentUser($user);
                if ($user->owners)
                foreach ($user->owners as $owner) {
                    $this->myRent->updateBookings($user,$owner->id);
                }
                else $this->myRent->updateBookings($user);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(['view', 'id' => $user->id]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);

        $form = new UserEditForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($user->id, $form);
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'user' => $user,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->service->remove($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
