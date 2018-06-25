<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\ObjectsGroupsB2b]].
 *
 * @see \reception\entities\MyRent\ObjectsGroupsB2b
 */
class ObjectsGroupsB2bQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsGroupsB2b[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsGroupsB2b|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
