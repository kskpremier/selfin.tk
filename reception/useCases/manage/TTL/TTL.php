<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 10.07.17
 * Time: 11:43
 */
namespace reception\useCases\manage\TTL;

use yii\httpclient\Client;
use yii\db\ActiveRecord;

use yii\web\ServerErrorHttpException;

class TTL extends ActiveRecord {

    //пока захардкорил клиентский идентификатор и полученный токен
    public const TTL_URL_TO_KEY_SEND = 'https://api.sciener.cn/v3/key/send';
    public const TTL_URL_TO_KEYBOARD_PWD_GET = 'https://api.sciener.cn/v3/keyboardPwd/get';
    public const TTL_URL_TO_REFRESH_TOKEN = 'https://api.sciener.cn/v3/oauth2/token';
    public const TTL_URL_TO_GET_TOKEN = 'https://api.sciener.cn/v3/oauth2/token';
    public const TTL_URL_TO_INIT_DOOR_LOCK = 'https://api.sciener.cn/v3/lock/init';
    public const TTL_DOOR_LOCK_PASSWORD = "8a6cdf478c7ddcb0a15caa8ac3d0e7f8";
    public const TTL_DOOR_LOCK_USERNAME = "doorlockadmin@domouprav.hr";
    public const TTL_DOOR_LOCK_ADMIN_USERNAME = "admin"; //для нашей базы
    public const TTL_CLIENT_ID = "7946f0d923934a61baefb3303de4d132";
    public const TTL_CLIENT_SECRET = "56d9721abbc3d22a58452c24131a5554";

    public static function getToken($userId){

        $token = self::find()->where(['user_id'=>$userId])->one();
        if ($token) {
            return (self::isTokenValid($token))? $token: self::refreshToken($token);
        }
        throw new ServerErrorHttpException("Can not find token for this userId!");
    }

    public static function isTokenValid($token) {
            if( $token->expires < time() ){
                return false;
            }
        return true;
    }

    public static function tableName()
    {
        return '{{%ttl}}';
    }

    public static function refreshToken($token){
        $client = $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(self::TTL_URL_TO_REFRESH_TOKEN)
            ->addHeaders(["Content-Type"=>"application/x-www-form-urlencoded"])
            ->setData(['refresh_token' => $token->refresh_token,
                        'client_id'=>$token->client_id,
                'client_secret'=>$token->client_secret,
                'grant_type'=>'refresh_token',
                'redirect_uri'=>'http://www.sciener.cn'])
            ->send();
        $data = json_decode($response->getContent(),true);
        if (is_array($data)) {
            if (array_key_exists('access_token', $data)) {
                $token->access_token = $data["access_token"];
                $token->refresh_token = $data["refresh_token"];
                $token->expires_in = $data["expires_in"];
                $token->expires = time() + $data["expires_in"];
                $token->status = 1;
                $token->save();
                return $token;
            }
            else self::getNewTokew();
        }
    }

    public static function getNewToken(){
        $client = $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(self::TTL_URL_TO_GET_TOKEN)
            ->addHeaders(["Content-Type"=>"application/x-www-form-urlencoded"])
            ->setData(['username' => TTL::TTL_DOOR_LOCK_USERNAME,
                'client_id'=>TTL::TTL_CLIENT_ID,
                'client_secret'=>TTL::TTL_CLIENT_SECRET,
                'grant_type'=>'password',
                'password'=>TTL::TTL_DOOR_LOCK_PASSWORD,
                'redirect_uri'=>'http://www.sciener.cn'])
            ->send();
        $data = json_decode($response->getContent(),true);
        if (is_array($data)) {

            if (array_key_exists('access_token', $data)) {
                $token = new TTL();
                $token->access_token = $data["access_token"];
                $token->refresh_token = $data["refresh_token"];
                $token->expires_in = $data["expires_in"];
                $token->expires = time() + $data["expires_in"];
                $token->status = 1;
                $token->save();
                return $token;
            }
            throw new ServerErrorHttpException("Can not renew TTL token!");
        }
    }

}