<?php

namespace backend\controllers;

use reception\forms\MyRent\FeefoScheduleForm;
use reception\useCases\manage\Booking\SynchroService;
use reception\useCases\manage\Feefo\FeefoScheduleManageService;
use reception\useCases\manage\MyRent\MyRentManageService;
use Yii;
use reception\entities\MyRent\FeefoSchedule;
use reception\entities\MyRent\FeefoScheduleSearch;
use reception\repositories\Feefo\FeefoScheduleRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeefoScheduleController implements the CRUD actions for FeefoSchedule model.
 */
class FeefoScheduleController extends Controller
{
    private $service;
    private $myRentService;
    private $synchroService;

    private $feefoScheduleRepository;

    public function __construct($id, $module, FeefoScheduleManageService $service, MyRentManageService $myRentService,  SynchroService $synchroService, FeefoScheduleRepository $feefoScheduleRepository, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->service = $service;
        $this->myRentService = $myRentService;
        $this->synchroService = $synchroService;
        $this->feefoScheduleRepository = $feefoScheduleRepository;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
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
     * Lists all FeefoSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='feefo';
        $searchModel = new FeefoScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FeefoSchedule model.
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
     * Creates a new FeefoSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout='feefo';
        $form = new FeefoScheduleForm();
        $searchModel = new FeefoScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $form->from = (isset($_POST['from'])&&$_POST['from']!='')?strtotime($_POST['from']):time();
        $form->to = (isset($_POST['to'])&&$_POST['to']!='')?strtotime($_POST['to']):time()+7*24*60*60;

        if (isset($_POST['keylist']) && $form->load(Yii::$app->request->post()) && $form->validate()) {
                $keys = $_POST['keylist'];

                $scheduled = $this->service->create($form,$keys);
            if (count($scheduled)) {
                Yii::$app->session->setFlash('success', count($scheduled).' objects were successfully added to schedule.');
            }
            else Yii::$app->session->setFlash('error', 'Something went wrong');
            $this->redirect(['index']);
        }

        return $this->render('create', [
            'form' => $form,
            'dataProvider'=> $dataProvider,
            'searchModel'=>$searchModel
        ]);
    }

    /**
     * Updates an existing FeefoSchedule model.
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
     * Deletes an existing FeefoSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        if (isset($_POST['keylist'])) {
            foreach ($_POST['keylist'] as $key)
            $this->findModel($key)->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the FeefoSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeefoSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->feefoScheduleRepository->get($id))) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
