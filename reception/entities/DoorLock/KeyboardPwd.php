<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 12:28
 */

namespace reception\entities\DoorLock;


use reception\helpers\TTLHelper;
use Yii;
use reception\entities\Booking\Booking;
use yii\db\ActiveRecord;

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
                                   $doorLockId, $bookingId =null, $value = null) :self
    {
        $keyboardPwd =($type==TTLHelper::TTL_KEYBOARD_CUSTOMIZED)? self::find()->where(["start_date"=>$startDate, "end_date"=>$endDate, "keyboard_pwd_type" =>$type, "door_lock_id"=>$doorLockId, 'value'=>$value ])->one():
                                                                   self::find()->where(["start_date"=>$startDate, "end_date"=>$endDate, "keyboard_pwd_type" =>$type, "door_lock_id"=>$doorLockId ])->one();
    if (!isset($keyboardPwd)) {
        $keyboardPwd = new static();
        $keyboardPwd->start_date = $startDate;
        $keyboardPwd->end_date = $endDate;
        $keyboardPwd->keyboard_pwd_type = $type;
        $keyboardPwd->keyboard_pwd_version = $keyboardPwdVersion;
        $keyboardPwd->booking_id = $bookingId;
        $keyboardPwd->door_lock_id = $doorLockId;
        $keyboardPwd->booking_id = $bookingId;
        $keyboardPwd->value = $value;
    }
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

    public static function find()
    {
        return new \backend\models\query\KeyboardPwdQuery(get_called_class());
    }

}
