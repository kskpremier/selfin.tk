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
 * @property string $start_date
 * @property string $end_date
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
 * @property long $last_update_date
 * @property integer $open_id
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
            [['pin', 'booking_id','door_lock_id','guest_id','key_id','open_id'], 'integer'],
            [['remarks'], 'string', 'max'=>100],
            [['start_date', 'end_date'], 'safe'],
            [['e_key','last_update_date'], 'string', 'max' => 15],
            [[ 'email', 'key_status','type'], 'string', 'max' => 255],
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
            'start_date' => Yii::t('app', 'start_date'),
            'end_date' => Yii::t('app', 'end_date'),
            'pin' => Yii::t('app', 'Pin'),
            'e_key' => Yii::t('app', 'E Key'),
            'booking_id' => Yii::t('app', 'Booking ID'),
            'open_id'=>Yii::t('app','Open id'),
            'last_update_date'=>Yii::t('app','Last update'),
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
     * Этот вызов будет дергать наш api контроллер
     * */

    public function sendEKeyByLocal(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => DOMOUPRAV::DOMOUPRAB_ABSOLUTE_URL_TO_SEND_EKEY,
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
            ->addHeaders(['Authorization' => 'Bearer '.DOMOUPRAV::DOMOUPRAV_ADMIN_TOKEN])
            ->setData([
                'door_lock_id' => $this->door_lock_id,
                'booking_id'=> $this->booking_id,
                'guest_id' =>($this->guest_id),
                'type'=>$this->type,
                'start_date'=>($this->type == '2')?  '0' : strtotime($this->start_date),
                'end_date'=>($this->type == '2')?  '0' : strtotime( $this->end_date), //2 - это на период, надеюсь
                'email'=> 'svrybin@gmail.com',//$this->guest->contact_email,
                'accessToken'=> DOMOUPRAV::DOMOUPRAV_ADMIN_TOKEN
            ])
            ->send();
        if ($response->isOk) {
           // $this->e_key = $response->data['E-key'];
            return $response->data['id'];
        }
        else return false;
    }

    /**
     * Этот сервер будет посылать запрос через китайский сервис
     * @return string
     */

    public function sendEKeyValueFromChina() {
        $response = Key::SendPost(
            time(),
            ($this->type == '2')?  0 : $this->start_date,
            ($this->type == '2')?  0 : $this->end_date,
            $this->doorLock->lock_id,
            $this->email,
            TTL::TTL_CLIENT_ID,
            TTL::TTL_TOKEN,
            'some info or memo');
        $data = json_decode($response, true);
        if (is_array($data)) {
            if (array_key_exists('errcode', $data)) {
                $this->e_key = ($data['errcode'] == 0) ? "1" : "0";
                $this->start_date = ($this->type == '2')? 0: $this->start_date;
                $this->end_date = ($this->type == '2')? 0: $this->end_date;

                $data['success'] =  $this->save();
            } else $data['success'] = false;
            return json_encode($data);
        }
        else throw new ServerErrorHttpException('Problems with request '. $response);
    }
    public static function SendPost($date, $startDate, $endDate, $lockId, $receiverUsername, $clientId, $accessToken,$remarks )
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt_array($ch, array(
            CURLOPT_URL => TTL::TTL_URL_TO_KEY_SEND,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'clientId'=>$clientId,//'7946f0d923934a61baefb3303de4d132',
                'date'=> 1000*$date,//
                'accessToken'=>$accessToken,//'7c714894bea74accb1b98d028dbc8dd5',
                'startDate'=> ($startDate)*1000, //китайцы добавляют милисекунды
                'endDate'=> ($endDate)*1000,
                'lockId'=>$lockId,
                'receiverUsername'=>$receiverUsername,
                'remarks'=>$remarks])
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
            'start_date'=>'start_date',
            'end_date'=>'end_date',
            'booking_id' => 'booking_id',
            'door_lock_id'=>'door_lock_id',
//            'e_key'=>'e_key',
            'type'=>'type',
            'key_id'=>'key_id',
            'key_status'=>'key_status'
        ];
    }

}
