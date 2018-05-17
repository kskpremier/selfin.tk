<?php

namespace myrent\models;

/**
 * This is the ActiveQuery class for [[MyRentUsers]].
 *
 * @see MyRentUsers
 */
class MyRentUsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MyRentUsers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MyRentUsers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
