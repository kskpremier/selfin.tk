<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:53
 */

namespace reception\forms;

use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\DoorLock;
use reception\entities\Booking\Guest;
use reception\entities\User\User;
use reception\helpers\TTLHelper;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class KeyFormForNewUser extends Model
{
    public $startDate;
    public $endDate;
    public $remarks;
    public $userId;
    public $doorLockId;
    public $booking_internal_id;
    public $bookingId;
    public $type;
    public $externalApartmentId;
    public $apartment_id;

    public $username;
    public $email;
    // public $phone;
    public $password;
    public $role;

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
            [['startDate', 'endDate'],'string', 'max' => 255],
            [['type'],'validateTypes','message'=>'Type of password should be known. Unknown one is given.'],

            [['remarks'],'safe'],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
            [['doorLockId','type'],'required'],
            [['doorLockId', 'bookingId','userId','booking_internal_id'],'integer'],

            [['username', 'email', 'role'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],

            [['externalApartmentId','apartment_id'],'validateApartment','message'=>'wrong apartment or door lock ID'],
            [['doorLockId'],'validateDoorLock','message'=>'wrong door lock id'],

        ];
    }

    public function guestList($bookingId): array
    {
        return ArrayHelper::map(Guest::find()->joinWith('bookings')->joinWith('user')->where(['booking_id'=>$bookingId])->orderBy('contact_email')->asArray()->all(), 'user.id', 'user.username');
    }

    public function userList(): array
    {
        return ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email');
    }

    public function doorLockList($apartmentId): array
    {
        return ArrayHelper::map(DoorLock::find()->joinWith('apartment')->where(['apartment_id'=>$apartmentId])->orderBy('name')->asArray()->all(), 'id', 'name');
    }
    public function getDoorLockName()
    {
        return DoorLock::findOne(['id'=>$this->doorLockId])->lock_alias;
    }

    public function validateDates(){
        if ($this->type != "2"){
            if (strtotime($this->startDate) < (time()-60) ){
                $this->addError('Start Date must be bigger then current time');
            }
            if (strtotime($this->endDate) < strtotime($this->startDate) ){
                $this->addError( 'End Date must be bigger then Start Date');
            }
        }
    }
    /* Checkin if type is correct*/
    public function validateTypes(){
        if (TTLHelper::getKeyTypeName($this->type) === "")
            $this->addError('Unknown type of key');
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


    /* Checkin if booking ID is correct*/
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

}