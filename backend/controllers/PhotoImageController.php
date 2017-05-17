<?php

namespace backend\controllers;

use Yii;
use backend\models\PhotoImage;
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
    public function actionCreate()
    {
        $model = new \backend\models\PhotoImage();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->user_id = Yii::$app->getUser()->id;
            $model->save();
            $image = UploadedFile::getInstance($model,'file_name');
            $imageName = 'real_'.$model->id.'.'.$image->getExtension() ;
            $image->saveAs(Yii::getAlias('@imagePath').'/'.$imageName);
            $model->file_name = $imageName;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new PhotoImage model using RestApi controller
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateRest()
    {
        $model = new \backend\models\PhotoImage();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->user_id = Yii::$app->getUser()->id;
            $image = UploadedFile::getInstance($model, 'file_name');
            $imageName = $image->name;
            $model->file_name = $imageName;

            if ($model->postPhotoImage()) {
                Yii::$app->session->setFlash('success', 'Photo was successfully uploaded - ' . $model->file_name);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = PhotoImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
