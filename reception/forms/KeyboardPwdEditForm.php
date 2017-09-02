<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:49
 */
namespace reception\forms;

use reception\entities\DoorLock\DoorLock;
use yii\helpers\ArrayHelper;
use reception\forms\FormWithDates;


/**
 * @property LockVersionForm $lockVersion
 */
class KeyboardPwdEditForm extends FormWithDates
{

    public $doorLockId;
    public $bookingId;
    public $type;
    public $value;
    public $keyboardPwdId;

    public function __construct($keyboardPwd,array $config = [])
    {   parent::__construct($config);

        $this->bookingId = $keyboardPwd->booking_id;
        $this->type = $keyboardPwd->type;
        $this->startDate=(!$keyboardPwd->start_date)?'':date('Y-m-d H:i:s',$keyboardPwd->start_date);
        $this->endDate=(!$keyboardPwd->end_date)?'':date('Y-m-d H:i:s',$keyboardPwd->end_date);
    }

    public function rules(): array
    {
        return [
            [['type','startDate', 'endDate','value','keyboardPwdId'],'string', 'max' => 255],
            [['startDateTimestamp','endDateTimestamp'],'integer'],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
            [['doorLockId','type','keyboardPwdVersion'],'required'],
            [['doorLockId', 'bookingId'],'integer'],
        ];
    }

    public function doorLockList($apartmentId): array
    {
        return ArrayHelper::map(DoorLock::find()->joinWith('apartment')->where(['apartment_id'=>$apartmentId])->orderBy('name')->asArray()->all(), 'id', 'name');
    }
    public function getDoorLockName()
    {
        return DoorLock::findOne(['id'=>$this->doorLockId])->lock_name;
    }

}