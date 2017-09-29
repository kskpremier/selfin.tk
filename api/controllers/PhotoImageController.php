<?php

namespace api\controllers;

use api\models\PhotoImageSearch;
use reception\forms\GuestPhotoForm;
use reception\repositories\Booking\PhotoRepository;
use reception\useCases\manage\Booking\PhotoManageService;
use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
//use backend\models\PhotoImage;
use yii\web\ServerErrorHttpException;
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;
use yii\web\UploadedFile;


class PhotoImageController extends ActiveController
{
    public $modelClass = 'backend\models\PhotoImage';

    private $photo;
    private $service;

    public function __construct($id, $module, PhotoManageService $service, PhotoRepository $photo, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->photo = $photo;
        $this->service = $service;

    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create-image'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create-image'],
            'rules' => [
                [
                    'allow' => true,
                     'roles' => ['tourist','receptionist'],
                ],
            ],
        ];
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
    /**
     * @SWG\Post(
     *     path="/photoimage",
     *     tags={"Faces"},
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     description="Booking confirmation and door lock application init. Return parameters for booking confirmation (link to Application, user login/password, booking_id, keyboard password for door lock opening), as well send letter to tourist with those parameters",
     *     @SWG\Parameter( name = "Authorization", in="header", type="string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Parameter( name = "img1", in="formData", required=true,  type="file", description = "Photoimage file to upload"),
     *     @SWG\Parameter( name = "info", in="body", required=true, description = "New booking",  @SWG\Schema(ref="#/definitions/Info")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/PhotoImageResponse")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="Info",
     *     type="object",
     *     required= {
     *          "booking_id",
     *      },
     *     @SWG\Property(property="booking_id", type="string", description = "Identity of booking in door lock management system", example= "45"),
     * )
     */
    /**
     *  @SWG\Definition(
     *     definition="PhotoImageResponse",
     *     type="object",
     *     @SWG\Property(property="filename", type="string", description = "Name of photoImage file",example="45_59312a240c5d8.jpg"),
     *     @SWG\Property(property="booking", type="string", description = "External booking identity",example="A 514"),
     *     @SWG\Property(property="uploaded", type="string",example="2017-05-29 14:00:00"),
     *     @SWG\Property(property="id", type="integer", description = "PhotoImage identity ",example="12"),
     * )
     */


    public function actionCreateImage()
    {
        $model = new \backend\models\PhotoImage();

        \yii::$app->request->enableCsrfValidation = false;

        $model->load(Yii::$app->request->getBodyParams(), '');

                //в массив надо передавать сроки пребывания туриста
                $model->date = date('Y-m-d H:i:s');
                $model->user_id = Yii::$app->user->id;
                $model->album_id = ($model->album_id) ? $model->album_id : 1; //по дефолту 1 - нераспознаные
                $model->camera_id=1;
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($model->save()) {
                if (isset($_FILES['file'])) {
                    $postdata = fopen($_FILES['file']['tmp_name'], "r");
                    $extension = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.'));
                }
                else {
                    throw new ServerErrorHttpException('Could not read file from request');
                }
                $filename = $model->id . '_' . uniqid() . $extension;
                /* Open a file for writing */
                $fp = fopen(Yii::getAlias('@imagePath') . '/' . $filename, "w");
                /* Read the data 1 KB at a time and write to the file */
                while ($data = fread($postdata, 1024))
                    fwrite($fp, $data);
                fclose($fp);
                fclose($postdata);
                $model->file_name = $filename;
                $model->save();
                $response = Yii::$app->getResponse();
                $response->setStatusCode(201);
                $id = implode(',', array_values($model->getPrimaryKey(true)));
                $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            }
            $transaction->commit();
            return $model;
        }
        catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }

    }

    public function actionCreatePhoto()
    {
        $form = new GuestPhotoForm();
        $form->load(Yii::$app->request->post(), '');
        if ($form->validate()) {
            try {
                $form->user_id = Yii::$app->user->id;
                $photo = $this->service->create($form);
                if ($photo) {
                    Yii::$app->getResponse()->setStatusCode(201);
                }
                return $this->serializePhoto($photo);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        else {
            Yii::$app->getResponse()->setStatusCode(501);
            throw new ServerErrorHttpException('Failed to add the object'.' '.json_encode ($form->PhotosForm->getErrors()));
        }
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

    public function serializeDocument($photo,$result=null): array
    {

        return [
            'id' => $photo->id,
            'date'=>$photo->date,
            'file_name'=>$photo->file_name,
            'url'=>$photo->getUploadedFileUrl('file_name')
        ];
    }

}
