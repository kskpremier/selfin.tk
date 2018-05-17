<?php

namespace myrent\models;

/**
 * This is the ActiveQuery class for [[RentsStatus]].
 *
 * @see RentsStatus
 */
class RentsStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RentsStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RentsStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
