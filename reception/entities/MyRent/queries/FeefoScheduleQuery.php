<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRent\FeefoSchedule]].
 *
 * @see \reception\entities\MyRent\FeefoSchedule
 */
class FeefoScheduleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \reception\entities\MyRent\FeefoSchedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \reception\entities\MyRent\FeefoSchedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
