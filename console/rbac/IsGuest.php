<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 22.06.17
 * Time: 9:46
 */
namespace console\rbac;

use yii\rbac\Rule;
use backend\models\Booking;

/**
 * Проверяем authorID на соответствие с пользователем, переданным через параметры
 *
 */
class IsGuest extends Rule
{
    public $name = 'isGuest';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess() : 'booking_id','start_date','end_date'
     *
     * Правило для проверки является ли пользователь гостем этого букинга
     *
     *
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($userId, $item, $params)
    {
        if (empty($params['user'])) {
            throw new InvalidCallException('Specify post.');
        }


        if (isset($params['user'] )){
            $guest = Guest::find()->andWhere(['user_id'=>$params['user']->id]);

            if ($guest){
                foreach ($guest->bookings as $booking) {
                       //проверить является ли пользователь гостем
                }
            }
        }
        return false;
    }


}