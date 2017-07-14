<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 18:10
 */

namespace reception\forms;

use reception\entities\DoorLock\Key;
use reception\entities\DoorLock\DoorLock;
use backend\models\Guest;
use reception\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class KeyEditForm extends Model
{
    public $startDate;
    public $endDate;
    public $remarks;
    public $userId;
    public $doorLockId;
    public $bookingId;
    public $type;
    public $lastUpdateDate;
    public $keyStatus;
    public $keyId;

    public function __construct(Key $key, array $config = [])
    {

        $this->startDate=(!$key->start_date)?'':date('Y-m-d H:i:s',$key->start_date);
        $this->endDate=(!$key->end_date)?'':date('Y-m-d H:i:s',$key->end_date);
        $this->remarks=$key->remarks;
        $this->userId=$key->user_id;
        $this->doorLockId=$key->door_lock_id;
        $this->bookingId=$key->booking_id;
        $this->type=$key->type;
        $this->lastUpdateDate=$key->last_update_date;
        $this->keyStatus=$key->key_status;
        $this->keyId=$key->key_id;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['type','startDate', 'endDate','keyStatus'],'string', 'max' => 255],
            [['remarks','lastUpdateDate'],'safe'],
            [['doorLockId'],'required'],
            [['doorLockId', 'bookingId','userId','keyId'],'integer'],
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
        return ($this->doorLockId)?DoorLock::findOne(['id'=>$this->doorLockId])->lock_name: "unknown";
    }
}