<?php

namespace backend\controllers;

use backend\models\FaceComparation;

use backend\models\PhotoImage;
use backend\service\PhotoImageRecognition;
use GuzzleHttp\Exception\ServerException;
use Yii;
use backend\models\Face;
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
        $model = new Face();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
     * Finds the Face model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Face the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Face::findOne($id)) !== null) {
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

        $photoImage = PhotoImage::findOne($photoImageId);
        if ($photoImage) {
            $recognizedImage = new PhotoImageRecognition($photoImage);
            $recognizedImage->recognize();
            return $this->redirect(['photo-image/view', 'id' => $photoImageId]);
        }
        throw new ServerException('Could not find Photoimage with this id'.$photoImageId );
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
                    $faceComparation = new FaceComparation([
                        'origin_id'=>$faceImage->id,
                        'face_id'=>key($result),
                        'probability'=>$result[key($result)],
                    ]);
                    $flag = $flag && $faceComparation->save();
                }
                if ($flag) {
//                    $searchModel = new FaceComparationSearch();
//                    $searchModel->origin_id = $faceImage->id;
//                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    return $this->redirect (['face-comparation/index', 'origin_id'=>$faceImage->id ]);
                }
                throw new ServerException('Some problems with saving result of comparation' );
            }
            throw new ServerException('Some problems with matching' );
        }
       else return $this->render('compearing_form', [
            'facesList' => $faceList,
        ]);
    }

}
