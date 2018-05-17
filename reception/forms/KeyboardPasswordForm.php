<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:40
 */
namespace reception\forms;

use backend\models\Booking;
use function is_integer;
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
 * @property integer  $apartment_id
 * @property integer $booking_internal_id
 * @property integer $bookingId //for MyRentId
 *
 * @property Aparment $apartment
 */
class KeyboardPasswordForm extends FormWithDates
{
    public $doorLockId;
    public $bookingId;
    public $booking_internal_id;
    public $externalApartmentId;
    public $apartment_id;
    public $type;
    public $addType;
    public $keyboardPwdVersion = 4; // по умолчанию равно 4
//
    public $value;

    //поля для записи обнаруженных букингов или апартаментов
    public $apartment;
    public $bookingModel;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [

            [['bookingId','booking_internal_id'],'validateBooking','message'=>'wrong door booking id'],
            [['value'],'validateValue','message'=>'For this type of passcode Value must not be empty'],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
            [['startDate', 'endDate'],'string', 'max' => 255],
            [['type'],'validateTypes','message'=>'Type of password should be known. Unknown one is given.'],
            [['externalApartmentId','apartment_id'],'validateApartment','message'=>'wrong apartment or door lock ID'],
            [['doorLockId'],'validateDoorLock','message'=>'wrong door lock id'],
            [['doorLockId','keyboardPwdVersion','bookingId', 'type'],'integer'],
            [['bookingId','booking_internal_id'],'integer'],
            [['addType'],'safe'],

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
    public function getDoorLockName()
    {
        if ($this->doorLockId)
            return DoorLock::findOne(['id'=>$this->doorLockId])->lock_alias;
        else return '';
    }

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
        if (!($this->value && $this->doorLockId) && $this->type == TTLHelper::TTL_KEYBOARD_CUSTOMIZED)
            $this->addError('Not all fields are setted for this type of keyboard');
    }

    public function validateValue(){
        if ($this->type == 15 && !is_numeric($this->value)) {
            return $this->addError('Unknown type or value of keyboard password');
        }
    }

    /* Checkin if apartment id is correct*/
    public function validateApartment(){
        if ($this->externalApartmentId) {
            $apartment = Apartment::find()->where(['external_id' => $this->externalApartmentId])->one();
        }
        elseif ($this->apartment_id){
            $apartment = Apartment::find()->where(['id' => $this->apartment_id])->one();
        }
        if (!isset($apartment) && $this->doorLockId===null && !isset($apartment->doorLocks))
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
    public function validateBooking(){
        $booking = null;
        if ($this->bookingId) {
            $booking = \reception\entities\Booking\Booking::find()->where(['external_id' => $this->bookingId])->one();
            if (!isset($booking))
                $this->addError('Can not find booking with external ID ->'.$this->bookingId )   ;
        }
        if ($this->booking_internal_id) {
            $booking = \reception\entities\Booking\Booking::find()->where(['id' => $this->booking_internal_id])->one();
            if (!isset($booking))
                $this->addError('Can not find booking with ID ->'.$this->booking_internal_id )   ;
        }
        if ($booking) {
            $currentDateTime = date("Y-m-d H:i:s", time());
            $bookingStartDateTime = $booking->getStartDateTimeString();
            $bookingEndSDateTime = $booking->getEndDateTimeString();
            $this->startDate = ($bookingStartDateTime >= $currentDateTime) ? ( $bookingStartDateTime ): $currentDateTime ;
            $this->endDate = ($bookingEndSDateTime);
            $this->type = TTLHelper::TTL_KEYBOARD_PERIOD_TYPE;
            $this->bookingModel = $booking;
        }

    }

    public function validateDates(){

//            if (strtotime($this->startDate) < (time()-60) ){
//                $this->addError('Start Date must be bigger then current time');
//            }
//            if (strtotime($this->endDate) < (time()) ){
//                $this->addError('Start Date must be bigger then current time');
//            }
            if ((strtotime($this->endDate) < strtotime($this->startDate)) && $this->type == "3" ){
                $this->addError( 'End Date must be bigger then Start Date');
            }

    }

}