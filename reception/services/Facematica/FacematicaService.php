<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 02.06.17
 * Time: 0:06
 */

namespace reception\services\Facematica;

use function GuzzleHttp\Psr7\mimetype_from_filename;
use yii\httpclient\Client;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

class FacematicaService extends ActiveRecord
{
    public const FACEMATIKA_URL_TO_TOKEN = "https://api.facematica.vocord.ru/v1/account/login";
    public const FACEMATIKA_URL_TO_FACE_DETECT = "https://api.facematica.vocord.ru/v1/face/detect";
    public const FACEMATIKA_URL_TO_FACE_MATCH = "https://api.facematica.vocord.ru/v1/face";
    public const FACEMATIKA_URL_TO_FACE_LIST = "https://api.facematica.vocord.ru/v1/face/list";
    public const FACEMATIKA_URL_TO_FACE_CLEANUP = "https://api.facematica.vocord.ru/v1/face/cleanup";
    public const FACEMATIKA_URL_TO_PUT_IN_ALBUM = "https://api.facematica.vocord.ru/v1/album";
    public const FACEMATIKA_URL_TO_RECOGNIZE_ALBUM = "https://api.facematica.vocord.ru/v1/album";
    public const FACEMATIKA_ACCESS_TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhcGkuZmFjZW1hdGljYS52b2NvcmQucnUiLCJpYXQiOjE0OTk0Mzc3NTEsImV4cCI6MTUwMDA0MjU1MSwidXNlcmRhdGEiOnsiaWQiOiIxMTIwIn19.qfhDg9Uj2nYUCSlPmcHqkLLiLK0nNS6DkxaFBiSaLZU";
    public const FASEMATIKA_EXPIRED_TOKEN = "2017-07-14T17:29:11+03:00";
    public const FASEMATIKA_API_KEY = "fcm3d9fe7b8281bd750d4b852de9a7ab0a5fcm";

    private $_token;
    private $_expires;

    /**
     * Get Token for operations with Facematica service
     * @param $_token
     * @param $_expires
     * @return String or ServerErrorHttpException
     */
    public static function token()
    {
        $token = new static();
        $expiresString = $token->find()->max('expires');
        $expires = (!$expiresString)?0:strtotime($expiresString);
        if ($expires < time()+6000) {

            $client = $client = new Client() ;
            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl(self::FACEMATIKA_URL_TO_TOKEN)
                ->setData(['api_key' => self::FASEMATIKA_API_KEY])
                ->send();
            $data = json_decode($response->getContent(),true);

            if ($response->getIsOk()) {
                if (is_array($data)) {
                    if (array_key_exists('token', $data)) {
                        $token->token = $data["token"];
                        $token->expires = $data["expires"];
                        $token->status = 1;
                        $token->type =$data["type"];
                        $token->save();
                        return $token->token;
                    }
            }
            else  throw new ServerErrorHttpException("Can not renew Facematica token!");
            }
        }
        else return $token->find()->where(['expires'=>$expiresString])->one()->token;
    }
    /**
     * Compare $mainFaceId with all faces in collection $faceIds
     * @param $filename
     * @return mixed
     */
    public static function faceMatch ($mainFaceId, array $faceIds) {
        $token = self::token();
        //делаем Json для запроса формата
        //  [{"faceid": "face-dea4x468ifc4wg0kw"},
        //   {"faceid": "face-dea4wqi45ts04w8cw"},
        //   {"faceid": "face-dea4pyf2di8ks0408"}]
        $post='[';
        foreach ($faceIds as $face) {
                $face_string = '{"faceid":"'.$face.'"}';
                $post.=$face_string;
                $post.=',';
        }
        $post = substr($post, 0, -1);
        $post.=']';
        //собственно сам запрос
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(self::FACEMATIKA_URL_TO_FACE_MATCH . '/' . $mainFaceId . '/match')
            ->setHeaders(['Authorization'=>'bearer '. $token, 'Content-Type'=> 'application/json'])
            ->setContent($post)
            ->send();
        return $response;
    }

    /**
     * Detect faces in all $files
     * @param array $files
     * @return mixed
     */
    public static function faceDetect(array $files) {
        $token = self::token();
        $client = new Client();
        $request = $client->createRequest()
            ->setMethod('post')
            ->setUrl(self::FACEMATIKA_URL_TO_FACE_DETECT)
            ->setHeaders([
                'Authorization'=> 'bearer '. $token,
                'Content-Type'=> 'multipart/form-data']);
        foreach ($files as $file)
            {
                $path_parts = pathinfo($file);
                $request->addFile($path_parts['filename'],$file);
            }
        $response=$request->send();
        return $response;
    }

    /**
     * Add faces in $faceIds in album with name SalbumName and $desription
     * @param string $albumName
     * @param string  $decription
     * @param array $faceIds
     * @return mixed
     */
    public static function putFacesinAlbum($albumName, $decription, array $faceIds) {
        $token = self::token();
        $client = new Client();
        $post = '{"description":"'.$decription.'","name":""},"faces":[';
        foreach ($faceIds as $face) {
            $face_string = '{"faceid":"'.$face.'"}';
                $post.=$face_string;
                $post.=',';
        }
        $post = substr($post, 0, -1);
        $post.=']}';
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(self::FACEMATIKA_URL_TO_PUT_IN_ALBUM. '/' . $albumName)
            ->setHeaders(['Authorization'=>'bearer '. $token, 'Content-Type'=> 'application/json'])
            ->setContent($post)
            ->send();
        return $response;
    }

    /**
     * Recognize $faceId in $albumName
     * @param string $albumName
     * @param string  $faceId
     * @return mixed
     */
    public static function recognizeFaceInAlbum($albumName, $faceId) {
        $token = self::token();
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(self::FACEMATIKA_URL_TO_RECOGNIZE_ALBUM. '/' . $albumName . '/recognize?faceid='.$faceId)
            ->setHeaders(['Authorization' => 'bearer '. $token])
            ->send();
        return $response;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{facematika}}';
    }

}