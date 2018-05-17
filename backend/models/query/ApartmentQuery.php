<?php

namespace backend\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ApartmentDoorlock]].
 *
 * @see ApartmentDoorlock
 */
class ApartmentQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Apartment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Apartment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return ActiveQuery
     */
    public function forUser($id)
    {
        return ($id)? $this->joinWith('user')->andWhere(['user_id'=>$id]): $this->andWhere('1=1');
    }


}