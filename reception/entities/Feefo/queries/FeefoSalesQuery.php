<?php

namespace reception\entities\Feefo\queries;
use reception\entities\Feefo\FeefoProducts;
use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\FeefoSales]].
 *
 * @see \reception\entities\MyRent\FeefoSales
 */
class FeefoSalesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[active]]="Y"');
    }*/

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\FeefoSales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\FeefoSales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function forProperty($id) {
        return $this->andFilterWhere(['property'=>$id]);
    }
//
    public function forPropertyName($name) {
        $productsID = ArrayHelper::getColumn(FeefoProducts::find()->where(['like','title',$name])->all(),'object_id');
        return $this->andFilterWhere(['object_id'=>$productsID]);
    }
}
