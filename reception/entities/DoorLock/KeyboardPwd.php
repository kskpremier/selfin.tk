<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 12:28
 */

namespace reception\entities\DoorLock;

use reception\entities\User\User;
use reception\helpers\TTLHelper;
use Yii;
use reception\entities\Booking\Booking;
//use yii\httpclient\Client;
use yii\db\ActiveRecord;
use api\models\test\BodyPost;
use api\models\test\oFile;
use reception\useCases\manage\TTL\TTL;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "keyboard_pwd".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property string $value
 * @property string $keyboard_pwd_type
 * @property integer $keyboard_pwd_version
 * @property integer $door_lock_id
 * @property integer $booking_id
 * @property string $keyboard_pwd_id
 *
 * @property Booking $booking
 * @property DoorLock $doorLock
 */
class KeyboardPwd extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyboard_pwd';
    }

    public static function create( $startDate, $endDate, $type, $keyboardPwdVersion,
                                   $doorLockId, $bookingId =null) :self
    {
        $keyboardPwd = new static();
        $keyboardPwd->start_date = $startDate;
        $keyboardPwd->end_date = $endDate;
        $keyboardPwd->keyboard_pwd_type = $type;
        $keyboardPwd->keyboard_pwd_version = $keyboardPwdVersion;
        $keyboardPwd->booking_id = $bookingId;
        $keyboardPwd->door_lock_id = $doorLockId;

        return $keyboardPwd;
    }

    public function edit( $start_date, $end_date, $type, $booking_id,
                          $door_lock_id, $user_id,$remarks, $last_update_date,$key_status,$key_id
    )
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->type = $type;
        $this->booking_id = $booking_id;
        $this->door_lock_id = $door_lock_id;
        $this->user_id = $user_id;
        $this->last_update_date = $last_update_date;
        $this->remarks = $remarks;
        $this->key_status = $key_status;
        $this->key_id = $key_id;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyboard_pwd_version', 'booking_id','value','door_lock_id','keyboard_pwd_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['keyboard_pwd_type'], 'integer'],
            [['value'], 'string', 'max' => 20],
            [['door_lock_id','keyboard_pwd_type','keyboard_pwd_version'], 'required'],
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

    /**
     * Этот вызов будет дергать китайский api контроллер
     * При успешном получении ответа запишет данные в модель и сохранит ее, вернет json
     * @return string json like {"keyboardPwdId":501168,"keyboardPwd":"45866000","success":"true"}
     * */

    public function getKeyboardPwdFromChina(){
        $dateTimeZone = new \DateTimeZone(date_default_timezone_get ());
        $date = new \DateTime(null, new \DateTimeZone(date_default_timezone_get ()));
        $offset = $dateTimeZone->getOffset($date);


        $token = TTL::getToken((User::find()->where(['username'=>TTL::TTL_DOOR_LOCK_ADMIN_USERNAME])->one())->id);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt_array($ch, array(
            CURLOPT_URL => TTL::TTL_URL_TO_KEYBOARD_PWD_GET,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'clientId' =>  TTL::TTL_CLIENT_ID,
                'date'=> 1000*time(),
                'accessToken'=>$token->access_token,
                'startDate'=> (gettype($this->start_date)==='integer')?($this->start_date+$this->getSummerWinterDoorLockInit()+$offset)*1000
                    :(strtotime($this->start_date)+$this->getSummerWinterDoorLockInit()+$offset)*1000, //китайцы добавляют милисекунды
                'endDate'=> ($this->keyboard_pwd_type == 2)?  0 : (gettype($this->end_date)==='integer')? ($this->end_date+$this->getSummerWinterDoorLockInit()+$offset)*1000:
                    (strtotime($this->end_date)+$this->getSummerWinterDoorLockInit()+$offset)*1000,//китайцы добавляют милисекунды
                'keyboardPwdVersion'=>$this->keyboard_pwd_version,
                'lockId'=>$this->doorLock->lock_id,
                'keyboardPwdType'=>$this->keyboard_pwd_type
            ])
        ));
        $response = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);


        $data = json_decode($response,true);
        //в китайском ответе должно быть поле keyboardPwd
        if (is_array($data)){
            if (array_key_exists('keyboardPwd', $data)) {
                $this->value = $data['keyboardPwd'];
                $this->keyboard_pwd_id = $data['keyboardPwdId'];
                $this->start_date = $this->start_date;
                $this->end_date = ($this->keyboard_pwd_type == 2)? 0: $this->end_date;
                $this->validate();
                $data['success'] =  $this->save(false);
            }
            else if (array_key_exists('errcode', $data) ) {
                if ($data['errcode']!=0) $data['success'] = false;
            }
            return json_encode($data);
        }
        else throw new ServerErrorHttpException('Problems with request '. $response);
    }

    /**
     Исправляем китайский косяк - определяем сколько секунд надо добавить к дате начала или окончания действия замка,
     * в зависимости от того в какое время был инициализирован замок и генерируется ключ
     * Пока по умолчанию считаем, что время берется в европейской тайм зоне с переходом на летнее/зимнее
     */
    public function getSummerWinterDoorLockInit()
    {
        $doorLockInitTime = $this->doorLock->date/1000;
        $doorLockTimeZone = 'Europe/Zurich'; /** TODO разобраться с временной зоной замка */ //$this->doorLock->timeZone;
        $currentTime = time();
        if (date('I', $doorLockInitTime) && date('I', $currentTime)) {
            //оба времени летние или зимние
            return 0;
        } elseif (date('I', $doorLockInitTime)) //замок летом, ключ зимой => надо вычитать час ??
            {
            return -1*$this->getWinterSummerTimeDifference($doorLockTimeZone,$currentTime);
             }
        return 1*$this->getWinterSummerTimeDifference($doorLockTimeZone,$currentTime);
    }
    /** Возвращает разницу в летнем и зимнем времени в зависимости от TimeZone и времени
     */
    private function getWinterSummerTimeDifference($timezone, $time){
        return 3600;
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
            'keyboard_pwd_version'=>'keyboard_pwd_version',
            'keyboard_pwd_id'=>'keyboard_pwd_id'

        ];
    }
    /**
     * For REST/API controller
     * @return array
     */
    public function serializeKeyboardPwd()
    {
        return
        [
            'keyboardPwd_id' => $this->id,
            'door_lock_id' => $this->door_lock_id,
            'door_lock_name' => $this->doorLock->lock_alias,
            'value' => $this->value,
            'start_date' => date('Y-m-d H:i:s', $this->start_date),
            'end_date' => ($this->keyboard_pwd_type == 2)? 0: date('Y-m-d H:i:s', $this->end_date),
            'keyboardPwd_type' => TTLHelper::getKeyboardPwdTypeName($this->keyboard_pwd_type)
        ];
        }
}
