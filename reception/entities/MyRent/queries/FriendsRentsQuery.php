<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\FriendsRents]].
 *
 * @see \reception\entities\MyRent\FriendsRents
 */
class FriendsRentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\FriendsRents[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\FriendsRents|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
