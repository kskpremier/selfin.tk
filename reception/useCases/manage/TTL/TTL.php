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
    public const TTL_URL_TO_ADD_PASSCODE ="https://api.sciener.cn/v3/keyboardPwd/add";
    public const TTL_URL_TO_REFRESH_TOKEN = 'https://api.sciener.cn/oauth2/token';
    public const TTL_URL_TO_GET_TOKEN = 'https://api.sciener.cn/oauth2/token';
    public const TTL_URL_TO_INIT_DOOR_LOCK = 'https://api.sciener.cn/v3/lock/init';
    public const TTL_URL_TO_DELETE_ONE_PASSCODE = "https://api.sciener.cn/v3/keyboardPwd/delete";
    public const TTL_DOOR_LOCK_PASSWORD = "8a6cdf478c7ddcb0a15caa8ac3d0e7f8";
    public const TTL_DOOR_LOCK_USERNAME = "doorlockadmin@domouprav.hr";
    public const TTL_OPENID = 1200586764;
    public const TTL_SCOPE = 'user,key,room';
    public const TTL_DOOR_LOCK_ADMIN_USERNAME = "admin"; //для нашей базы
    public const TTL_CLIENT_ID = "7946f0d923934a61baefb3303de4d132";
    public const TTL_CLIENT_SECRET = "56d9721abbc3d22a58452c24131a5554";
    public const TTL_ADMIN = 3;
    public const TTL_KEY_PERIOD_TYPE=0;
    public const TTL_KEY_PERMANENT_TYPE=2;
    public const TTL_KEY_ADMIN_TYPE=99;
    public const VIA_BLUETOOTH=1;
    public const VIA_GATEWAY=2;


    public static function getToken($userId){
        //юзер по умолчанию наш администратор
        $token = self::find()->where(['user_id'=>self::TTL_ADMIN])->orderBy(['expires'=>SORT_DESC])->one();
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
                $token->client_id = self::TTL_CLIENT_ID;
                $token->client_secret = self::TTL_CLIENT_SECRET;
                $token->redirect_uri = 'http://www.sciener.cn';
                $token->user_id = self::TTL_ADMIN;
                $token->openid = self::TTL_OPENID;
                $token->scope = self::TTL_SCOPE;
                $token->save();

            }
            else {
                $token = self::getNewToken();
            }
            return $token;
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
                $token->client_id = self::TTL_CLIENT_ID;
                $token->client_secret = self::TTL_CLIENT_SECRET;
                $token->redirect_uri = 'http://www.sciener.cn';
                $token->user_id = self::TTL_ADMIN;
                $token->openid = self::TTL_OPENID;
                $token->scope = self::TTL_SCOPE;
                $token->save();
                return $token;
            }
            throw new ServerErrorHttpException("Can not renew TTL token!");
        }
    }

}