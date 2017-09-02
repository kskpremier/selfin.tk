<?php
/**
* Created by PhpStorm.
 * User: SVRybin
* Date: 14.4.2017.
 * Time: 0:38
*/

/**
 * This is the model class for table "door_lock".
 *
* @property  lockId
* @property  keyboardPwdVersion
* @property  keyboardPwdType
* @property  startDate
* @property  endDate
* @property  date
* @property  keyboard_password

**/

namespace api\models;


use yii\base\Model;
use yii\httpclient\Client;

/**
 * Login form
 */
class GetKeyboardKey extends Model
{

    public $lockId;
    public $keyboardPwdVersion;
    public $keyboardPwdType;
    public $startDate;
    public $endDate;
    public $keyboard_password;
    public $date;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lockId', 'keyboardPwdType'], 'required','integer'],
            [['keyboardPwdVersion', 'lockId'],'integer'],
            [['startDate','endDate','date'],'date']
        ];
    }

    /**
     * Build and send Http request to TTL china sever
     * @return integer
     */


    public function getKeyboardPwd(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => 'https://api.sciener.cn',
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->addHeaders(['Accept' => 'application/json'])
            ->setUrl('/v2/lock/listShareKey')
            ->setData(['lockId' => $this->lockId,
                        'keyboardPwdVersion' => $this->keyboardPwdVersion,
                        'keyboardPwdType' =>$this->keyboardPwdType,
                        '$startDate'=>$this->startDate,
                        '$endDate'=>$this->endDate,
                        'date'=>$this->getCurrentTimeMillis(),
                        'clientId'=>TTL::TTL_CLIENT_ID,
                        'accessToken'=>TTL::TTL_TOKEN
            ])
            ->send();

        if ($response->isOk) {
            $this->keyboard_password = $response->data['keyboardPwd'];

            return true;
        }
        else return false;
    }
    //return current time in milliseconds
    private function getCurrentTimeMillis(){
        list($usec, $sec) = explode(" ", microtime());
        return (integer)(( (float)$usec + (float)$sec ) *1000);
    }
    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'keyboardPwd'=>'keyboard_password'
        ];
    }

}