<?php

namespace backend\controllers;

use reception\repositories\Booking\BookingRepository;
use reception\useCases\manage\Booking\SynchroService;
use reception\useCases\manage\Feefo\FeefoManageService;
use reception\useCases\manage\MyRent\MyRentManageService;
use Yii;
use reception\entities\Feefo\FeefoProducts;
use reception\entities\Feefo\FeefoProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeefoProductsController implements the CRUD actions for FeefoProducts model.
 */
class FeefoProductsController extends Controller
{
    private $service;
    private $myRentService;
    private $synchroService;
    private $booking;

    public function __construct($id, $module, FeefoManageService $service, MyRentManageService $myRentService, BookingRepository $booking, SynchroService $synchroService, $config = [])
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
     * Lists all FeefoProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='feefo';
        $searchModel = new FeefoProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionDownload($fileName)
    {
        return Yii::$app->response->sendFile($fileName);
    }

    /**
     * Displays a single FeefoProducts model.
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
     * Displays a single FeefoProducts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionLook($object_id)
    {
        $this->layout='feefo';
        return $this->render('view', [
            'model' => $this->findModelByObject($object_id),
        ]);
    }

    /**
     * Creates a new FeefoProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout='feefo';
        $model = new FeefoProducts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FeefoProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout='feefo';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FeefoProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout='feefo';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FeefoProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeefoProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FeefoProducts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the FeefoProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeefoProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByObject($id)
    {
        if (($model = FeefoProducts::find()->where(['object_id'=>$id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
