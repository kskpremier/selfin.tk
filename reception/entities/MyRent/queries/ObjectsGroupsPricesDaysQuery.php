<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\ObjectsGroupsPricesDays]].
 *
 * @see \reception\entities\MyRent\ObjectsGroupsPricesDays
 */
class ObjectsGroupsPricesDaysQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsGroupsPricesDays[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsGroupsPricesDays|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
