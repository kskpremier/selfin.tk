<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\GuestsEvisitor]].
 *
 * @see \reception\entities\MyRent\GuestsEvisitor
 */
class GuestsEvisitorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\GuestsEvisitor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\GuestsEvisitor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
