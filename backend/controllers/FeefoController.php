<?php

namespace backend\controllers;

use backend\models\ObjectsSearch;
use backend\models\Rents;
use function is_array;
use reception\entities\User\User;
use reception\forms\MyRent\FeefoSalesForm;
use reception\repositories\Booking\BookingRepository;
use reception\repositories\Objects\ObjectsReadRepository;
use reception\services\MyRent\MyRent;
use backend\models\RentsAvailabilitySearch;
use reception\useCases\manage\Booking\SynchroService;
use reception\useCases\manage\Feefo\FeefoManageService;
use reception\useCases\manage\MyRent\MyRentManageService;
use const SORT_ASC;
use Yii;
use reception\entities\Feefo\FeefoSales;
use reception\entities\Feefo\FeefoSalesSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeefoController implements the CRUD actions for FeefoSales model.
 */
class FeefoController extends Controller
{
    private $service;
    private $myRentService;
    private $synchroService;
    private $objects;

    public function __construct($id, $module, FeefoManageService $service, MyRentManageService $myRentService, ObjectsReadRepository $objects, SynchroService $synchroService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->objects = $objects;
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
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index', 'create', 'update', 'delete', 'view'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['feefo', 'admin'],
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
     * Lists all FeefoSales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='feefo';
        $searchModel = new FeefoSalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FeefoSales model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout='feefo';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FeefoSales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout='feefo';
        $user = User::findOne(Yii::$app->user->id);
        $search = new ObjectsSearch(['userIds' => $user->external_id]);
        $dataProvider = $search->search(Yii::$app->request->queryParams,'');
        $lastUpdate=strtotime("2018-01-01");
        $user = User::findOne(Yii::$app->user->id);
        $model = new FeefoSalesForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $rents = $this->synchroService->synchroChangesRentsForUser($user, $lastUpdate, time(), (Yii::$app->user->can('owner',[]))?$user->owner->external_id:null);
            $this->service->addProducts($rents);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('objects', [
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLink() {
        if (isset($_POST['keylist'])) {
            $keys = $_POST['keylist'];
            if (!is_array($keys)) {
                echo Json::encode([
                    'status' => 'error',
                    'total' => 0
                ]);
                return;
            }
            $start = (isset($_POST['start'])&&$_POST['start']!='')?$_POST['start']:date("Y-m-d",time());
            $until = (isset($_POST['until'])&&$_POST['until']!='')?$_POST['until']:date("Y-m-d",time()+7*24*60*60);
            $rents = \reception\entities\MyRent\Rents::find()->joinWith('object')
                                                            ->where(['object_id'=>$keys])
                                                            ->andFilterWhere(['>','from_date',$start])
                                                            ->andFilterWhere(['<','until_date',$until])
                                                            ->active()->withContactData()->all();
            $result = $this->service->addSales($rents);
            echo json_encode([
                'status' => 'success',
                'total' => count($result)
            ]);
        }
        echo json_encode([
            'status' => 'error',
            'total' => 0
        ]);
    }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            $rent = \reception\entities\MyRent\Rents::findOne($model->rent_id);
            $result = $this->service->addOneFeefoSale($rent);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->redirect(['index']);

    }

    public function actionCatalog() {
            if (!isset($_POST['keylist'])||!is_array($_POST['keylist'])) {
                $result = Json::encode([
                    'status' => 'error',
                    'total' => 0,
                    'message' => "Please, check as minimum one object for Product Catalog!"
                ]);
                return $result;
            }
            $objects = $this->objects->getAllByKeys($_POST['keylist']);
            $result = $this->service->addProducts($objects);
            echo json_encode([
                'status' => 'success',
                'total' => count($result),
                'message' => count($result)." objects were added to Product Catalog successfully!"
            ]);

    }

    public function actionSchedule() {
        if (!isset($_POST['keylist'])||!isset($_POST['start'])||(isset($_POST['start'])&&$_POST['start']=='') ) {
            $result = Json::encode([
                'status' => 'error',
                'total' => 0,
                'message' => (!isset($_POST['start'])||$_POST['start']=='')?"Please, set starting data for schedule! ":"Please, check as minimum one object to be scheduled!"
            ]);
            return $result;
        }
        $start = $_POST['start'];
        $until = (isset($_POST['until'])&&$_POST['until']!='')?$_POST['until']:date("Y-m-d",strtotime($start)+31*24*60*60);
        $keys = (is_array($_POST['keylist']))?$_POST['keylist']:[$_POST['keylist']];
        $result = $this->service->addSchedule($keys,$start,$until);
        echo json_encode([
            'status' => 'success',
            'start' => $start,//date("Y-m-d",$start),
            'until' => $until,//date("Y-m-d",$until),
            'total' => count($result),
            'message' => count($result)." objects were scheduled successfully!"
        ]);
    }

    public function actionScheduleRemove() {

        if (!is_array($_POST['keylist'])) {
            $result = Json::encode([
                'status' => 'error',
                'total' => 0,
                'message' => "Please, check as minimum one object to be unscheduled!"
            ]);
            return $result;
        }
        $result = $this->service->removeSchedule($_POST['keylist']);
        echo json_encode([
            'status' => 'success',
            'total' => count($result),
            'message' => count($result)." objects were removed from schedule successfully!"
        ]);
    }


    public function actionDownload($fileName)
    {
        return Yii::$app->response->sendFile($fileName);
    }
    /**
     * Updates an existing FeefoSales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FeefoSales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FeefoSales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeefoSales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FeefoSales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
