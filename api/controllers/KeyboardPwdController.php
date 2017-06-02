<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 12:26
 */
namespace api\controllers;

use Yii;
use backend\models\KeyboardPwd;
use backend\models\KeyboardPwdSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;
use yii\web\ForbiddenHttpException;
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

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'only' => ['create', 'update', 'delete'],
//            'rules' => [
//                [
//                    'allow' => true,
//                    // ролей пока нет, поэтому я закоментировал
//                    'roles' => ['@'],
//                ],
//            ],
//        ];

        return $behaviors;
    }

    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch'],
            'create' => ['post'],
            'delete' => ['delete']
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['create'])) {
            if (!Yii::$app->user->can('createKeyboardPwd',['booking_id'=>$model->booking_id, 'start_day'=>$model->start_day,'end_day'=>$model->end_day])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['delete'])) {
            if (!Yii::$app->user->can('deleteKeyboardPwd',['booking_id'=>$model->booking_id, 'start_day'=>$model->start_day,'end_day'=>$model->end_day])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['view'])) {
            if (!Yii::$app->user->can('viewKeyboardPwd',['booking_id'=>$model->booking_id, 'start_day'=>$model->start_day,'end_day'=>$model->end_day])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
        if (in_array($action, ['update'])) {
            if (!Yii::$app->user->can('updateKeyboardPwd',['booking_id'=>$model->booking_id, 'start_day'=>$model->start_day,'end_day'=>$model->end_day])) {
                throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
            }
        }
    }

    public function prepareDataProvider()
    {
        $searchModel = new KeyboardPwdSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * Creates a new DoorLock model.
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionCreate()
    {
        $model = new KeyboardPwd();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //собственно само обращение к китайцам и получение ответа
        $data = json_decode($model->getKeyboardPwdFromChina(), true);
        if ($data['success']) {
                $response = Yii::$app->getResponse();
                $response->setStatusCode(201);
                $id = implode(',', array_values($model->getPrimaryKey(true)));
                $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
                return $model;
        } throw new ServerErrorHttpException('Failed to get information from China API for unknown reason.' . implode(',', $data));
    }

    /**
     * Displays a single DoorLock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Updates an existing DoorLock model.
     * If update is successful, return model
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model;
    }

    /**
     * Deletes an existing DoorLock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return  $this->findModel($id)->delete();
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