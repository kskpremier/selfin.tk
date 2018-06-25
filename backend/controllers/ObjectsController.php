<?php

namespace backend\controllers;

use backend\models\RentsAvailabilitySearch;
use reception\forms\MyRent\DetailFilterForm;
use reception\forms\MyRent\SearchForm;
use reception\services\search\ObjectsIndexer;
use reception\services\search\SearchService;
use Yii;
use backend\models\Objects;
use backend\models\ObjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjectsController implements the CRUD actions for Objects model.
 */
class ObjectsController extends Controller
{
    private $indexer;
    private  $searchService;

    public function __construct($id, $module, ObjectsIndexer $indexer, SearchService $searchService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->indexer = $indexer;
        $this->searchService = $searchService;
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
     * Lists all Objects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='superuser';
        $userIds=[606,607,608,609,610,611,612];
        $searchModel = new RentsAvailabilitySearch(['userIds'=>$userIds,'start'=>date("Y-m-d",time()),'until'=>date("Y-m-d",time()+60*60*24*100)]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Objects models.
     * @return mixed
     */
    public function actionSearch()
    {
//        $this->layout='booking-engine';
//        $searchForm = new SearchForm();
//        $searchForm->load(Yii::$app->request->queryParams,'');
        $detailFilterForm = new DetailFilterForm();
        $detailFilterForm->load(Yii::$app->request->queryParams,'DetailFilterForm');
        $userIds=[606,607,608,609,610,611,612];
        $searchModel = new RentsAvailabilitySearch(['userIds'=>$userIds,'start'=>date("Y-m-d",time()),'until'=>date("Y-m-d",time()+60*60*24*100),'items'=>($items)?$items:null]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $items = $this->searchService->search($dataProvider,$detailFilterForm->location, $detailFilterForm->from,
            $detailFilterForm->to, $detailFilterForm->stars, $detailFilterForm->numberOfGuests,
            $detailFilterForm->space,
            explode(',',$detailFilterForm->priceRange),100, 1);


//        $pages = new Pagination(['totalCount' => $dataProvider->query->count(), 'pageSize' => 20,]);

        return $this->render('/yielding/search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'searchForm'=> $detailFilterForm,
            'detailFilterForm'=>$detailFilterForm,
//            'items'=>$items
//            'pages'=>$pages
        ]);
    }

    /**
     * Displays a single Objects model.
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
     * Creates a new Objects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Objects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Objects model.
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
     * Deletes an existing Objects model.
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
     * Finds the Objects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Objects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Objects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
