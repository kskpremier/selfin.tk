<?php

namespace api\controllers;

use api\models\PhotoImageSearch;
use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use backend\models\PhotoImage;
use yii\web\ServerErrorHttpException;
use yii\helpers\Url;
use yii\web\UploadedFile;

class PhotoImageController extends \yii\rest\ActiveController
{
    public $modelClass = 'backend\models\PhotoImage';

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
//                     'roles' => ['@'],
//                ],
//            ],
//        ];
        return $behaviors;
    }

//    public function checkAccess($action, $model = null, $params = [])
//    {
//        if (in_array($action, ['update', 'delete','view','create'])) {
//            if (!Yii::$app->user->can(Rbac::MANAGE_DOORLOCK, ['doorlock' => $model])) {
//                throw  new ForbiddenHttpException('Forbidden.');
//            }
//        }
//    }

//    public function actions()
//    {
//        $actions = parent::actions();
//       // unset($actions['create']);
//        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//        return $actions;
//    }
/**
 * Upload photo with POST Request
 * @parameter in request
 * { "booking_id":"2",
 *   "user_id":"1"
 * }
 *
 *  multipart/form-data
 *  file .jpg /png
 *
 *  POST restapi.domouprav.hr/photoimage HTTP/1.1
 * *  header for request
 *
 *  Authorization: Bearer cWADri54WVNIs_ammPUDmwQSuuhDTw6-
 *  Content-Type: multipart/form-data;
 *  Content-Type: image/jpeg
 *  Content-Disposition: form-data; name="img1"; filename="image1.jpg"
 *
 * HTTP/1.1 200 OK
 * Content-Type: application/json
 * {
 *  "description": "Photo of tourist",
 *   "img1": {
 *   "filename": "image1.JPG",
 *   "booking": "123",
 *   "user":"12",
 *   "uploaded": "2016-11-05T23:09:50+00:00",
 *   "id": "123",
 * }
 *
 **/

    public function actionCreate()
    {
        $model = new \backend\models\PhotoImage();

        $model->load(Yii::$app->request->getBodyParams(), '');
        $model->date = date();
//        $headers = Yii::$app->request->headers['Authorization'];
//        $pos = strripos ( $headers, ' ');
//        $token = substr($headers, $pos+1, strlen($headers)-strlen("Bearer ") );
//        $user = \common\models\User::findIdentityByAccessToken($token);
        $model->user_id = (Yii::$app->user->id)?Yii::$app->user->id:2;//$user->id;
        //echo Yii::$app->user->id;//надеюсь, что из токена я это получу
        $model->album_id = ($model->album_id)?$model->album_id:1; //по дефолту 1 - нераспознаные

        if ($model->save()) {

            $image = UploadedFile::getInstance($model,'file_name');
            $imageName = 'real_face_via_api_'.$model->id.'.'.$image->getExtension() ;
            $image->saveAs(Yii::getAlias('@imagePath').'/'.$imageName);
            $model->file_name = $imageName;
            $model->save();

            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

//    public function prepareDataProvider()
//    {
//        $searchModel = new PhotoImageSearch();
//        return $searchModel->search(Yii::$app->request->queryParams);
//    }

}
