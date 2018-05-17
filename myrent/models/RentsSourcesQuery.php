<?php

namespace myrent\models;

/**
 * This is the ActiveQuery class for [[RentsSources]].
 *
 * @see RentsSources
 */
class RentsSourcesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RentsSources[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RentsSources|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
