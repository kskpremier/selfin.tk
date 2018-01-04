<?php
/**
 * Created by PhpStorm.
 * User: SVRybin
 * Date: 14.4.2017.
 * Time: 2:24
 */

namespace api\controllers;

use reception\entities\User\User;
use reception\forms\MyRent\MyRentUserForm;
use reception\repositories\UserRepository;
use reception\useCases\manage\Booking\BookingManageService;
use reception\useCases\manage\MyRent\MyRentManageService;
use reception\useCases\manage\UserManageService;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;

class MobileController extends Controller
{
    private $user;
    private $service;
    private $bookingService;
//    private $serviceUser;


    public function __construct($id, $module, MyRentManageService $service, BookingManageService $bookingService,UserRepository $user, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->user = $user;
        $this->service = $service;
        $this->bookingService = $bookingService;
//        $this->serviceUser = $serviceUser;

    }

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
            'only' => ['create', 'update', 'delete','index'],
            'rules' => [
                [
                    'allow' => true,
                    // ролей пока нет, поэтому я закоментировал
                    'roles' => ['admin'],
                ],
            ],
        ];
        return $behaviors;
    }


    /**
     * Creates a new User model for external MyRent User
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionCreate()
    {
        $form = new MyRentUserForm();
        $form->load(Yii::$app->request->getBodyParams(), '');
        if ($form->validate()) {
            try {
                $user = $this->service->createMyRentUser($form);
                Yii::$app->getResponse()->setStatusCode(201);
                return $user;
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->getResponse()->setStatusCode(401);
                return '{"Warning":"Ask administrator to check log files"}';
            }
        }
        Yii::$app->getResponse()->setStatusCode(401);
        return $form;
    }




//    public function actionDelete($id): void
//    {
//        try {
//            $this->service->remove($id);
//            Yii::$app->getResponse()->setStatusCode(204);
//        } catch (\DomainException $e) {
//            throw new BadRequestHttpException($e->getMessage(), null, $e);
//        }
//    }


//    public function actionIndex()
//    {
//        return User::findOne(\Yii::$app->user->id);
////        $searchModel = new UserSearch();
////        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
////        return $dataProvider;
//    }
//
//    public function actionUpdate()
//    {
//        $model = $this->findModel();
//        $model->load(Yii::$app->request->getBodyParams(), '');
////        if ($model->save() === false && !$model->hasErrors()) {
////            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
////        }
////        return $model;
//        return json_encode(Yii::$app->request->getBodyParams());
//    }
    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch'],
        ];
    }
/**
 * @return User
 */
    private function findModel()
    {
        return User::findOne(\Yii::$app->user->id);
    }


    private function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->username,
            'email' => $user->email,
            'date' => [
                'created' => DateHelper::formatApi($user->created_at),
                'updated' => DateHelper::formatApi($user->updated_at),
            ],
            'status' => [
                'code' => $user->status,
                'name' => UserHelper::statusName($user->status),
            ],
        ];
    }
}
