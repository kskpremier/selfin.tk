<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ObjectTypes]].
 *
 * @see ObjectTypes
 */
class ObjectTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ObjectTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ObjectTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
