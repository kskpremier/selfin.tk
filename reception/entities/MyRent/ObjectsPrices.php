<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "objects_prices".
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
 * @property string $price_inculde
 * @property string $note
 * @property string $created
 * @property string $changed
 */
class ObjectsPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices';
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
        * @param string $price_inculde//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPrices    */
    public static function create($id, $object_id, $item_id, $price, $price_currency_id, $vat, $price_extra, $extra_from, $min_stay, $week_discount, $month_discount, $price_inculde, $note, $created, $changed): ObjectsPrices
    {
        $objectsPrices = new static();
                $objectsPrices->id = $id;
                $objectsPrices->object_id = $object_id;
                $objectsPrices->item_id = $item_id;
                $objectsPrices->price = $price;
                $objectsPrices->price_currency_id = $price_currency_id;
                $objectsPrices->vat = $vat;
                $objectsPrices->price_extra = $price_extra;
                $objectsPrices->extra_from = $extra_from;
                $objectsPrices->min_stay = $min_stay;
                $objectsPrices->week_discount = $week_discount;
                $objectsPrices->month_discount = $month_discount;
                $objectsPrices->price_inculde = $price_inculde;
                $objectsPrices->note = $note;
                $objectsPrices->created = $created;
                $objectsPrices->changed = $changed;
        
        return $objectsPrices;
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
            * @param string $price_inculde//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPrices    */
    public function edit($id, $object_id, $item_id, $price, $price_currency_id, $vat, $price_extra, $extra_from, $min_stay, $week_discount, $month_discount, $price_inculde, $note, $created, $changed): ObjectsPrices
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
            $this->price_inculde = $price_inculde;
            $this->note = $note;
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
            'price_inculde' => Yii::t('app', 'Price Inculde'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsPricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesQuery(get_called_class());
    }
}
