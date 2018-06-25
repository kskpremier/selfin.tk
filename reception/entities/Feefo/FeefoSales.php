<?php


namespace reception\entities\Feefo;

use function json_decode;
use Yii;

/**
 * This is the model class for table "feefo_sales".
 *
 * @property int $id
 * @property int $rent_id
 * @property string $created
 * @property string $log
 * @property string $params
 */
class FeefoSales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feefo_sales';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @param int $id//
     * @param int $rent_id//
     * @param string $created//
     * @param string $log//
     * @return FeefoSales    */
    public static function create( $rent_id,  $created, $log, $params): FeefoSales
    {
        $feefoSales = new static();
        $feefoSales->rent_id = $rent_id;
        $feefoSales->created = $created;
        $feefoSales->log = $log;
        $feefoSales->params = json_encode($params);
        $feefoSales->object_id =$params['productsearchcode'];
        $feefoSales->date =$params['date'];
        $feefoSales->name =$params['name'];
        $feefoSales->email =$params['email'] ;
        $feefoSales->description =$params['description'];
        $feefoSales->tags =$params['tags'];
        $feefoSales->amount =$params['amount'];
        $feefoSales->currency =$params['currency'];
        $feefoSales->productattributes =$params['productattributes'];
        $feefoSales->feedbackdate =$params['feedbackdate'];
        $feefoSales->locale =$params['locale'];
        $feefoSales->productlink =$params['productlink'];
        $feefoSales->merchantidentifier =$params['merchantidentifier'];

        return $feefoSales;
    }

    /**
     * @param int $id//
     * @param int $rent_id//
     * @param string $created//
     * @param string $log//
     * @return FeefoSales    */
    public function edit( $rent_id, $created, $log, $params): FeefoSales
    {
        $this->rent_id = $rent_id;
        $this->created = $created;
        $this->log = $log;
        $this->params = json_encode($params);
        $this->object_id =$params['productsearchcode'];
        $this->date =$params['date'];
        $this->name =$params['name'];
        $this->email =$params['email'] ;
        $this->description =$params['description'];
        $this->tags =$params['tags'];
        $this->amount =$params['amount'];
        $this->currency =$params['currency'];
        $this->productattributes =$params['productattributes'];
        $this->feedbackdate =$params['feedbackdate'];
        $this->locale =$params['locale'];
        $this->productlink =$params['productlink'];
        $this->merchantidentifier =$params['merchantidentifier'];

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'created' => Yii::t('app', 'Created'),
            'params' => Yii::t('app', 'JSON'),
            'log' => Yii::t('app', 'Log'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\Feefo\queries\FeefoSalesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\Feefo\queries\FeefoSalesQuery(get_called_class());
    }
}
