<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.03.17
 * Time: 14:11
 */

namespace backend\modules\faces\models;

use \backend\modules\faces\models\FaceClient;

class Token
{

    private $_token;
    private $_expires;
    private $_type;

    public function __construct () {
        $this->getNewToken();
        return $this;
    }
    //запрос на получение токена, если это необходимо
    private function getNewToken() {

        $s = date('Y-m-d\TH:i:sP');
        // проверяем был ли уже создан токен или срок его действия истек
        if ( !isSet($this->_token) || ( $this->_expires < date('Y-m-d\TH:i:sP') ) ) {
            //делаем запрос на получение нового токена
            $client = new FaceClient();
            $response = $client->createRequest()
                                ->setMethod('get')
                                ->setUrl('https://api.facematica.vocord.ru/v1/account/login')
                                ->setHeaders(["Content-Type" => "application/json"])
                                ->setData(["api_key" => "fcm3d9fe7b8281bd750d4b852de9a7ab0a5fcm"])
                                ->send();
            //если ответ получен, то инициализируем текущие значения токена
            if ($response->isOk) {
                $this->_token = $response->data['token'];
                $this->_expires = $response->data['expires'];
                $this->_type = $response->data['type'];
                return $this; //вернем сам токен
            }
            else   throw new \Exception('Login Failed'); //вернем сообщение об ошибке
        }
    }
    //вернет строку самого токена
    public function getTokenValue() {

        if ($this->_expires < date('Y-m-d\TH:i:sP') )
            $this->getNewToken();

        return $this->_token;;
    }

    //вернет срок действия
    public function getExpiresValue() {
        if ($this->_expires < date('Y-m-d\TH:i:sP') )
            $this->getNewToken();
        return $this->_expires;

    }

    //вернет тип токена
    public function getTypeValue() {
        if ($this->_expires < date('Y-m-d\TH:i:sP') )
            $this->getNewToken();
       return $this->_type;

    }


}