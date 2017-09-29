<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 15.07.17
 * Time: 9:05
 */

namespace reception\forms;

use backend\models\Booking;
use reception\entities\DoorLock\DoorLock;

use reception\helpers\TTLHelper;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class KeyboardPwdForBookingForm extends FormWithDates
{
    public $startDate;
    public $endDate;
    public $startDateTimestamp;
    public $endDateTimestamp;
    public $doorLockId;
    public $bookingId;
    public $externalId;
    public $externalApartmentId;
    public $type;
    public $keyboardPwdVersion = 4; // по умолчанию равно 4


    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['startDate', 'endDate'],'string', 'max' => 255],
            [['startDateTimestamp','endDateTimestamp'],'integer'],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
            //[['bookingId'],'required'],
            [['externalId','externalApartmentId'],'safe'],
            [['bookingId'],'safe'],
            [['doorLockId', 'keyboardPwdVersion','type'],'integer'],
        ];
    }



}