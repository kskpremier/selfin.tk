<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\ObjectsRealestatesPictures]].
 *
 * @see \reception\entities\MyRent\ObjectsRealestatesPictures
 */
class ObjectsRealestatesPicturesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsRealestatesPictures[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\ObjectsRealestatesPictures|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
