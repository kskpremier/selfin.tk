<?php

namespace backend\controllers;

use reception\useCases\manage\Booking\BookingManageService;
use Symfony\Component\Yaml\Tests\B;
use Yii;
use reception\entities\Booking\Booking;
use backend\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
    private $service;

    public function __construct($id, $module, BookingManageService $service, $config = [])
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
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch(['end_date'=>date('Y-m-d', time()+60*60*24*90)]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Booking model.
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
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Booking();

        if ($model->load(Yii::$app->request->post()) ) {
            $modelAdded =  $model->addNewBooking(true); //добавляем букинг и посылаем писмьо пользователю (true)
            if ($modelAdded) {
                //$modelAdded->sendEmail($modelAdded->contact_email,$modelAdded); //пока письмо шлем сами
                Yii::$app->session->setFlash('success', 'Booking was successfully downloaded');
                return $this->redirect(['view', 'id' => $modelAdded->id]);
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
     * Updates an existing Booking model.
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
     * Making recognition all photos in an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRecognize($id)
    {
        $model = $this->findModel($id);

       $this->service->compareFaces($model);
       $probability = $this->service->analyzingResultOfComparing($model);
       if ($probability < Booking::BOOKING_RECOCNITION_LOWREST_PROBABILITY){
           Yii::$app->session->setFlash('success', 'All registered guest Id and photo matched well');
       }
       else{
           Yii::$app->session->setFlash('error', "Some guest Id and photo does't matched" );
       }
       return $this->redirect(['face-comparation/booking-index', 'id' => $model->id]);

    }
    /**
     * Deletes an existing Booking model.
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
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking ::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
