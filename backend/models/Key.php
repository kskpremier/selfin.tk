<?php

namespace backend\models;

use Yii;
use \backend\models\DOMOUPRAV;
use yii\httpclient\Client;

/**
 * This is the model class for table "key".
 *
 * @property integer $id
 * @property string $from
 * @property string $till
 * @property integer $pin
 * @property string $e_key
 * @property integer $booking_id
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
            [['pin', 'booking_id'], 'integer'],
            [['from', 'till'], 'string', 'max' => 20],
            [['e_key'], 'string', 'max' => 15],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
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


    public function getKeyboardPwd(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => 'http://api.domoupar.hr',
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
            ->setUrl('/door-lock/keyboard-password')
            ->setData(['lockId' => $this->id,
                'keyboardPwdVersion' =>4,// $this->keyboardPwdVersion,
                'keyboardPwdType' =>0,//$this->keyboardPwdType,//нет пока этого поля в модели, надо добавить миграцию
                '$startDate'=>$this->from,
                '$endDate'=>$this->till,
                'date'=>$this->getCurrentTimeMillis(),
                'accessToken'=>DOMOUPRAV::TTL_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            $this->pin = $response->data['keyboardPwd'];
            return true;
        }
        else return false;
    }
    //return current time in milliseconds
    private function getCurrentTimeMillis(){
        list($usec, $sec) = explode(" ", microtime());
        return (integer)(( (float)$usec + (float)$sec )*1000);
    }
}
