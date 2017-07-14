<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:49
 */
namespace reception\forms;

use reception\entities\DoorLock\DoorLock;
use backend\models\Booking;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\web\ServerErrorHttpException;

/**
 * @property LockVersionForm $lockVersion
 */
class KeyboardPwdEditForm extends Model
{
    public $startDate;
    public $endDate;
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
            [['startDate','endDate'],'validateDates'],
            [['doorLockId'],'required'],
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