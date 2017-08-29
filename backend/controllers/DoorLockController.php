<?php

namespace backend\controllers;

use Yii;
use backend\models\DoorLock;
use backend\models\Apartment;
use backend\models\DoorLockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DoorLockController implements the CRUD actions for DoorLock model.
 */
class DoorLockController extends Controller
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
     * Lists all DoorLock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoorLockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DoorLock model.
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
     * Creates a new DoorLock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoorLock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new DoorLock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionInstall($id=null, $apartmentId=null)
    {
        if ($id){
            $doorLock = DoorLock::findOne($id);
            if (!isset($doorLock)) $doorLock =  new DoorLock();
        }
        else $doorLock =  new DoorLock();

        $doorLock->apartment_id = ($apartmentId) ? (integer) $apartmentId: $doorLock->apartment_id;

        if ($doorLock->load(Yii::$app->request->post())) {
            $model = $this->findModel((integer)$doorLock->id);
            $model->apartment_id = (integer)$doorLock->apartment_id;
            $flag = $model->validate();
            if ($flag) $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $apartmentName = Apartment::find()->where(['id'=>$doorLock->apartment_id]);
            return $this->render('install', [
                'model' => $doorLock,
                'apartmentName'=>$apartmentName
            ]);
        }
    }

    /**
     * Updates an existing DoorLock model.
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
     * Deletes an existing DoorLock model.
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
     * Finds the DoorLock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoorLock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoorLock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
