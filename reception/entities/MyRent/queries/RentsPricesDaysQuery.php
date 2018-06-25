<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\RentsPricesDays]].
 *
 * @see \reception\entities\MyRent\RentsPricesDays
 */
class RentsPricesDaysQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\RentsPricesDays[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\RentsPricesDays|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
