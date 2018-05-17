<?php

namespace backend\controllers;

use function array_search;
use backend\models\RentsAvailabilitySearch;
use function serialize;
use Yii;
use backend\models\Filters;
use backend\models\FiltersSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FiltersController implements the CRUD actions for Filters model.
 */
class FiltersController extends Controller
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
     * Lists all Filters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FiltersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Filters model.
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

    /**
     * Creates a new Filters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Filters();

        $userIds = [606,607,608,609,610,611,612];
        $search = new RentsAvailabilitySearch(['userIds' => $userIds, 'active'=>'Y']);
//        $search->load( Yii::$app->request->queryParams,'RentsAvailabilitySearch');
        $dataProvider = $search->search(Yii::$app->request->queryParams,'RentsAvailabilitySearch');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'dataProvider'=>$dataProvider,
            'search'=> $search,
            'model' => $model,
        ]);
    }
    public function actionBuild() {
        $model = new Filters();
        $data=[];
        if (isset($_POST['keylist'])) {
            $keys = $_POST['keylist'];
            if (!is_array($keys)) {
                $data=['status' => 'error','total' => 0, 'name'=>'', 'message'=>'No one object was choose!'];
                $this->asJson($data);
            }
            $model->ids = serialize($keys);
            if (isset($_POST['name']))
                $model->name = $_POST['name'];
            $model->created_at = time();
            if ($model->save()) {
               $data=['status' => 'success','total' => count($keys), 'name'=>$model->name,'id'=>$model->id,'message'=>'Nice!'];
               return $this->asJson($data);
            }
        }
        else {
            $data=['status' => 'error','total' => 0, 'name'=>'','message'=>'No one object was choose!'];
            return $this->asJson($data);
        }
    }

    public function actionRemove() {
        $model = Filters::find()->where(['name'=>$_POST['name']])->one();
        if (isset($_POST['keylist'])) {
            $keys = $_POST['keylist'];
            if (!is_array($keys)) {
                echo Json::encode([
                    'status' => 'error',
                    'total' => 0
                ]);
                return;
            }
            $existingKeys = unserialize($model->ids);
            foreach ($keys as $key){
                if ($element=array_search($key, $existingKeys))
                    unset($existingKeys[$element]);
            }
            $model->ids = serialize($existingKeys);
            if (isset($_POST['name']))
                $model->name = $_POST['name'];
            $model->created_at = time();
            if ($model->save()) {
                echo Json::encode([
                    'status' => 'success',
                    'total' => count($keys),
                    'name'=>$model->name
//                    'name'=> $_POST['filter_name'],
                ]);
                return;
            }
        }
        else {
            echo Json::encode([
                'status' => 'error',
                'total' => 0
            ]);
            return;
        }
    }

    /**
     * Updates an existing Filters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userIds = [606,607,608,609,610,611,612];
        $search = new RentsAvailabilitySearch(['userIds' => $userIds, 'active'=>'Y','filterName'=>$model->id]);
        $dataProvider = $search->search();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'dataProvider'=>$dataProvider,
            'search'=> $search,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Filters model.
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
     * Finds the Filters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Filters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Filters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
