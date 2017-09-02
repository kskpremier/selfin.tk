<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 15.07.17
 * Time: 7:43
 */

namespace reception\forms;

use reception\entities\DoorLock\DoorLock;
use backend\models\Guest;
use reception\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class KeyForBookingForm extends Model
{
    public $startDate;
    public $endDate;
    public $remarks;
    public $userId;
    public $doorLockId;
    public $bookingId;
    public $type;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['startDate', 'endDate'],'string', 'max' => 255],
            [['remarks'],'safe'],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
            [['bookingId'],'required'],
            [['bookingId'],'safe'],
            [['type'],'integer'],
        ];
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

}