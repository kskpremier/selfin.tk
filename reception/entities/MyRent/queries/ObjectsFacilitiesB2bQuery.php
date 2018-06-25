<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\ObjectsFacilitiesB2b]].
 *
 * @see \reception\entities\MyRent\ObjectsFacilitiesB2b
 */
class ObjectsFacilitiesB2bQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsFacilitiesB2b[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsFacilitiesB2b|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
