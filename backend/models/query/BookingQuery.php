<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 01.06.17
 * Time: 0:09
 */


namespace backend\models\query;

use backend\models\Booking;
use yii\db\ActiveQuery;

class BookingQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Booking::STATUS_ACTIVE]);
    }
    public function fromToday()
    {
        return $this->andWhere(['>=', 'booking.end_date', date("Y-m-d",time())." 00:00:01"]);
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