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
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

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
            [['keyboard_pwd_version', 'booking_id','value','door_lock_id','keyboard_pwd_id'], 'integer'],
            [['start_day', 'end_day'], 'safe'],
            [['keyboard_pwd_type', 'value'], 'string', 'max' => 255],
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
            'door_lock_id' => Yii::t('app', 'Door lock ID'),
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
     * Этот вызов будет дергать китайский наш api
     * */

    public function getKeyboardPwdLocal(){
        //тут надо сформировать запрос и послать
        $client = $client = new Client([
          //  'baseUrl' => DOMOUPRAV::DOMOUPRAV_URL_TO_KEYBOARD_PWD_GET,
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/x-www-form-urlencoded'])

            ->addHeaders(['Authorization' =>'Bearer '.DOMOUPRAV:: DOMOUPRAV_ADMIN_TOKEN ])
            ->setUrl(DOMOUPRAV::DOMOUPRAV_URL_TO_KEYBOARD_PWD_GET)
            ->setData([
                'door_lock_id' => $this->door_lock_id,
                'booking_id'=>$this->booking_id,
                'keyboard_pwd_version' => $this->keyboard_pwd_version,
                'keyboard_pwd_type' => $this->keyboard_pwd_type ,
                'start_day'=>  $this->start_day,
                'end_day'=> ($this->keyboard_pwd_type == 2)?  0 : $this->end_day,
                'accessToken'=>DOMOUPRAV:: DOMOUPRAV_ADMIN_TOKEN
            ])
            ->send();
        if ($response->isOk) {
//            $this->value = $response->data['value']; //пока непонятно какой ответ возвращает сервер
//            $this->keyboard_pwd_id = $response->data['keyboard_pwd_id']; //пока непонятно какой ответ возвращает сервер
            return $response->data['id'];
        }
        else return false;
    }
    //return current time in milliseconds
    private function getCurrentTimeMillis(){
        list($usec, $sec) = explode(" ", microtime());
        return (integer)(( (float)$usec + (float)$sec )*1000);
    }

    /**
     * Этот вызов будет дергать китайский api контроллер
     * При успешном получении ответа запишет данные в модель и сохранит ее, вернет json
     * @return string json like {"keyboardPwdId":501168,"keyboardPwd":"45866000","success":"true"}
     * */

    public function getKeyboardPwdFromChina(){
        $response = KeyboardPwd::SendPost(
            time(),
            strtotime($this->start_day),
            ($this->keyboard_pwd_type == 2)?  0 : strtotime($this->end_day),
            $this->doorLock->lock_id ,//TTL::TTL_LOCKID,
            $this->keyboard_pwd_type,
            TTL::TTL_CLIENT_ID,
            TTL::TTL_TOKEN,
            $this->keyboard_pwd_version//4 по умолчанию
        );

        $data = json_decode($response,true);
        //в китайском ответе должно быть поле keyboardPwd
        if (is_array($data)){
            if (array_key_exists('keyboardPwd', $data)) {
                $this->value = $data['keyboardPwd'];
                $this->keyboard_pwd_id = $data['keyboardPwdId'];
                $this->start_day = strtotime($this->start_day);
                $this->end_day = ($this->keyboard_pwd_type == 2)? 0: strtotime($this->end_day);

                $data['success'] =  $this->save();
            }
            else if (array_key_exists('errcode', $data) ) {
                if ($data['errcode']!=0) $data['success'] = false;
            }
            return json_encode($data);
        }
        else throw new ServerErrorHttpException('Problems with request '. $response);

    }

    public static function SendPost($date, $startDate, $endDate, $lockId, $keyboardPwdType, $clientId, $accessToken, $keyboardPwdVersion )
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt_array($ch, array(
            CURLOPT_URL => TTL::TTL_URL_TO_KEYBOARD_PWD_GET,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
            'clientId'=>$clientId,
            'date'=> 1000*$date,//+(8*60+60),
            'accessToken'=>$accessToken,//'7c714894bea74accb1b98d028dbc8dd5',
            'startDate'=> $startDate*1000, //китайцы добавляют милисекунды
            'endDate'=> $endDate*1000,//китайцы добавляют милисекунды
            'keyboardPwdVersion'=>$keyboardPwdVersion,
            'lockId'=>$lockId,
            'keyboardPwdType'=>$keyboardPwdType
            ])
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
            'start_date'=>'start_day',
            'end_date'=>'end_day',
            'booking_id' => 'booking_id',
            'door_lock_id'=>'door_lock_id',
            'value'=>'value',
            'keyboard_pwd_type'=>'keyboard_pwd_type',
            'keyboard_pwd_version'=>'keyboard_pwd_version',
            'keyboard_pwd_id'=>'keyboard_pwd_id'

        ];
    }
}
