<?php

namespace backend\controllers;

use backend\models\FaceComparation;

use reception\entities\Booking\Booking;
use reception\entities\Booking\Photo;
use backend\service\PhotoImageRecognition;
use GuzzleHttp\Exception\ServerException;
use reception\entities\Booking\Document;
use reception\entities\Booking\DocumentPhoto;
use reception\entities\Booking\Face;
use reception\forms\FaceForm;
use reception\repositories\Booking\FaceRepository;
use reception\useCases\manage\Booking\FaceManageService;
use Yii;

use backend\models\FaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use backend\helpers\FaceComparationHelper;



/**
 * FaceController implements the CRUD actions for Face model.
 */
class FaceController extends Controller
{
    private $faceRepository;
    private $service;

    public function __construct($id, $module, FaceManageService $service, FaceRepository $faceRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->faceRepository = $faceRepository;
        $this->service = $service;
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
        ];
    }

    /**
     * Lists all Face models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Face model.
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
     * Creates a new Face model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new FaceForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate() ) {
            $face = $this->service->create($form);
            return $this->redirect(['view', 'id' => $face->id]);
        } else {
            return $this->render('create', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Updates an existing Face model.
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
     * Deletes an existing Face model.
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
     * Finds the Face model based on its primary face value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Face the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \reception\entities\Face::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @param integer $photoImageId
     * @return \yii\web\Response
     */
    public function actionDetectFace($photoImageId){

        $photoImage = Photo::findOne($photoImageId);
        if ($photoImage) {
            $photoImage->extractFace();
            return $this->redirect(['photo-image/view', 'id' => $photoImageId]);
        }
        throw new ServerException('Could not find Photoimage with this id'.$photoImageId );
    }

    /**
     * @param integer $photoImageId
     * @return \yii\web\Response
     */
    public function actionDetectFaceFromDocument($documentId){

        $document = Document::findOne($documentId);
        $list =[];
        if ($document) {
            foreach ($document->images as $photoImage) {
                $recognizedImage = new PhotoImageRecognition($photoImage);
                $list[]=$recognizedImage->recognize(true); //признак того, что распознаем документ
            }
            return $this->redirect(['document/view', 'id' => $documentId]);
        }
        throw new ServerException('Could not find Document photo with this id'.$documentId );
    }
    /**
     * Making recognition all photos in an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRecognize($bookingId)
    {
        $booking = Booking::findOne($bookingId);

        $model = $this->findModel($id);

        $this->service->compareFaces($booking,$model);
        $this->service->analyzingResultOfComparing($booking, $model);

        return $this->redirect(['view', 'id' => $model->id]);

    }


    /**
     * @param integer $photoImageId
     * @return \yii\web\Response
     */
    public function actionCompareFace($faceImageId){
        //ищем лицо для последующего сравнения
        $faceImage = Face::findOne($faceImageId);

        $faceList = FaceComparationHelper::GetFacesForMatching($faceImage);

        if (Model::loadMultiple($faceList, Yii::$app->request->post()) && Model::validateMultiple($faceList)) {
            if (count($faceList) == 0) {
                return $this->redirect (['face-comparation/index', 'origin_id'=>$faceImage->id ]);
            }
            //faceMatch($originFace, $listOfFaces)
            foreach ($faceList as $face) {
                if ($face->isChecked) {
                    $listOfFaces[] = $face;
                }
            }
            //здесь происходит отправка фоток на сравнение
            $matchedPhotos = PhotoImageRecognition::faceMatch($faceImage, $listOfFaces);
            $data = json_decode( $matchedPhotos , true);
            if ( is_array($data['result'])) {
                $flag = true;
                foreach ($data['result'] as $id=>$result){
                    $faceComparation = FaceComparation::find()->where([
                        'origin_id'=>$faceImage->id,
                        'face_id'=>face($result),
                    ])->one();
                    $flag=true;
                    if (!isset($faceComparation)) {
                        $faceComparation = new FaceComparation([
                            'origin_id' => $faceImage->id,
                            'face_id' => face($result),
                            'probability' => $result[face($result)],
                        ]);
                        $flag = $flag && $faceComparation->save();
                    }
                }
                if ($flag) {
                    return $this->redirect (['face-comparation/index', 'origin_id'=>$faceImage->id ]);
                }
                throw new ServerException('Some problems with saving result of comparation' );
            }
            throw new ServerException('Some problems with matching' );
        }
       else return $this->render('compearing_form', [
            'facesList' => $faceList,
           'originalFace'=>$faceImage
        ]);
    }

}
