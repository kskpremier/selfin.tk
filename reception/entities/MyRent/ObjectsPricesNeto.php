<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\PriceCurrency;
use reception\entities\MyRent\Object;

/**
 * This is the model class for table "objects_prices_neto".
 *
 * @property int $id
 * @property int $object_id
 * @property int $item_id
 * @property double $price
 * @property int $price_currency_id
 * @property int $vat
 * @property double $price_extra
 * @property int $extra_from
 * @property int $min_stay
 * @property int $week_discount percent %
 * @property int $month_discount percent %
 * @property string $created
 * @property string $changed
 *
 * @property Currency $priceCurrency
 * @property Objects $object
 */
class ObjectsPricesNeto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_neto';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $object_id//
        * @param int $item_id//
        * @param double $price//
        * @param int $price_currency_id//
        * @param int $vat//
        * @param double $price_extra//
        * @param int $extra_from//
        * @param int $min_stay//
        * @param int $week_discount// percent %
        * @param int $month_discount// percent %
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesNeto    */
    public static function create($id, $object_id, $item_id, $price, $price_currency_id, $vat, $price_extra, $extra_from, $min_stay, $week_discount, $month_discount, $created, $changed): ObjectsPricesNeto
    {
        $objectsPricesNeto = new static();
                $objectsPricesNeto->id = $id;
                $objectsPricesNeto->object_id = $object_id;
                $objectsPricesNeto->item_id = $item_id;
                $objectsPricesNeto->price = $price;
                $objectsPricesNeto->price_currency_id = $price_currency_id;
                $objectsPricesNeto->vat = $vat;
                $objectsPricesNeto->price_extra = $price_extra;
                $objectsPricesNeto->extra_from = $extra_from;
                $objectsPricesNeto->min_stay = $min_stay;
                $objectsPricesNeto->week_discount = $week_discount;
                $objectsPricesNeto->month_discount = $month_discount;
                $objectsPricesNeto->created = $created;
                $objectsPricesNeto->changed = $changed;
        
        return $objectsPricesNeto;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $item_id//
            * @param double $price//
            * @param int $price_currency_id//
            * @param int $vat//
            * @param double $price_extra//
            * @param int $extra_from//
            * @param int $min_stay//
            * @param int $week_discount// percent %
            * @param int $month_discount// percent %
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesNeto    */
    public function edit($id, $object_id, $item_id, $price, $price_currency_id, $vat, $price_extra, $extra_from, $min_stay, $week_discount, $month_discount, $created, $changed): ObjectsPricesNeto
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->price = $price;
            $this->price_currency_id = $price_currency_id;
            $this->vat = $vat;
            $this->price_extra = $price_extra;
            $this->extra_from = $extra_from;
            $this->min_stay = $min_stay;
            $this->week_discount = $week_discount;
            $this->month_discount = $month_discount;
            $this->created = $created;
            $this->changed = $changed;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'price' => Yii::t('app', 'Price'),
            'price_currency_id' => Yii::t('app', 'Price Currency ID'),
            'vat' => Yii::t('app', 'Vat'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'min_stay' => Yii::t('app', 'Min Stay'),
            'week_discount' => Yii::t('app', 'Week Discount'),
            'month_discount' => Yii::t('app', 'Month Discount'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'price_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsPricesNetoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesNetoQuery(get_called_class());
    }
}
