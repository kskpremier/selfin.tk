<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\InvoicesLog]].
 *
 * @see \reception\entities\MyRent\InvoicesLog
 */
class InvoicesLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\InvoicesLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\InvoicesLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
