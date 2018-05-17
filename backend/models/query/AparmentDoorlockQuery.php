<?php

namespace backend\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ApartmentDoorlock]].
 *
 * @see ApartmentDoorlock
 */
class AparmentDoorlockQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ApartmentDoorlock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ApartmentDoorlock|array|null
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

        return ($id)? $this->joinWith('apartments')->joinWith('apartments.user')->andWhere(['users.id'=>$id]): $this->andWhere('1=1');
    }


}
