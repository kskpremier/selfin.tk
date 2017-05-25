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
 * @property integer $guest_id
 * @property integer $booking_id
 * @property integer $door_lock_id
 * @property string $remarks
 * @property string $email
 * @property string $key_status
 * @property integer $key_id
 *
 * @property Booking $booking
 * @property DoorLock $doorLock

 */
class Key extends \yii\db\ActiveRecord
{
    public $guest_id;
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
            [['pin', 'booking_id','door_lock_id','guest_id','key_id'], 'integer'],
            [['remarks'], 'string'],
            [['from', 'till'], 'string', 'max' => 30],
            [['e_key'], 'string', 'max' => 15],
            [['type', 'email', 'key_status'], 'string', 'max' => 255],
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
            'baseUrl' => 'http://api.domouprav.local/e-key',
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
            ->addHeaders(['Authorization' => 'cWADri54WVNIs_ammPUDmwQSuuhDTw6-'])
            ->setData([
                'door_lock_id' => $this->door_lock_id,// TTL::TTL_LOCKID,$this->id,
                'guest_id' =>($this->guest_id),//DOMOUPRAV::DOMOUPRAV_RECIEVE_USERNAME,//
                'from'=>$this->from,
                'till'=>$this->till,
                'date'=>$this->getCurrentTimeMillis(),
                //''
                //'accessToken'=>DOMOUPRAV::DOMOUPRAV_TOKEN
            ])
            ->send();
        if ($response->isOk) {
           // $this->e_key = $response->data['E-key'];
            return true;
        }
        else return false;
    }
/*
 * Этот вызов будет дергать наш api контроллер
 * */
    public function getKeyValue()
    {
        //тут надо сформировать запрос и послать его на китайский рестапи
//        $client = $client = new Client([
//            'baseUrl' => 'http://restapi.domouprav.hr',
//            'requestConfig' => [
//                'format' => Client::FORMAT_JSON
//            ],
//            'responseConfig' => [
//                'format' => Client::FORMAT_JSON
//            ],
//        ]);
//        $response = $client->createRequest()
//            ->setMethod('post')
//            ->setHeaders(['content-type' => 'application/json'])
//            ->addHeaders(['Accept' => 'application/json'])
//            ->setUrl('/key/create')
//            ->setData(['id' => $this->id,
//                'door_lock_id' =>$this->door_lock_id,
//                'booking_id' =>$this->booking_id,
//                'from'=>$this->from,
//                'till'=>$this->till,
//                'type'=>$this->type,
//               // 'date'=>$this->getCurrentTimeMillis(),
//                'accessToken'=>DOMOUPRAV::DOMOUPRAV_TOKEN
//            ])
//            ->send();
        //$this->booking->guest->contact_email
        $response = KeyboardPwd::SendPost(
            time(),
            0,//strtotime($this->from),
            0,//strtotime($this->till),
            TTL::TTL_LOCKID,
//            $this->booking->guest->contact_email,//
            'svrybin%40gmail.com',
            TTL::TTL_CLIENT_ID,
            TTL::TTL_TOKEN,
            'some info or memo');
        $data = json_decode($response, true);
        if (array_key_exists('errcode', $data)) {

            $this->e_key = ($data['errcode'] == 0) ? "1" : "0";
            //$this->door_lock_id = TTL::TTL_LOCKID;
            return true;
        } else return false;
    }
    public static function SendPost($date, $startDate, $endDate, $lockId, $receiverUsername, $clientId, $accessToken,$remarks )
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://api.sciener.cn/v3/key/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'clientId'=>$clientId,//'7946f0d923934a61baefb3303de4d132',
                'date'=> 1000*$date,//+(8*60+60),
                'accessToken'=>$accessToken,//'7c714894bea74accb1b98d028dbc8dd5',
                'startDate'=> ($startDate)*1000, //китайцы добавляют милисекунды
                'endDate'=> ($endDate)*1000,//китайцы добавляют милисекунды
                'lockId'=>$lockId, //5088
                'receiverUsername'=>$receiverUsername,
                'remarks'=>$remarks]) //1-
        ));
        $result = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);
        return $result;
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
            'from'=>'from',
            'till'=>'till',
            'booking_id' => 'booking',
            'door_lock_id'=>'door_lock_id',
            'e_key'=>'e_key'
        ];
    }
}
