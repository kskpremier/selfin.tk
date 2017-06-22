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
use yii\web\ForbiddenHttpException;
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
////            'only' => ['create-image', 'update', 'delete'],
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
//            if (in_array($params,['start_date','end_date'])) {
//
//
//                throw  new ForbiddenHttpException('Forbidden.');
//            }
//        }
//    }

    public function actions()
    {
        $actions = parent::actions();
//        unset($actions['create']);

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
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

    public function actionCreateImage()
    {
        $model = new \backend\models\PhotoImage();

        \yii::$app->request->enableCsrfValidation = false;

        $model->load(Yii::$app->request->getBodyParams(), '');

        $headers = Yii::$app->request->headers;

        if ( $headers->has('Authorization') ) {
            $user = \common\models\User::findIdentityByAccessToken($headers->get('Authorization'));
            Yii::$app->user->setIdentity($user);
            if (true) {
//            if (Yii::$app->user->can('createPhotoImage', ['start_date'=>$model->booking->start_date, 'end_date'=>$model->booking->end_date ])) {
                //в массив надо передавать сроки пребывания туриста
                $model->date = date('Y-m-d');
                $model->user_id = ($user) ? $user->id : 1;
                $model->album_id = ($model->album_id) ? $model->album_id : 1; //по дефолту 1 - нераспознаные
                $model->camera_id=1;

                if ($model->save()) {

                    $postdata = fopen( $_FILES[ 'file' ][ 'tmp_name' ], "r" );
                    $extension = substr( $_FILES[ 'file' ][ 'name' ], strrpos( $_FILES[ 'file' ][ 'name' ], '.' ) );
                    $filename =  $model->id.'_'. uniqid() . $extension;
                    /* Open a file for writing */
                    $fp = fopen( Yii::getAlias('@imagePath') . '/'.$filename, "w" );
                    /* Read the data 1 KB at a time and write to the file */
                    while( $data = fread( $postdata, 1024 ) )
                        fwrite( $fp, $data );
                    fclose( $fp );
                    fclose( $postdata );
                    $model->file_name = $filename;
                    $model->save();
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $id = implode(',', array_values($model->getPrimaryKey(true)));
                    $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
                }
                elseif (!$model->hasErrors()) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
                return  $model;
            }
            else throw new ForbiddenHttpException('You are not authorized for added photos');
        }
        else  throw new ForbiddenHttpException('Wrong or expired token. No authorization.');
    }



    private function fileUpload($result)
    {
        $postdata = fopen( $_FILES[ 'file' ][ 'tmp_name' ], "r" );
        /* Get file extension */
        $extension = substr( $_FILES[ 'file' ][ 'name' ], strrpos( $_FILES[ 'file' ][ 'name' ], '.' ) );

        /* Generate unique name */
        $filename =  uniqid() . $extension;

        /* Open a file for writing */
        $fp = fopen( Yii::getAlias('@imagePath') . '/'.$filename, "w" );

            /* Read the data 1 KB at a time
              and write to the file */
            while( $data = fread( $postdata, 1024 ) )
                fwrite( $fp, $data );

            /* Close the streams */
        fclose( $fp );
        fclose( $postdata );

        /* the result object that is sent to client*/
//        $result = new UploadResult;
        $result->file_name = $filename;
//        $result->document = $_FILES[ 'data' ][ 'name' ];
//        $result->create_time = date( "Y-m-d H:i:s" );
        return $result->file_name;
    }

    public function prepareDataProvider()
    {
        $searchModel = new PhotoImageSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

}
