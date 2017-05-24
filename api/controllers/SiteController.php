<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use api\models\LoginForm;
use api\models\test\BodyPost;
use api\models\test\oFile;
include "/Users/SAS/Sites/E-reception/api/models/test/oFile.php";
include "/Users/SAS/Sites/E-reception/api/models/test/BodyPost.php";

class SiteController extends Controller
{
    public function actionIndex()
    {
        return 'api';
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }

    }
    public function actionSendPost()
    {
        $delimiter = '-------------'.uniqid();
// Формируем объект oFile содержащий файл
        $file = new oFile('/Users/SAS/Sites/E-reception/api/models/test/sample.txt', 'text/plain', 'Content file');
// Формируем тело POST запроса
        $post = BodyPost::Get(['album_id'=>'2','user_id'=>'2','booking_id'=>'2','file_name'=>'sample.txt', 'file'=>$file], $delimiter);
// Инициализируем  CURL
        $ch = curl_init();
// Указываем на какой ресурс передаем файл
        curl_setopt($ch, CURLOPT_URL, 'http://api.domouprav.local/photoimage');
// Указываем, что будет осуществляться POST запрос
        curl_setopt($ch, CURLOPT_POST, 1);
// Передаем тело POST запроса
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        /* Указываем дополнительные данные для заголовка:
             Content-Type - тип содержимого,
             boundary - разделитель и
             Content-Length - длина тела сообщения */
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            //'Authorization: Bearer cWADri54WVNIs_ammPUDmwQSuuhDTw6-',
                'Authorization: cWADri54WVNIs_ammPUDmwQSuuhDTw6-',
            'Content-Type: multipart/form-data; boundary=' . $delimiter,
            'Content-Length: ' . strlen($post)]
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // curl_exec($ch);

        $result = curl_exec ($ch) or die(curl_error($ch));
        echo $result;
        echo curl_error($ch);

        curl_close ($ch);

        echo 'sended';
    }


    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}