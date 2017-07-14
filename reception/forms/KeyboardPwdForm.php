<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:40
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
class KeyboardPwdForm extends Model
{
    public $startDate;
    public $endDate;
    public $doorLockId;
    public $bookingId;
    public $type;
    public $keyboardPwdVersion = 4; // по умолчанию равно 4


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
            [['doorLockId','keyboardPwdVersion','type'],'required'],
            [['doorLockId', 'bookingId','keyboardPwdVersion'],'integer'],
        ];
    }

    public function doorLockList($apartmentId): array
    {
        return ArrayHelper::map(DoorLock::find()->joinWith('apartment')->where(['apartment_id'=>$apartmentId])->orderBy('name')->asArray()->all(), 'id', 'name');
    }
    public function bookingList($doorLockId): array
    {
        $apartment = Apartment::find()->joinWith('doorLocks')->where(['door-lock.id'=>$doorLockId])->one();
        return ArrayHelper::map(Booking::find()->joinWith('apartment')->where(['apartment_id'=>$apartment->id])->orderBy('id')->asArray()->all(), 'id', 'id');
    }
    public function getDoorLockName()
    {
        return DoorLock::findOne(['id'=>$this->doorLockId])->lock_name;
    }

    public function getAllBookings(){
        return Booking::find()->where(['>=', 'start_date',  time()])->all();
    }
    public function getKeyboardTypeList()
    {
        return TTLHelper::getKeyboardPwdTypeNameList();
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