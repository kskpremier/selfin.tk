<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:40
 */
namespace reception\forms;

use backend\models\Booking;
use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\DoorLock;

use reception\helpers\TTLHelper;
use yii\helpers\ArrayHelper;

use reception\forms\FormWithDates;

/**
 * @property integer $doorLockId
 * @property string $externalApartmentId
 * @property string $type
 * @property integer $keyboardPwdVersion
 *
 * @property Aparment $apartment
 */
class KeyboardPasswordForm extends FormWithDates
{
    public $doorLockId;
    public $bookingId;
    public $externalApartmentId;
    public $type;
    public $keyboardPwdVersion = 4; // по умолчанию равно 4

    public $apartment;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['type','startDate', 'endDate'],'string', 'max' => 255],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
            [['type'],'validateTypes','message'=>'Type of password should be known. Unknown one is given.'],
            [['externalApartmentId'],'validateApartment','message'=>'wrong apartment or door lock ID'],
            [['doorLockId'],'validateDoorLock','message'=>'wrong door lock id'],
            [['doorLockId','keyboardPwdVersion','bookingId'],'integer'],
        ];
    }

//    public function doorLockList($externalApartmentId): array
//    {
//        return ArrayHelper::map(DoorLock::find()->joinWith('apartment')->where(['apartment_id'=>$externalApartmentId])->orderBy('name')->asArray()->all(), 'id', 'name');
//    }
//    public function bookingList($doorLockId): array
//    {
//        $apartment = Apartment::find()->joinWith('doorLocks')->where(['door-lock.id'=>$doorLockId])->one();
//        return ArrayHelper::map(Booking::find()->joinWith('apartment')->where(['apartment.external_id'=>$apartment->id])->orderBy('id')->asArray()->all(), 'id', 'id');
//    }
//    public function getDoorLockName()
//    {
//        return DoorLock::findOne(['id'=>$this->doorLockId])->lock_name;
//    }

//    public function getAllBookings(){
//        return Booking::find()->where(['>=', 'start_date',  time()])->all();
//    }
    public function getKeyboardTypeList()
    {
        return TTLHelper::getKeyboardPwdTypeNameList();
    }

    /* Checkin if type is correct*/
    public function validateTypes(){
        if (TTLHelper::getKeyboardPwdTypeName($this->type) === "")
            $this->addError('Unknown type of keyboard password');
    }

    /* Checkin if apartment id is correct*/
    public function validateApartment(){
        $apartment = Apartment ::find()->where(['external_id'=>$this->externalApartmentId])->one();
        if ($this->doorLockId===null && !isset($apartment->doorLocks))
            $this->addError("Can not find Apartment with this ID or this apartment does't have any door locks ->" . $this->externalApartmentId);
        else $this->apartment = $apartment;
    }
    /* Checkin if door lock ID is correct*/
    public function validateDoorLock(){
        $doorlock = DoorLock::find()->where(['id'=>$this->doorLockId])->one();
        if (!isset($doorlock))
            $this->addError('Can not find door lock with this ID ->'. $this->doorLockId);
    }
    /* Checkin if door lock ID is correct*/
//    public function validateBooking(){
//        if (!isset($this->bookingId)){
//            $this->addError('Booking ID should be set');
//        }
//        $booking = Booking::find()->where(['external_id'=>$this->bookingId])->one();
//        if (!isset($booking)){
//            $this->addError('Wrong ID of Booking');
//        }
//    }

}