<?php

namespace myrent\controllers;

use backend\models\DoorLockSearch;
use backend\models\KeyboardPwdSearch;
use backend\models\KeySearch;
use common\models\UserSearch;
use myrent\helpers\AvailabilityHelper;
use myrent\models\MobileUserSearch;
use myrent\models\ObjectsSearch;
use myrent\models\RentsAvailabilitySearch;
use reception\entities\DoorLock\DoorLock;
use reception\entities\User\User;
use Yii;
use myrent\models\Rents;
use myrent\models\RentsSearch;
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
     *
     *
     * @return mixed
     */
    public function actionDoorLock($user, $bookingId=null) {

        $keySearchModel = new KeySearch(['userId'=>$user, 'bookingId'=>$bookingId]);
        $keysDataProvider = $keySearchModel->search(Yii::$app->request->queryParams);

        $passwordsSearchModel = new KeyboardPwdSearch();
        $passwordsDataProvider = $passwordsSearchModel->search(Yii::$app->request->queryParams);

        $searchModel = new DoorLockSearch( ['user'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('/doorlocks/doorlocks', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'keys' => $keysDataProvider,
            'passwords' => $passwordsDataProvider
        ]);

    }

    /**
     *
     *
     * @return mixed
     */
    public function actionUsers($user) {

//        $keySearchModel = new KeySearch(['userId'=>$user, 'bookingId'=>$bookingId]);
//        $keysDataProvider = $keySearchModel->search(Yii::$app->request->queryParams);
//
//        $passwordsSearchModel = new KeyboardPwdSearch();
//        $passwordsDataProvider = $passwordsSearchModel->search(Yii::$app->request->queryParams);

        $searchModel = new MobileUserSearch (['id'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('/users/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'keys' => $keysDataProvider,
//            'passwords' => $passwordsDataProvider
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

    /**
     * Your controller action to fetch the list
     */
    public function actionApartmentList($dataProvider, $reception=null, $q = null, $userIds=null) {
        $query = $dataProvider->query;

        $query->select('name')
//            ->from('objects')
//            ->joinWith('units')
            ->forReception($reception)
            ->orderBy('name');
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d['name']];
        }
        echo Json::encode($out);
    }
}
