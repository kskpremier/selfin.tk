<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\Filters]].
 *
 * @see \backend\models\Filters
 */
class FiltersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\Filters[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\Filters|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}