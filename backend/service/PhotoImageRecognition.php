<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 01.06.17
 * Time: 23:55
 */
namespace backend\service;

use Yii;
use api\models\test\oFile;
use api\models\test\BodyPost;
use yii\web\ServerErrorHttpException;
use backend\models\Face;
use backend\models\PhotoImage;
use backend\service\Draw;
use yii\httpclient\Client;


/**
 * Class PhotoImageRecognition
 * @property PhotoImage $photoImage;
 *
 * @package backend\service
 */


class PhotoImageRecognition {
    /**
     * @var ActiveRecord model $photoImage
     */
    private $photoImage; // initial photo
    private $token;
    /**
     * @var array ActiveRecord model
     */
    public $faces=[]; //array of faces on initial photo


    /**
     * PhotoImageRecognition constructor.
     * @param PhotoImage $photoImage
     */
    public function __construct (PhotoImage $photoImage){
        $this->photoImage = $photoImage;
    }
    /**
     * Шлет фотографию в сервис распознавания,
     *
     * Назад получает список распознанных лиц на фотографии
     * и добавляет их в базу данных
     *
     * также пытается нарисовать на фото красную линию между выделенными глазами
     *
     **/
    public function recognize() {
        $filename =  $this->photoImage->file_name;
        //если PhotoImage еще не распознана - Status = 0
        if (!$this->photoImage->status) {
            //отправка запроса в Facematika
            $response = $this->faceDetect($filename);
            $data = json_decode($response, true);
            //разбор полученного
            if (is_array($data)) {
                if (!array_key_exists('ErrorCode', $data)) {
                    //здесь бы надо открыть транзакцию и обработать ответ
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $this->photoImage->size = $data['filename']['size'];
                        $this->photoImage->dimensions = $data['filename']['dimensions'];
                        $this->photoImage->uploaded = $data['filename']['uploaded'];
                        $this->photoImage->facematika_id = $data['filename']['id'];
                        foreach ($data['filename']['faces'] as $face) {
                            $newFace = new Face(['face_id' => $face['faceid'], //это стандартный ответ Facematiki
                                'x' => $face['coordinates']['x'],
                                'y' => $face['coordinates']['y'],
                                'width' => $face['coordinates']['width'],
                                'angle' => $face['coordinates']['angle'],
                                'photo_image_id' => $this->photoImage->id
                            ]);
                            $newFace->save();
                            //вырезание квадрата лица для показа
                            $draw = new Draw($this->photoImage);
                            $face_image = $draw->getFaceRectangleImage($newFace);

                            imagejpeg($face_image, Yii::getAlias('@imagePath') . '/' . $newFace->face_id . '.jpg');
                            $this->photoImage->status = 1;
                            $this->photoImage->save();
                        }

                        $transaction->commit();
                        return true;
                    }
                     catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                }
            }
            throw new ServerErrorHttpException('Wrong result of face recognition');
        } throw new ServerErrorHttpException('Photo has been already recognized');
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function faceDetect($filename)
    {
        $token  = FACEMATIKA::token();
        $result = $this->testRequest($token,$filename);
        return $result->getContent();

    }

    private function testRequest($token,$filename){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(FACEMATIKA::FACEMATIKA_URL_TO_FACE_DETECT)
            ->setHeaders([
                'Authorization: bearer '. $token,
                'Content-Type: multipart/form-data;'])
            ->addFile('filename', Yii::getAlias('@imagePath').'/'.$filename)
            ->send();
        return $response;
    }
    /**
     * Match specified face with a list of faces passed in request
     * @param string $originFace - id of origin photo
     * @param array of string $listOfFaces - ids of photo for compare
     * @return mixed answers with probabilities like string
     * json Match-factor value calculated for each image in the list
     *  HTTP/1.1 200 OK
        Content-Type: application/json
        {
            "result": [
                { "face-dea4x468ifc4wg0kw": 0.92202816724777 },
                { "face-dea4wqi45ts04w8cw": 0.38850954174995 },
                { "face-dea4pyf2di8ks0408": 0.33542823791504 }
            ],
            "processing-time": "0.0127 seconds"
        }
     *
     *
     */
    public static function faceMatch($originFace, $listOfFaces)
    {
        $post ='[';
        foreach ($listOfFaces as $face) {
            $face_string = '{"faceid":"'.$face->face_id.'"}';
            $post.=$face_string;
            $post.=',';
        }
        $token  = FACEMATIKA::token();
        $post = substr($post, 0, -1);
        $post.=']';
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(FACEMATIKA::FACEMATIKA_URL_TO_FACE_MATCH.'/'.$originFace->face_id.'/match')
            ->setHeaders([
                'Authorization: bearer '. $token,
                'Content-Type: application/json'])
           ->setContent($post)
            ->send();

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, FACEMATIKA::FACEMATIKA_URL_TO_FACE_MATCH.'/'.$originFace->face_id.'/match');
////        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, [
//                'Authorization: bearer '. $token,
//                'Content-Type: application/json',
//                ]
//        );

        $result = $response->content;//curl_exec ($ch) or die(curl_error($ch));
        //curl_close ($ch);
        return $result;
    }


    /**
     * @param null $page
     * @param null $pageSize
     * @return mixed or JSON with list
     * {
        "total-faces": 28,
        "page": 0,
        "page-size": "5",
        "total-pages": 6,
        "faces": [
            {
                "faceid": "face-dea4pyf2di8ks0408",
                "coordinates": {
                "x": 662.28021240234,
                "y": 274.07925415039,
                "width": 183.35799543015,
                "angle": 0.022247155865367
                },
                "timestamp": "2016-10-18T17:39:41+00:00",
                "img": {
                "filename": "test153.jpg",
                "dimensions": "1024x768",
                "id": "img-dea4p0uin9wsgkso0"
                 }
            },
        {
        "faceid": ...
     * }
     *
     */
    public function faceList($page=null, $pageSize=null)
    {

        $token  = FACEMATIKA::token();
        if ($page) {
            $queryString = '?page='.$page.'&pagesize='. ($pageSize)?$pageSize:'5';
        }
        else $queryString = '?pagesize='. ($pageSize)?$pageSize:'5';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, FACEMATIKA::FACEMATIKA_URL_TO_FACE_LIST.$queryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Authorization: bearer '. $token]);

        $result = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);
        return $result;
    }

    /**
     * @param null $period
     * @return mixed
     */
    public function faceCleanUp($period=null)
    {
        $token  = FACEMATIKA::token();
        //by default 1 our
        $queryString = '?period='.($period)?$period:'1';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, FACEMATIKA::FACEMATIKA_URL_TO_FACE_CLEANUP.$queryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Authorization: bearer '. $token]);

        $result = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);
        return $result;
    }
    private function getMimeContentType(){
        return mime_content_type(Yii::getAlias('@imagePath').'/'.$this->photoImage->file_name);
    }
}