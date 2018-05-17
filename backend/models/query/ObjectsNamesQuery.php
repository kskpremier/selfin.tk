<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\ObjectsNames]].
 *
 * @see \backend\models\ObjectsNames
 */
class ObjectsNamesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\ObjectsNames[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\ObjectsNames|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
