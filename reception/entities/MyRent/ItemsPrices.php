<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\InvoiceItem;
use reception\entities\MyRent\Period;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "items_prices".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $unit_id
 * @property int $period_id
 * @property int $invoice_item_id
 * @property string $invoice_item_name
 * @property string $note
 * @property string $calculation F-Fix, Q-quantity
 * @property double $quantity
 * @property string $quantity_type P - percent%, F - Fix
 * @property double $quantity_price
 * @property string $date_from
 * @property string $date_until
 * @property string $color
 * @property double $price default price
 * @property int $price_currency_id
 * @property double $extra_price price for extra guest
 * @property int $extra_from extra from guests
 * @property int $vat vat in %
 * @property string $created
 * @property string $changed
 *
 * @property Units $unit
 * @property Items $invoiceItem
 * @property ItemsPeriod $period
 * @property Objects $object
 * @property Users $user
 */
class ItemsPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_prices';
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
        * @param int $user_id//
        * @param int $object_id//
        * @param int $unit_id//
        * @param int $period_id//
        * @param int $invoice_item_id//
        * @param string $invoice_item_name//
        * @param string $note//
        * @param string $calculation// F-Fix, Q-quantity
        * @param double $quantity//
        * @param string $quantity_type// P - percent%, F - Fix
        * @param double $quantity_price//
        * @param string $date_from//
        * @param string $date_until//
        * @param string $color//
        * @param double $price// default price
        * @param int $price_currency_id//
        * @param double $extra_price// price for extra guest
        * @param int $extra_from// extra from guests
        * @param int $vat// vat in %
        * @param string $created//
        * @param string $changed//
        * @return ItemsPrices    */
    public static function create($id, $user_id, $object_id, $unit_id, $period_id, $invoice_item_id, $invoice_item_name, $note, $calculation, $quantity, $quantity_type, $quantity_price, $date_from, $date_until, $color, $price, $price_currency_id, $extra_price, $extra_from, $vat, $created, $changed): ItemsPrices
    {
        $itemsPrices = new static();
                $itemsPrices->id = $id;
                $itemsPrices->user_id = $user_id;
                $itemsPrices->object_id = $object_id;
                $itemsPrices->unit_id = $unit_id;
                $itemsPrices->period_id = $period_id;
                $itemsPrices->invoice_item_id = $invoice_item_id;
                $itemsPrices->invoice_item_name = $invoice_item_name;
                $itemsPrices->note = $note;
                $itemsPrices->calculation = $calculation;
                $itemsPrices->quantity = $quantity;
                $itemsPrices->quantity_type = $quantity_type;
                $itemsPrices->quantity_price = $quantity_price;
                $itemsPrices->date_from = $date_from;
                $itemsPrices->date_until = $date_until;
                $itemsPrices->color = $color;
                $itemsPrices->price = $price;
                $itemsPrices->price_currency_id = $price_currency_id;
                $itemsPrices->extra_price = $extra_price;
                $itemsPrices->extra_from = $extra_from;
                $itemsPrices->vat = $vat;
                $itemsPrices->created = $created;
                $itemsPrices->changed = $changed;
        
        return $itemsPrices;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $unit_id//
            * @param int $period_id//
            * @param int $invoice_item_id//
            * @param string $invoice_item_name//
            * @param string $note//
            * @param string $calculation// F-Fix, Q-quantity
            * @param double $quantity//
            * @param string $quantity_type// P - percent%, F - Fix
            * @param double $quantity_price//
            * @param string $date_from//
            * @param string $date_until//
            * @param string $color//
            * @param double $price// default price
            * @param int $price_currency_id//
            * @param double $extra_price// price for extra guest
            * @param int $extra_from// extra from guests
            * @param int $vat// vat in %
            * @param string $created//
            * @param string $changed//
        * @return ItemsPrices    */
    public function edit($id, $user_id, $object_id, $unit_id, $period_id, $invoice_item_id, $invoice_item_name, $note, $calculation, $quantity, $quantity_type, $quantity_price, $date_from, $date_until, $color, $price, $price_currency_id, $extra_price, $extra_from, $vat, $created, $changed): ItemsPrices
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->unit_id = $unit_id;
            $this->period_id = $period_id;
            $this->invoice_item_id = $invoice_item_id;
            $this->invoice_item_name = $invoice_item_name;
            $this->note = $note;
            $this->calculation = $calculation;
            $this->quantity = $quantity;
            $this->quantity_type = $quantity_type;
            $this->quantity_price = $quantity_price;
            $this->date_from = $date_from;
            $this->date_until = $date_until;
            $this->color = $color;
            $this->price = $price;
            $this->price_currency_id = $price_currency_id;
            $this->extra_price = $extra_price;
            $this->extra_from = $extra_from;
            $this->vat = $vat;
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
            'user_id' => Yii::t('app', 'User ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'period_id' => Yii::t('app', 'Period ID'),
            'invoice_item_id' => Yii::t('app', 'Invoice Item ID'),
            'invoice_item_name' => Yii::t('app', 'Invoice Item Name'),
            'note' => Yii::t('app', 'Note'),
            'calculation' => Yii::t('app', 'Calculation'),
            'quantity' => Yii::t('app', 'Quantity'),
            'quantity_type' => Yii::t('app', 'Quantity Type'),
            'quantity_price' => Yii::t('app', 'Quantity Price'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_until' => Yii::t('app', 'Date Until'),
            'color' => Yii::t('app', 'Color'),
            'price' => Yii::t('app', 'Price'),
            'price_currency_id' => Yii::t('app', 'Price Currency ID'),
            'extra_price' => Yii::t('app', 'Extra Price'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'vat' => Yii::t('app', 'Vat'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItem()
    {
        return $this->hasOne(Items::class, ['id' => 'invoice_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(ItemsPeriod::class, ['id' => 'period_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ItemsPricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ItemsPricesQuery(get_called_class());
    }
}
