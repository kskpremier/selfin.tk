<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/8/17
 * Time: 2:14 PM
 */
namespace backend\models\query;

use reception\entities\Booking\Booking;
use yii\db\ActiveQuery;

class BookingQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Booking::STATUS_ACTIVE]);
    }
    public function fromToday()
    {
        return $this->andWhere(['>=', 'end_date', date("Y-m-d",time())." 00:00:01"]);
    }
    /**
     * @param null $db
     * @return array|User[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    /**
     * @param null $db
     * @return array|null|User
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
