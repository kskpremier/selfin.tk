<?php

namespace backend\controllers;

use function array_fill;
use backend\helpers\AvailabilityHelper;
use backend\models\Filters;
use backend\models\Objects;
use backend\models\ObjectsAvailabilitySearch;
use backend\models\ObjectsPricesDays;
use backend\models\ObjectsPricesDaysSearch;
use backend\models\ObjectsRealestates;
use backend\models\ObjectsSearch;
use backend\models\PropertyFilter;
use backend\models\RentsAvailabilityPricesSearch;
use backend\models\RentsAvailabilitySearch;
use function is_array;
use function key_exists;
use reception\entities\User\User;
use reception\forms\MyRent\PriceSetForm;
use reception\services\MyRent\MyRent;

use reception\forms\MyRent\DetailFilterForm;
use Yii;
use backend\models\Rents;
use backend\models\RentsSearch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RentsController implements the CRUD actions for Rents model.
 */
class SuperuserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','index','superuser','hosta','yielding','availability','price'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'login'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index','superuser','yielding','availability','price'],
                        'allow' => true,
                        'roles' => ['superuser'],
                    ],
                    [
                        'actions' => ['hosta','superuser'],
                        'allow' => true,
                        'roles' => ['hosta'],
                    ],
],
                ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rents models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $this->layout='superuser_main';
        $userIds=[606,607,608,609,610,611,612];
        $user = User::findOne( Yii::$app->user->id);

        if ($user->external_id == 612) {
            $searchModel = new RentsSearch(['userIds'=>$userIds,'active'=>'Y','start'=>date("Y-m-d",time()),'until'=>date("Y-m-d",time()+60*60*24*365)]);
            $searchObjectModel  = new RentsAvailabilitySearch(['userIds'=>$userIds,'start'=>date("Y-m-d",time()),'until'=>date("Y-m-d",time()+60*60*24*100)]);
        }
        else {
            $searchModel = new RentsSearch(['userIds'=>$user->external_id, 'active' => 'Y']);
//        $searchModel = new RentsSearch();
            $searchObjectModel = new RentsAvailabilitySearch(['userIds' => [612]]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,['active'=>'Y']);
        $objectDataProvider = $searchObjectModel->search(Yii::$app->request->queryParams);

        return $this->render('/rents/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchObjectModel'=>$searchObjectModel,
            'objectDataProvider'=> $objectDataProvider
        ]);
    }

    public function actionSuperuser(){
        $this->layout='myRentSuperUser';
        $userIds=[606,607,608,609,610,611,612];
        $user = User::findOne( Yii::$app->user->id);

        if ($user->external_id == 612) {
            $searchModel = new RentsSearch(['userIds'=>$userIds,'active'=>'Y','start'=>date("Y-m-d",time()),'until'=>date("Y-m-d",time()+60*60*24*365)]);
            $searchObjectModel  = new RentsAvailabilitySearch(['userIds'=>$userIds,'start'=>date("Y-m-d",time()),'until'=>date("Y-m-d",time()+60*60*24*100)]);
        }
        else {
            $searchModel = new RentsSearch([$user->external_id, 'active' => 'Y']);
//        $searchModel = new RentsSearch();
            $searchObjectModel = new RentsAvailabilitySearch(['userIds' => [612]]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,['active'=>'Y']);
        $objectDataProvider = $searchObjectModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchObjectModel'=>$searchObjectModel,
            'objectDataProvider'=> $objectDataProvider
        ]);
    }

    public function actionRedirect($id){
        $model = $this->findModel($id);
        if (in_array ($model->user_id,[606,607,608,609,610,611,612])){
            $url = "https://app.my-rent.net/users/login_rent?id=".$model->guid;
        }
        else $url = "https://app.my-rent.net/users/login";
        $this->redirect($url);
    }

    public function actionReception($reception){
        $url = $this->getReception($reception);
        $this->redirect($url);
    }

    public function actionHosta() {
        $this->layout='hosta';

        return $this->redirect('http:\\hosta.tk');

    }

    /**
     * Displays a single Rents model.
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
     * Displays a single Rents model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionYielding()

    {
        $this->layout = "yielding";
        $userIds = [606,607,608,609,610,611,612];
        $days = 14;
        $search = new RentsAvailabilitySearch(['userIds' => $userIds, 'active'=>'Y']);
        $search->load( Yii::$app->request->queryParams,'RentsAvailabilitySearch');
        $search->start=($search->start)?$search->start:date("Y-m-d",time());
        $days = (integer)(strtotime($until = $search->until) - strtotime($from = $search->start)) / 24 / 60 / 60;
        if ($days < 14) {
            $search->until = date("Y-m-d", strtotime($search->start) + 14 * 24 * 60 * 60) ;
            $until = $search->until;
            $days = 14;
        } else {
        }
        $search->reception=($search->reception||$search->reception=='')?$search->reception:611;
        $search->filterName=($search->filterName)?$search->filterName:8;

            $objectDataProvider = $search->search();
            $availabilityList = AvailabilityHelper::getAvailability($objectDataProvider->query->orderBy(['units.name' => SORT_DESC, 'rents.from_date' => SORT_ASC])->asArray()->all(), $search->start, $search->until);
            //формируем некоторые заголовки
            $data = ArrayHelper::getColumn($availabilityList, 'name');
            $data = (count($data)) ? $data : ArrayHelper::getColumn(/*Objects::find()*/
                $objectDataProvider->query->select('objects.name')->all(), 'name');
            $objects = ArrayHelper::getColumn($availabilityList, 'id');
            $priceSearch = new ObjectsPricesDaysSearch(['from' => $search->start, 'until' => $search->until, 'objectIds' => $objects]);
            $priceDataProvider = $priceSearch->search(Yii::$app->request->queryParams);
            $objectWithPrices = ArrayHelper::index($priceDataProvider->query->asArray()->all(), null, 'object_id');
            $prices = [];
            foreach ($objects as $object) {
                if (key_exists($object, $objectWithPrices)) {
                    for ($i = 0; $i < $days; $i++) {
                        $prices[$object]['price'][$i] = (key_exists($i, $objectWithPrices[$object])) ? $objectWithPrices[$object][$i]['price'] : '-';
                        $prices[$object]['min_stay'][$i] = (key_exists($i, $objectWithPrices[$object])) ? $objectWithPrices[$object][$i]['min_stay'] : '-';
                    }
                } else {
                    for ($i = 0; $i < $days; $i++) {
                        $prices[$object]['price'][$i] = '-';
                        $prices[$object]['min_stay'][$i] = '-';
                    }
                }
            }

        return $this->render('/yielding/yielding', [
            'searchObjectModel'=> $search,
            'prices'=>$prices,
            'days'=> $days,
            'availabilityList'=> $availabilityList,
            'dataProvider'=> $objectDataProvider
        ]);
    }
    public function actionDetailFilter(){

    }


    public function actionPrice(){
        $priceForm = new PriceSetForm();

        if ($priceForm->load(Yii::$app->request->queryParams,'PriceSetForm') && $priceForm->validate()) {
            // тут надо записать новые цены в майрент
            $result = true;
            $ids = explode(',',$priceForm->id);
            $days = explode(',',$priceForm->indexes);
            $prices = explode(',',$priceForm->prices);
            $stays =  explode(',',$priceForm->stays);
            $objectList = (is_array($ids))?array_unique($ids):[$ids];
            $daysList = (is_array($days))?array_unique($days):[$days];
            $from = date("Y-m-d",(strtotime($priceForm->firstDay) + min($daysList)*24*60*60));
            $until = date("Y-m-d",(strtotime($priceForm->firstDay) + max($daysList)*24*60*60));
            //разбиваем на периоды по цене или min_stay
            foreach ($objectList as $key){
                $object=Objects::findOne($key);
                if ($object) {
                    $reception = $object->user_id;
                    if ($priceForm->price !='' && $priceForm->min_stay!='')
                         $result = $result && MyRent::priceSet($key, $reception, $from, $until, $priceForm->price , $priceForm->min_stay);
                    elseif ($priceForm->min_stay && $priceForm->price =''){
                        $intervals = [];
                        $prevPrice = null;
                        for ($i=0; $i<count($prices);$i++) {
                            if ($prices[$i]!=$prevPrice) {
                                $intervals['price'] = $prices[$i];
                                $interval['index'] = $i;
                                $prevPrice = $prices[$i];
                            }
                        }
                        $intervals[] = count($prices);
                        for ($j=0; $j<count($intervals);$j++){
                            $from = date("Y-m-d",(strtotime($priceForm->firstDay) + $interval['index'][$j]*24*60*60));
                            $until = date("Y-m-d",(strtotime($priceForm->firstDay) + $interval['index'][$j+1]*24*60*60));
                            $result = $result && MyRent::priceSet($key, $reception, $from, $until,  $intervals['price'][$j] , $priceForm->min_stay);
                        }
                    }
                    elseif ($priceForm->min_stay='' && $priceForm->price){
                        $intervals = [];
                        $prev = null;
                        for ($i=0; $i<count($stays);$i++) {
                            if ($stays[$i]!=$prev) {
                                $intervals['min_days'] = $stays[$i];
                                $interval['index'] = $i;
                                $prev = $stays[$i];
                            }
                        }
                        $intervals[] = count($stays);
                        for ($j=0; $j<count($intervals);$j++){
                            $from = date("Y-m-d",(strtotime($priceForm->firstDay) + $interval['index'][$j]*24*60*60));
                            $until = date("Y-m-d",(strtotime($priceForm->firstDay) + $interval['index'][$j+1]*24*60*60));
                            $result = $result && MyRent::priceSet($key, $reception, $from, $until, $priceForm->price , $intervals['min_days'][$j]);
                        }
                    }
                }
                else $result = false;
            }
            if ($result) {
                Yii::$app->session->setFlash('success', 'Data changed');
                $data=['status' => 'success','message'=>'Nice!'];
                return $this->asJson($data);
            }
            else  {
                Yii::$app->session->setFlash('danger', 'Something wrong');
                $data=['status' => 'error','message'=>'Nice!'];
                return $this->asJson($data);
            }
        }
    }

    public function actionAvailability (){
        $filterForm = new Filters();
        $detailFilter = new DetailFilterForm();

        if ($detailFilter->load(Yii::$app->request->queryParams,'DetailFilterForm') && $detailFilter->validate()) {

        }

//        if ($filterForm->load(Yii::$app->request->queryParams,'FilterForm') && $filterForm->validate()) {
//            $filterForm->save();
//        }
        $priceForm = new PriceSetForm();
        if ($priceForm->load(Yii::$app->request->queryParams,'PriceSetForm') && $priceForm->validate()) {
            // тут надо записать новые цены в майрент
            $result = true;
            $objectList = (is_array($priceForm->id))?array_unique($priceForm->id):[$priceForm->id];
            $daysList = (is_array($priceForm->indexes))?array_unique($priceForm->indexes):[$priceForm->indexes];
            $lastDay = max($daysList);
            foreach ($objectList as $key){
                $result = $result && $respond = MyRent::priceSet($key, $priceForm->firstDay, $lastDay, ($priceForm->price)?$priceForm->price:null,($priceForm->min_stay)?$priceForm->min_stay:null);
            }
            if ($result) Yii::$app->session->setFlash('success', 'Data changed');
            else  Yii::$app->session->setFlash('danger', 'Something wrong');
        }

        $this->layout = "yielding";
        $userIds = [606,607,608,609,610,611,612];
        $from =  date("Y-m-d", time());
        $until =  date("Y-m-d", time() + 30*24*3600);
        if (key_exists('ObjectsAvailabilitySearch', Yii::$app->request->queryParams)) {
            $params = Yii::$app->request->queryParams['ObjectsAvailabilitySearch'];
            $from = (key_exists('start', $params)) ? $params['start'] : $from;
            $until = (key_exists('until',$params)) ? $params['until'] : $until;
        }
        $params['start'] = $from;
        $params['until'] = $until;
        //form data provider for Objects
        $searchObjects = new ObjectsAvailabilitySearch(['start'=>$from,'until'=>$until,'userIds' => $userIds]);
        //загружаем данные из фильтра формы (Reception, Property, Filters
        //data provider for Objects
        $objectDataProvider =  $searchObjects->search(Yii::$app->request->queryParams);
        $pages = new Pagination(['totalCount' => $objectDataProvider->query->count(), 'pageSize' => 20,]);
        $objects = $objectDataProvider->query->offset($pages->offset)->limit($pages->limit)->all();

        $objectsIds = ArrayHelper::getColumn($objects,['id']);
        $objectsNames = ArrayHelper::map($objects,'id','name');
        //data provider for Rents
        $searchRents = new RentsAvailabilityPricesSearch(['start'=>$from, 'until'=>$until, 'property'=>$objectsIds]);
        $rents = ArrayHelper::index($searchRents->search(Yii::$app->request->queryParams)->query->asArray()->all(),null, 'object_id');


        //data provider for Prices
        $searchPrices = new ObjectsPricesDaysSearch(['from'=>$from, 'until'=>$until, 'objectIds'=>$objectsIds]);
        $prices =  ArrayHelper::index($searchPrices->search()->query->asArray()->all(), null, 'object_id');

        //preparation array dataProvider for availability table
        $days = (int)((strtotime($until)-strtotime($from))/60/60/24);
        $pricesDataProvider=[];

//        $dataProvider ['availability'] = array_fill(0,$days-1,1);
        foreach ($objectsNames as $id=>$name) {
            $duration = 0; $previousIndex=0; $flag=true;
            $pricesDataProvider [$id]= array_fill(0, $days , ['price' => 0, 'min_stay' => 0, 'availability' => 1,'hole'=> 0,'holeAlert'=>0]);
            if (key_exists($id, $rents)) {
                if (key_exists($id, $prices)) {
                    foreach ($prices[$id] as $price) {
                        $pricesDataProvider[$id][$price['index']] ['price'] = $price['price'];
                        $pricesDataProvider[$id][$price['index']] ['min_stay'] = $price['min'];
                    }
                }
                foreach ($rents[$id] as $rent) {
                    if ($rent['from'] < 0)
                        $duration += $this->arrayFill($pricesDataProvider, $id, 0, ($rent['to'] <= $days) ? $rent['to'] : $days, 0);
                    else
                        $duration += $this->arrayFill($pricesDataProvider, $id, $rent['from'], ($rent['to'] <= $days) ? $rent['to'] : $days, 0);

                    if ($rent['to'] < $days) {
                        if ($previousIndex!=0) {
                            $flag = $this->arrayHoleFill($pricesDataProvider, $id, $rent['from'], $rent['to'], $previousIndex) && $flag;
                        }
                        $previousIndex = $rent['to'];
                    }
                }
            }
            if (!$flag)
                 $pricesDataProvider[$id]['hole']=1;
            else $pricesDataProvider[$id]['hole']=0;
            $pricesDataProvider[$id]['name']=$name;
            $pricesDataProvider[$id]['load']=($duration==0)?0:(int)(100*$duration/$days);

        }

        return $this->render('/yielding/yield', [
            'data'=> $pricesDataProvider,
            'days'=> $days,
            'search'=> $searchObjects,
            'objects'=> $objectsNames,
            'pages'=>$pages,
            'priceForm'=>$priceForm,
            'filterForm'=>$filterForm,
            'detailFilter'=>$detailFilter,
        ]);

    }
    private function arrayFill(&$dataProvider, $id, $indexStart, $indexFinish, $value) {
        for ($i=$indexStart; $i< $indexFinish; $i++) {
            $dataProvider[$id][$i]['availability'] = $value;
        }
        $duration =  $indexFinish - $indexStart;
        return $duration;
    }
    private function arrayHoleFill(&$dataProvider, $id, $indexStart, $indexFinish, $previousIndex) {
        $flag = true;
        $globalHole =(($indexStart-$previousIndex) < $dataProvider[$id][$previousIndex] ['min_stay'])? true:false;
        for ($i=$previousIndex; $i < $indexStart; $i++) {
            if ( ($indexStart-$i) < $dataProvider[$id][$i]['min_stay'] && $globalHole) {
                $dataProvider[$id][$i]['hole'] = ($indexStart-$i);
                $dataProvider[$id][$i]['holeAlert'] = 1;
                $flag = false;
            }
//            else {
//                $globalHole = true;
//            }
        }
        return $flag;

    }

    public function actionFilter() {
        $model = new PropertyFilter();
        if ($model->load(Yii::$app->request->post(),'filter-form') ) {
            $model->user_id = Yii::$app->user->getId();
            $model->created = time();
            if (key_exists('RentsAvailabilitySearch', Yii::$app->request->queryParams['RentsAvailabilitySearch']) && isset( Yii::$app->request->queryParams['RentsAvailabilitySearch']['property']))
            $model->property_list = serialize(Yii::$app->request->queryParams['RentsAvailabilitySearch']['property']);
            $model->save();
            return $this->redirect(['yielding',Yii::$app->request->queryParams]);
        }
    }
    /**
     * Creates a new Rents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rents();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rents model.
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
     * Deletes an existing Rents model.
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
     * Finds the Rents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function getReception($reception){
        switch ($reception){
            case "Kvarner":
                return "https://app.my-rent.net/users/login?id=bc947c21-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(611);
            case "Gajac":
                return "https://app.my-rent.net/users/login?id=3b0bd7cc-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(607);
            case "Cervar":
                return "https://app.my-rent.net/users/login?id=3b0bd7cc-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(610);
            case "Savudrija":
                return "https://app.my-rent.net/users/login?id=d9e4da78-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(606);
            case "Zaglav":
                return "https://app.my-rent.net/users/login?id=68ed24fe-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(608);
            case "Barbariga":
                return "https://app.my-rent.net/users/login?id=5560a69b-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(609);
            case "Mareda":
                return "https://app.my-rent.net/users/login?id=11fe2de0-2b11-11e7-b171-0050563c3009";//$this->getWorkerForReception(612);
        }

    }

}
