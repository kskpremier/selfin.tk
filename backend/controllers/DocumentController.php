<?php

namespace backend\controllers;

use reception\entities\Booking\Booking;
use reception\forms\GuestDocumentAddForm;
use reception\services\eVisitor\eVisitor;
use reception\useCases\manage\Booking\DocumentManageService;
use reception\useCases\manage\Image\ImageProcessManagement;
use reception\useCases\manage\Booking\PhotoManageService;
use Yii;
use reception\entities\Booking\Document;
use backend\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\httpclient\Client;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{
    private $processing;
    private $documentService;
    private $service;

    public function __construct($id, $module, PhotoManageService $service, ImageProcessManagement $processing, DocumentManageService $documentService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->processing = $processing;
        $this->documentService = $documentService;
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
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
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
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GuestDocumentAddForm() ;
//        $model->load(Yii::$app->request->post());
        if (  $model->load(Yii::$app->request->post(),'') && $model->validate()) {
            $document=$this->documentService->addDocumentDataWithPhoto($model);
            return $this->redirect(['view', 'id' => $document->id]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Making shapshot from camera
     * @return array
     */
    public function actionSnapshot()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://192.168.1.4:29219/snapshot.cgi?user=admin&pwd=12345678')
            ->send();

        define('UPLOAD_DIR', Yii::getAlias('@facePath')."/real_photos/");
//        foreach ($_REQUEST['image'] as $value) {
           $img = $response->getContent();
//            $img = str_replace('data:image/jpeg;base64,', '', $img);
//            $data = base64_decode($img);
            $file = UPLOAD_DIR . uniqid() . '.jpeg';
//            $file1 = UPLOAD_DIR . uniqid() . '.jpeg';
//            $success = file_put_contents($file, $data);
        $success = file_put_contents($file, $img);
//        $this->ser

    }

    /**
     * Making recognition of existing document .
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionProcess($id)
    {
        $document=$this->findModel($id);
        if ($document) {
            try {
                $probability = $this->processing->processDocumentImages($document);
                Yii::$app->session->setFlash('success', "Comparation result : probability = ".$probability);
                return $this->redirect(['view', 'id' => $document->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        Yii::$app->session->setFlash('error', "No one document with this Id");
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new GuestDocumentAddForm() ;
        if ($form->load(Yii::$app->request->post(),'') && $form->validate()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'form' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Document model.
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
     * Make checkin in test eVisitor dB
     * @param integer $id
     * @param Booking $booking
     * @return mixed
     */
    public function actionCheckin($id)
    {
        $booking = Booking::findOne(844);
        $document=$this->findModel($id);
        if ($document) {
            $eVisitor = new eVisitor();
            $response = $eVisitor->checkin($booking, $document);
                echo $response;
            $response = $eVisitor->checkout($response, "2018-01-12","10-00-00");
        }
        return $this->redirect(['index']);
    }


    

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
