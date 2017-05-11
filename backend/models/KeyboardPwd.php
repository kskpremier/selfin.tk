<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 12:28
 */

namespace backend\models;

use Yii;
use \backend\models\DOMOUPRAV;
use yii\httpclient\Client;

/**
 * This is the model class for table "key".
 *
 * @property integer $id
 * @property string $end_day
 * @property string $start_day
 * @property integer $keyboard_pwd_version
 * @property integer $value
 * @property string $keyboard_pwd_type
 * @property integer $door_lock_id
 * @property integer $booking_id
 *
 * @property Booking $booking
 */
class KeyboardPwd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyboard_pwd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyboard_pwd_version', 'booking_id','value','door_lock_id'], 'integer'],
            [['start_day', 'start_day'], 'string', 'max' => 20],
            [['keyboard_pwd_type'],'string','max' => 15],
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
            'door_lock_id' => Yii::t('app', 'Booking ID'),
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
                'keyboardPwdType' =>0, //$this->keyboardPwdType,//нет пока этого поля в модели, надо добавить миграцию
                '$startDate'=>$this->start_day,
                '$endDate'=>$this->end_day,
                'date'=>$this->getCurrentTimeMillis(),
                'accessToken'=>DOMOUPRAV::DOMOUPRAV_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            $this->value = $response->data['keyboardPwd']; //пока непонятно какой ответ возвращает сервер
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
            'start_date'=>'start_date',
            'end_date'=>'end_date',
            'booking_id' => 'booking',
            'door_lock_id'=>'door_lock',
            'value'=>'keyboard_password',
            'keyboard_pwd_type'=>'keyboard_password_type',
            'keyboard_pwd_version'=>'keyboard_pwd_version'

        ];
    }
}
