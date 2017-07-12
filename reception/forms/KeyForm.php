<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:53
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
class KeyForm extends Model
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
            [['type','startDate', 'endDate'],'string', 'max' => 255],
            [['remarks'],'safe'],
            [['doorLockId'],'required'],
            [['doorLockId', 'bookingId','userId'],'integer'],
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
        return DoorLock::findOne(['id'=>$this->doorLockId])->lock_name;
    }

}