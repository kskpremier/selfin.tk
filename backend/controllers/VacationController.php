<?php

namespace backend\controllers;

use function json_encode;
use reception\services\MyRent\MyRent;
use Yii;
use backend\models\Vacation;
use backend\models\VacationSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacationController implements the CRUD actions for Vacation model.
 */
class VacationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['link','index','sync','view-ajax'],
            'rules' => [
                [
                    'allow' => true,
                    'actions'=>['link','index','sync','view-ajax'],
                    'roles' => ['admin', 'vacation'],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Vacation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Objects model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionSync()
    {
        $list = MyRent::getVacationObjects();
        $count = 0;
        foreach ($list as $element){
            if (!Vacation::findOne($element["id"])) {
                $model = new Vacation(['id'=>$element["id"],'name'=>$element["name"],
                    'link'=>false,
                    'response'=>false,
                    'updated_at'=> date("Y-m-d H:i:s", time()),
                    'created_at'=> date("Y-m-d H:i:s", time())]);
                $model->save();
                $count++;
            }

        }
        return $this->redirect('index');
    }


    public function actionLink() {
        if (isset($_POST['keylist'])) {
            $keys = $_POST['keylist'];
            if (!is_array($keys)) {
                echo Json::encode([
                    'status' => 'error',
                    'total' => 0
                ]);
                return;
            }
            $total = 0;
            // you could alternatively write a single query using
            // SQL IN CONDITION, instead of loop below to fetch the total
            // from DB in ONE SINGLE fetch from the DB.
            foreach ($keys as $key) {
                //send link to VakationKey
                $model= $this->findModel($key);

                $xml = MyRent::getVacationObjectXML($key);
                $filename = Yii::getAlias('@vacationPath').'/'.$key.'.xml';
                if ($xml) {
                    $xml->asXML($filename);
                    $result = Myrent::sendXML($filename);

                    if ($result) {
                        $respondFileName =  Yii::getAlias('@vacationPath').'/Response_'.$key.'.xml';
                        $xml=simplexml_load_string($result);
                        $xml->asXML($respondFileName);
                        $total ++;
                        $model->link = true;
                        $model->response = true;
                        $model->updated_at = date("Y-m-dd H:i:s", time());
                        $model->XML=$result;

                        $model->save();
                    }
                }
            }
            echo json_encode([
                'status' => 'success',
                'total' => $total
            ]);
        }
        echo json_encode([
            'status' => 'error',
            'total' => 0
        ]);
    }

    /**
     * Displays a single Vacation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewAjax($id)
    {
        $this->layout = 'xml|_layout';
        $model =$this->findModel($id);
        if (!$model) {
            // Handle the case when model with given id does not exist
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');
            $xml= simplexml_load_file(Yii::getAlias('@vacationPath').'/'.$model->id.'.xml');
        return $xml->asXML();//$this->renderAjax('xmlview', ['filename' => Yii::getAlias('@vacationPath').'/'.$model->id.'.xml','xml'=>$xml]);
    }
    public function actionViewAjaxResponse($id)
    {
        $this->layout = 'xml|_layout';
        $model =$this->findModel($id);
        if (!$model) {
            // Handle the case when model with given id does not exist
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');
        $xml= simplexml_load_file(Yii::getAlias('@vacationPath').'/Response_'.$model->id.'.xml');
        return $xml->asXML();//$this->renderAjax('xmlview', ['filename' => Yii::getAlias('@vacationPath').'/'.$model->id.'.xml','xml'=>$xml]);
    }
//    public function actionDummy($id)
//    {
//        $this->layout = 'xml|_layout';
//        $model =$this->findModel($id);
//        if (!$model) {
//            // Handle the case when model with given id does not exist
//        }
//
//        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
//        $headers = Yii::$app->response->headers;
//        $headers->add('Content-Type', 'text/xml');
//
//        $xml= simplexml_load_file(Yii::getAlias('@vacationPath').'/'.$model->id.'.xml');
//        return $this->renderAjax('xmlview', ['xml'=>$xml]);
//    }
    /**
     * Creates a new Vacation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vacation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vacation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vacation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
