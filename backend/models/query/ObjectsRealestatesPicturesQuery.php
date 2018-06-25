<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\ObjectsRealestatesPictures]].
 *
 * @see \backend\models\ObjectsRealestatesPictures
 */
class ObjectsRealestatesPicturesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\ObjectsRealestatesPictures[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\ObjectsRealestatesPictures|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
