<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\CustomersPrices]].
 *
 * @see \reception\entities\MyRent\CustomersPrices
 */
class CustomersPricesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\CustomersPrices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\CustomersPrices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
