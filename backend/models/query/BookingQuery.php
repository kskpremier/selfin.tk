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

    public function inInterval($start,$until)
    {

        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'booking.from_date', $start], ['>',  'booking.until_date', $until] ],
            ['and', ['>=', 'booking.from_date', $start], ['<=', 'booking.until_date', $until] ],
            ['and', ['<',  'booking.from_date', $start], ['<',  'booking.until_date', $until],['>=', 'booking.from_date',  $start] ],
            ['and', ['<',  'booking.from_date', $start], ['>',  'booking.until_date', $until],['<=', 'booking.until_date', $until] ]
        ])
            ->andFilterWhere(['booking.active'=>'Y']);
    }

    public function fromNow()
    {
        $date = date("Y-m-d H:i:s", time());
        return $this->andFilterWhere(['>', 'booking.end_date', $date]);
    }

    public function active()
    {
        return $this->andWhere(['status' => \reception\entities\Booking\Booking::STATUS_ACTIVE]);
    }

    public function fromToday()
    {
        return $this->andWhere(['>=', 'booking.end_date', date("Y-m-d",time())." 00:00:01"]);
    }
}