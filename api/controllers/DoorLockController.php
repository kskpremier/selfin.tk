<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 10.05.17
 * Time: 20:03
 */

namespace api\controllers;

use api\models\GetKeyboardKey;
use Yii;
use backend\models\DoorLock;
use backend\models\DoorLockSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;

/**
 * DoorLockController implements the CRUD actions for DoorLock model.
 */
class DoorLockController extends Controller
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
//            $behaviors['access'] = [
//                'class' => AccessControl::className(),
//                'only' => ['create', 'update', 'delete'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        // ролей пока нет, поэтому я закоментировал
//                         'roles' => ['@'],
//                    ],
//                ],
//            ];

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
        if (in_array($action, ['update', 'delete','view','create'])) {
            if (!Yii::$app->user->can('manageDoorLock', ['doorlock' => $model])) {
                throw  new ForbiddenHttpException('Forbidden.');
            }
        }
    }

    public function prepareDataProvider()
    {
        $searchModel = new DoorLockSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * Creates a new DoorLock model.
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionCreate()
    {
        $model = new DoorLock();
        // $model->user_id = Yii::$app->user->id;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->addNewDoorlock()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }
    /**
     * Creates a new DoorLock model.
     * If creation is successful, return model
     * @return Active Record model
     */
    public function actionInit()
    {
        $model = new DoorLock();
        // $model->user_id = Yii::$app->user->id;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->addNewDoorlock()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
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
     * Генерирует комбинацию цифр для конкретного замка
     *
     * @param integer $id
     * @return mixed
     */
    public function actionKeyboardPwd($id){

        $model = new GetKeyboardKey();
        $model->load(Yii::$app->request->getBodyParams(), '');
        $model->getKeyboardPwd();

        $key = new \backend\models\Key();

        $key->load($this);

        return $key;
    }

    /**
     * Finds the DoorLock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoorLock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoorLock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
