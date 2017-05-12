<?php

namespace backend\models;

use Yii;
use \backend\models\DOMOUPRAV;
use \api\models\TTL;
use yii\httpclient\Client;

/**
 * This is the model class for table "key".
 *
 * @property integer $id
 * @property string $from
 * @property string $till
 * @property string $type
 * @property integer $pin
 * @property string $e_key
 * @property integer $booking_id
 * @property integer $door_lock_id
 *
 * @property Booking $booking
 */
class Key extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pin', 'booking_id','door_lock_id'], 'integer'],
            [['from', 'till'], 'string', 'max' => 30],
            [['e_key'], 'string', 'max' => 15],
            [['type'],'string','max' => 15],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
            [['door_lock_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['door_lock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from' => Yii::t('app', 'From'),
            'till' => Yii::t('app', 'Till'),
            'pin' => Yii::t('app', 'Pin'),
            'e_key' => Yii::t('app', 'E Key'),
            'booking_id' => Yii::t('app', 'Booking ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['id' => 'door_lock_id']);
    }
    /*
     * Этот вызов будет дергать наш китайский api контроллер
     * */

    public function sendEKey(){
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
            ->setUrl('/v3/key/send')
            ->setData(['lockId' => $this->id,
                'keyboardPwdVersion' =>4,// $this->keyboardPwdVersion,
                'receiverUsername' =>DOMOUPRAV::DOMOUPRAV_RECIEVE_USERNAME,//
                '$startDate'=>$this->from,
                '$endDate'=>$this->till,
                'date'=>$this->getCurrentTimeMillis(),
                'accessToken'=>TTL::TTL_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            $this->e_key = $response->data['E-key'];
            return true;
        }
        else return false;
    }
/*
 * Этот вызов будет дергать наш api контроллер
 * */
    public function getKeyValue(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => 'http://restapi.domouprav.hr',
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/json'])
            ->addHeaders(['Accept' => 'application/json'])
            ->setUrl('/key/create')
            ->setData(['id' => $this->id,
                'door_lock_id' =>$this->door_lock_id,
                'booking_id' =>$this->booking_id,
                'from'=>$this->from,
                'till'=>$this->till,
                'type'=>$this->type,
               // 'date'=>$this->getCurrentTimeMillis(),
                'accessToken'=>DOMOUPRAV::DOMOUPRAV_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            $this->e_key = $response->data['E-key'];
            return true;
        }
        else return false;
    }

    //return current time in milliseconds
    private function getCurrentTimeMillis(){
        list($usec, $sec) = explode(" ", microtime());
        return (integer)(( (float)$usec + (float)$sec )*1000);
    }
    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'id' => 'id',
            'from'=>'start_date',
            'till'=>'end_date',
            'booking_id' => 'booking',
            'door_lock_id'=>'door_lock',
            'e_key'=>'E-key'
        ];
    }
}
