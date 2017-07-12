<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 15:58
 */

namespace backend\controllers;

use Yii;
use backend\models\KeyboardPwd;
use backend\models\KeyboardPwdSearch;
use backend\models\Booking;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyboardPwdController extends Controller
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
                   // 'delete' => ['POST'],
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
        $searchModel = new KeyboardPwdSearch();
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
    public function actionCreate($booking_id  = null)
    {
        $booking = ($booking_id) ? Booking::findOne($booking_id) : null;

        if (isset($booking)) {
            $model = new KeyboardPwd(['start_date' => Yii::$app->formatter->asDateTime($booking->start_date, "php:D, d-M-Y H:i"),
                'end_date' => Yii::$app->formatter->asDateTime($booking->end_date, "php:D, d-M-Y H:i"),
                'booking_id' => $booking_id,
                'door_lock_id'=> $booking->apartment->doorLock->id]);
        } else {
            $model = new KeyboardPwd();
            $model->door_lock_id = (array_key_exists('door_lock_id',Yii::$app->request->queryParams))?
                                    Yii::$app->request->queryParams['door_lock_id']:
                                    $model->door_lock_id;
        }

        if ($model->load(Yii::$app->request->post()) ) {
            $model->start_date = Yii::$app->formatter->asDateTime($model->start_date,'php:d-m-Y H:i');
            $model->end_date = Yii::$app->formatter->asDateTime($model->end_date,'php:d-m-Y H:i');
            if ($response = $model->getKeyboardPwdLocal()) {

                Yii::$app->session->setFlash('success', 'Keyboard password is successfully generated  ' );
                return $this->redirect(['view', 'id' => $response]);
            }
            else {
                Yii::$app->session->setFlash('error', 'Something went wrong. Send info for site administator');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
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

        return $this->redirect(Yii::$app->request->referrer);
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
        if (($model = KeyboardPwd::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
