<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\ObjectsPricesDays]].
 *
 * @see \backend\models\ObjectsPricesDays
 */
class ObjectsPricesDaysQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\ObjectsPricesDays[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\ObjectsPricesDays|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function forPeriod($from, $until) {
        return $this->andFilterWhere(['and',['>=','day',$from],['<=','day',$until]]);
    }

    public function forObjects($objectIds) {
        return $this->andFilterWhere(['object_id'=>$objectIds]);
    }
}