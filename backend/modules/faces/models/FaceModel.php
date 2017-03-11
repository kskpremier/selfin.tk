<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.03.17
 * Time: 14:41
 */

namespace backend\modules\faces\models;

use backend\modules\faces\Face;
use backend\modules\faces\FaceClient;

class FaceModel
{
    private $filename; //"image1.JPG"
    private $type; //"image/jpeg"
    private $dimensions; //"960x1280"
    private $size; // 1126960,
    private $uploaded; // "2016-11-05T23:09:50+00:00",
    private $id; //": "img-dea3xxldz14ckowgo",
    private $faces; // массив из Face

    /**
     * Load data to model parameters.
     * @param $json string with parameters
     */
    public function load($json) {
        //читаем данные из строки
        $data = json_decode($json);
        //грузим в модель
        $this->filename = $data['filename'];
        $this->type = $data['type'];
        $this->dimensions = $data['dimensions'];
        $this->size = $data['size'];
        $this->uploaded = $data['uploaded'];
        $this->id = $data['id'];
        //создаем массивчик для распознанных лиц
        foreach ($data['faces'] as $face) {
            $this->faces [] = new Face($face);
        }
    }


    /**
     * Detect faces in uploaded images
     * @param $Image string filename*.jpg or array of string
     * @return class FaceModel or Exception
     */
    public static function faceDetect($imageUrl)
    {
        $model = new FaceModel();

        if (is_array ($imageUrl) ) {
            $i=1;
            foreach ($imageUrl as $photo){
                $contentDisposition[] = [
                    'Content-Disposition'=>'form-data; name="img'.$i.'"; filename="'.$photo.'"',
                    'Content-Type'=> 'image/jpeg',
                ];
                $i++;
            }
        }

        //
        //задача сформировать запрос на сервер с приложенным файлом, получить ответ и заполнить полученными данными некую модель
        $client = new FaceClient();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('/v1/face/detect')
            ->setHeaders([  'Authorization'=> $client->token->type.' '.$client->token->token,
                'Content-Type'=>'multipart/form-data',
                $contentDisposition,
            ])
            ->send();
        if ($response->isOk) {
            //загружаем данные в модель
            $model->load (data['img1']);
        }
        else throw new \Exception('No images provided');

        return $model;
    }
}