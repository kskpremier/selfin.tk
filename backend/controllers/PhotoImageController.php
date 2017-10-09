<?php

namespace backend\controllers;


use reception\forms\GuestPhotoForm;
use reception\useCases\manage\Booking\PhotoManageService;
use Yii;
use reception\entities\Booking\Photo;
use backend\models\PhotoImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PhotoImageController implements the CRUD actions for PhotoImage model.
 */
class PhotoImageController extends Controller
{
    private $service;

    public function __construct($id, $module, PhotoManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
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
//                    'delete' => ['POST',''],
                ],
            ],
        ];
    }

    /**
     * Lists all PhotoImage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotoImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhotoImage model.
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
     * Creates a new PhotoImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bookingId=null)
    {
        $form = new GuestPhotoForm(['booking_id'=>$bookingId,'user_id'=>Yii::$app->user->id]);

        if ($form->load(Yii::$app->request->post(),'') && $form->validate()) {
            $model=$this->service->create($form);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Detect faces on Image and create a new Face models.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDetectFace($id)
    {
        $model = $this->findModel($id); $faces=[];
        if ($model) {
            if ($faces=$this->service->extractFaces($model) && (count($faces)>0)) {
                Yii::$app->session->setFlash('success', 'Faces detected');
                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                Yii::$app->session->setFlash('error', 'No one face was detected');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

    /**
     * Updates an existing PhotoImage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PhotoImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //надо грохнуть этот файл с диска
        if (unlink($model->getFileName())) {
            $model->delete();
        }
        else new NotFoundHttpException('The requested file does not exist.');

        Yii::$app->session->setFlash('success', 'Photo was successfully deleted');
        $this->redirect(['index']);
    }

    /**
     * Finds the PhotoImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhotoImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
