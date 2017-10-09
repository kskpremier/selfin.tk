<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 02.06.17
 * Time: 0:06
 */

namespace backend\service;

use yii\httpclient\Client;
use yii\db\ActiveRecord;

use yii\web\ServerErrorHttpException;

class FACEMATIKA extends ActiveRecord
{
    public const FACEMATIKA_URL_TO_TOKEN = "https://api.facematica.vocord.ru/v1/account/login";
    public const FACEMATIKA_URL_TO_FACE_DETECT = "https://api.facematica.vocord.ru/v1/face/detect";
    public const FACEMATIKA_URL_TO_FACE_MATCH = "https://api.facematica.vocord.ru/v1/face";
    public const FACEMATIKA_URL_TO_FACE_LIST = "https://api.facematica.vocord.ru/v1/face/list";
    public const FACEMATIKA_URL_TO_FACE_CLEANUP = "https://api.facematica.vocord.ru/v1/face/cleanup";

    public const FACEMATIKA_ACCESS_TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhcGkuZmFjZW1hdGljYS52b2NvcmQucnUiLCJpYXQiOjE0OTk0Mzc3NTEsImV4cCI6MTUwMDA0MjU1MSwidXNlcmRhdGEiOnsiaWQiOiIxMTIwIn19.qfhDg9Uj2nYUCSlPmcHqkLLiLK0nNS6DkxaFBiSaLZU";
    public const FASEMATIKA_EXPIRED_TOKEN = "2017-07-14T17:29:11+03:00";
    public const FASEMATIKA_API_KEY = "fcm3d9fe7b8281bd750d4b852de9a7ab0a5fcm";

    private $_token;
    private $_expires;

    /**
     * FACEMATIKA constructor.
     * @param $_token
     * @param $_expires
     */
    public static function token():string
    {
        $token = new static();
        $expiresString = $token->find()->max('expires');
        $expires = (!$expiresString)?0:strtotime($expiresString);
        if ($expires < time()+6000) {

            $client = $client = new Client();
            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl(self::FACEMATIKA_URL_TO_TOKEN)
                ->setData(['api_key' => self::FASEMATIKA_API_KEY])
                ->send();
            $data = json_decode($response->getContent(),true);
            if (is_array($data)) {
                if (array_key_exists('token', $data)) {
                    $token->token = $data["token"];
                    $token->expires = $data["expires"];
                    $token->status = 1;
                    $token->type =$data["type"];
                    $token->save();
                    return $token->token;
                }
                throw new ServerErrorHttpException("Can not renew token!");
            }
        }
        else return $token->findOne(['expires'=>$expiresString])->token;
    }

    public static function faceCompare($post,$face_id){
        $token = self::token();
        $client = new Client();
        $response = $client->createRequest()
        ->setMethod('post')
        ->setUrl(FACEMATIKA::FACEMATIKA_URL_TO_FACE_MATCH . '/' . $face_id . '/match')
        ->setHeaders([
        'Authorization: bearer ' . $token,
        'Content-Type: application/json'])
        ->setContent($post)
        ->send();
        return $response;
    }

    public static function tableName()
    {
        return '{{%facematika}}';
    }

}

