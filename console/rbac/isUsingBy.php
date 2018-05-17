<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 17.05.17
 * Time: 20:43
 */
namespace console\rbac;

use function in_array;
use reception\entities\DoorLock\DoorLock;
use yii\helpers\ArrayHelper;
use yii\rbac\Rule;
use backend\models\Booking;

/**
 * Проверяем есть ли у пользователя право на замок
 *
 */
class isUsingBy extends Rule
{
    public $name = 'isUsingBy';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess() : 'booking_id','start_date','end_date'
     *
     * Правило должно работать следующим образом : если даты периода букирования больше запрашиваемых дат на ключ, то генерация возможна
     *
     * надо иметь id букинга и даты ключа
     *
     *
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($userId, $item, $params)
    {
        if (empty($params['doorlock_id'])) {
            throw new InvalidCallException('Specify doorlock_id.');
        }

        if (isset($params['doorlock_id'] )){
            $doorlock = DoorLock::findOne($params['doorlock_id']);

            if ($doorlock && isset($params['user_id'])){
                //ищем либо в юзере, либо в оунере, либо в вокере
                return in_array($userId, ArrayHelper::getColumn($doorlock->apartments,'user_id')) ||

                 in_array($userId, ArrayHelper::getColumn($doorlock->apartments,'owner_id')) ||

                 in_array($userId, ArrayHelper::getColumn($doorlock->apartments,'worker_id'));
            }
        }
        return false;
    }


}