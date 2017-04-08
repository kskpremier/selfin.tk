<?php

namespace backend\controllers;

use Yii;
use backend\models\Key;
use backend\models\KeySearch;
use backend\models\Booking;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyController extends Controller
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
     * Lists all Key models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Key model.
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
     * Creates a new Key model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bookingId  = null)
    {
        $booking = ($bookingId) ? Booking::findOne($bookingId) : null;
        if (($booking)) {
            $model = new Key(['from' => Yii::$app->formatter->asDateTime($booking->arrival_date, "php:D, d-M-Y H:i"),
                'till' => Yii::$app->formatter->asDateTime($booking->depature_date, "php:D, d-M-Y H:i"),
                'e_key' => md5(uniqid(rand(), true)),
                'pin' => 123456,
                'booking_id' => $bookingId]);
        } else {
            $model = new Key(['from' => Yii::$app->formatter->asDateTime(time(), "php:D, d-M-Y H:i"),
                'till' => Yii::$app->formatter->asDateTime(time() + 24 * 60 * 60, "php:D, d-M-Y H:i"),
                'e_key' => md5(uniqid(rand(), true)),
                'pin' => 123456,
                'booking_id' => null]);
        }

        if ($model->load(Yii::$app->request->post()) ) {
            $model->from = Yii::$app->formatter->asDateTime($model->from,'php:d-m-Y H:i:s');
            $model->till = Yii::$app->formatter->asDateTime($model->till,'php:d-m-Y H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Key model.
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
     * Deletes an existing Key model.
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
     * Finds the Key model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Key the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Key::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
