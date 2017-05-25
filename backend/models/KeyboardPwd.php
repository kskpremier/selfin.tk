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
use api\models\test\BodyPost;
use api\models\test\oFile;
use api\models\TTL;

/**
 * This is the model class for table "keyboard_pwd".
 *
 * @property integer $id
 * @property string $start_day
 * @property string $end_day
 * @property integer $value
 * @property string $keyboard_pwd_type
 * @property integer $keyboard_pwd_version
 * @property integer $door_lock_id
 * @property integer $booking_id
 * @property string $keyboard_pwd_id
 *
 * @property Booking $booking
 * @property DoorLock $doorLock
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
            [['keyboard_pwd_version', 'booking_id','value','door_lock_id','value'], 'integer'],
            [['start_day', 'end_day'], 'date'],
            [['keyboard_pwd_type'],'string','max' => 15],
            [['keyboard_pwd_type', 'keyboard_pwd_id'], 'string', 'max' => 255],
            [['booking_id','door_lock_id','keyboard_pwd_type','keyboard_pwd_version'], 'required'],
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

    public function getKeyboardPwdLocal(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => 'api.domouprav.local',
//            'requestConfig' => [
//                'format' => Client::FORMAT_JSON
//            ],
//            'responseConfig' => [
//                'format' => Client::FORMAT_JSON
//            ],
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/json'])
            ->addHeaders(['Accept' => 'application/json'])
            ->addHeaders(['Authorization' => 'cWADri54WVNIs_ammPUDmwQSuuhDTw6-'])
            ->setUrl('/password')
            ->setData(['lockId' => $this->id,
                'keyboardPwdVersion' =>$this->keyboard_pwd_version,// $this->keyboardPwdVersion,
                'keyboardPwdType' =>$this->keyboard_pwd_type , //$this->keyboardPwdType,//нет пока этого поля в модели, надо добавить миграцию
                '$startDate'=>$this->start_day,
                '$endDate'=>$this->end_day,
                'date'=>$this->getCurrentTimeMillis(),
                //'accessToken'=>DOMOUPRAV::DOMOUPRAV_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            $this->value = $response->data['keyboardPwd']; //пока непонятно какой ответ возвращает сервер
            $this->keyboardPwdId = $response->data['keyboardPwdId']; //пока непонятно какой ответ возвращает сервер
            return true;
        }
        else return false;
    }
    //return current time in milliseconds
    private function getCurrentTimeMillis(){
        list($usec, $sec) = explode(" ", microtime());
        return (integer)(( (float)$usec + (float)$sec )*1000);
    }

    /*
     * Этот вызов будет дергать наш китайский api контроллер
     * */

    public function getKeyboardPwd(){//sendKeyboardPwdRequest(){
        //тут надо сформировать запрос и послать его на китайский рестапи
      //  $client = $client = new Client([
        //    'baseUrl' => 'https://api.sciener.cn/v3/keyboardPwd/get',
   /*         'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],*/
      //  ]);
//        $response = $client->createRequest()
//            ->setMethod('post')
//            ->setHeaders(['content-type' => 'application/x-www-form-urlencoded'])
//           // ->addHeaders(['Accept' => 'application/json'])
//           // ->setUrl('/v3/keyboardPwd/get')
//            ->setData(['lockId' => "50088",//$this->id,
//                'keyboardPwdVersion' =>4,// $this->keyboardPwdVersion,
//                //'receiverUsername' =>DOMOUPRAV::DOMOUPRAV_RECIEVE_USERNAME,//
//                "clientId" => "7946f0d923934a61baefb3303de4d132",
//                //'$startDate'=>$this->from,
//                "startDate" => "1495635099651",
////                '$endDate'=>$this->till,
//                "endDate" =>  "1495635099655",
//                //'date'=>$this->getCurrentTimeMillis(),
//                "keyboardPwdType" =>  "1",
//                //'accessToken'=>TTL::TTL_TOKEN,
//                "accessToken" =>  "7c714894bea74accb1b98d028dbc8dd5"
//            ])
//            ->send();
        $response = KeyboardPwd::SendPost(
            time(),
            strtotime($this->start_day),
            strtotime($this->end_day),
            TTL::TTL_LOCKID,
            $this->keyboard_pwd_type,
            TTL::TTL_CLIENT_ID,
            TTL::TTL_TOKEN);
        $data= json_decode($response,true);
        if (array_key_exists( 'keyboardPwd',$data) ) {

            $this->value = $data['keyboardPwd'];
            $this->door_lock_id = TTL::TTL_LOCKID;
            return true;
        }
        else return false;
    }

    public static function SendPost($date, $startDate, $endDate, $lockId, $keyboardPwdType, $clientId, $accessToken )
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://api.sciener.cn/v3/keyboardPwd/get',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
            'clientId'=>$clientId,//'7946f0d923934a61baefb3303de4d132',
            'date'=> 1000*$date,//+(8*60+60),
            'accessToken'=>$accessToken,//'7c714894bea74accb1b98d028dbc8dd5',
            'startDate'=> ($startDate)*1000, //китайцы добавляют милисекунды
            'endDate'=> ($endDate)*1000,//китайцы добавляют милисекунды
            'keyboardPwdVersion'=>4,
            'lockId'=>$lockId, //5088
            'keyboardPwdType'=>$keyboardPwdType]) //1-
        ));
        $result = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);
        return $result;
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
            'value'=>'value',
            'keyboard_pwd_type'=>'keyboard_pwd_type',
            'keyboard_pwd_version'=>'keyboard_pwd_version'
        ];
    }
}
