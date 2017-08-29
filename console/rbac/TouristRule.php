<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 17.05.17
 * Time: 20:43
 */
namespace console\rbac;

use yii\rbac\Rule;
use backend\models\Booking;

/**
 * Проверяем authorID на соответствие с пользователем, переданным через параметры
 *
 */
class TouristRule extends Rule
{
    public $name = 'isLiving';

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
        if (empty($params['booking_id'])) {
            throw new InvalidCallException('Specify booking.');
        }

        if (isset($params['booking_id'] )){
            $booking = Booking::findOne($params['booking_id']);

            if ($booking && isset($params['start_date'])&& isset($params['end_date'])){
                return (strtotime($booking->start_date.'10:00') <= strtotime($params['start_date']) ) &&
                    (strtotime($booking->end_date.'14:00') >= strtotime($params['end_date']) );
            }
        }
        return false;
    }


}