<?php

namespace backend\controllers;

use reception\entities\Booking\Booking;
use reception\repositories\Booking\FaceComparationRepository;
use reception\useCases\manage\Booking\FaceComparationManageService;
use Yii;
use yii\data\ArrayDataProvider;
use backend\models\FaceComparation;
use backend\models\FaceComparationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaceComparationController implements the CRUD actions for FaceComparation model.
 */
class FaceComparationController extends Controller
{
    private $service;
    private $repository;

    public function __construct($id, $module, FaceComparationManageService $service, FaceComparationRepository $faceComparationRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->repository = $faceComparationRepository;
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
     * Lists all FaceComparation models.
     * @return mixed
     */
    public function actionIndex($origin_id=null)
    {
        $searchModel = new FaceComparationSearch();
        $searchModel->origin_id = ($origin_id!=null) ? $origin_id : $searchModel->origin_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all FaceComparation models with maximun probability
     * @return mixed
     */
    public function actionBookingIndex($id)
    {
        $booking = Booking::findOne($id);

        $searchModel = new FaceComparationSearch();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->repository->getByBooking ($booking),
            'sort' => [
                'attributes' => ['origin_id', 'face_id', 'probability'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaceComparation model.
     * @param integer $origin_id
     * @param string $face_id
     * @return mixed
     */
    public function actionView($origin_id, $face_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($origin_id, $face_id),
        ]);
    }

    /**
     * Creates a new FaceComparation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaceComparation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'origin_id' => $model->origin_id, 'face_id' => $model->face_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FaceComparation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $origin_id
     * @param string $face_id
     * @return mixed
     */
    public function actionUpdate($origin_id, $face_id)
    {
        $model = $this->findModel($origin_id, $face_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'origin_id' => $model->origin_id, 'face_id' => $model->face_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FaceComparation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $origin_id
     * @param string $face_id
     * @return mixed
     */
    public function actionDelete($origin_id, $face_id)
    {
        $this->findModel($origin_id, $face_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaceComparation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $origin_id
     * @param string $face_id
     * @return FaceComparation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($origin_id, $face_id)
    {
        if (($model = FaceComparation::findOne(['origin_id' => $origin_id, 'face_id' => $face_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
