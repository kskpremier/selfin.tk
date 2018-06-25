<?php

namespace reception\entities\Feefo\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\FeefoProducts]].
 *
 * @see \reception\entities\MyRent\FeefoProducts
 */
class FeefoProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\FeefoProducts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\FeefoProducts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}