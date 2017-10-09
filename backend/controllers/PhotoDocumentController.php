<?php

namespace backend\controllers;

use reception\useCases\manage\Booking\DocumentPhotoManageService;
use Yii;
use reception\entities\Booking\DocumentPhoto;
use backend\models\PhotoDocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PhotoDocumentController implements the CRUD actions for PhotoDocument model.
 */
class PhotoDocumentController extends Controller
{
    private $service;

    public function __construct($id, $module, DocumentPhotoManageService $service, $config = [])
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PhotoDocument models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotoDocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhotoDocument model.
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
     * Creates a new PhotoDocument model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocumentPhoto();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->file_name = UploadedFile::getInstances($model, 'file_name');
            $model->save();
//            $image = UploadedFile::getInstance($model,'file_name');
//            $imageName = 'doc_image_'.$model->id.'.'.$image->getExtension() ;
//            $image->saveAs(Yii::getAlias('@documentPath').'/'.$imageName);
//            $model->file_name = $imageName;
//            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
            $faces=$this->service->extractFaces($model);
            if ($faces && (count($model->faces)>0)) {
                Yii::$app->session->setFlash('success', 'Faces detected');
                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                Yii::$app->session->setFlash('error', 'No one face was detected');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }
    /**
     * Updates an existing PhotoDocument model.
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
     * Deletes an existing PhotoDocument model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhotoDocument model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhotoDocument the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentPhoto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
