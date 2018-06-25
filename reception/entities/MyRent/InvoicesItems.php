<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\NetoCurrency;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\InvoiceIdStorno;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "invoices_items".
 *
 * @property int $id
 * @property int $user_id
 * @property int $invoice_id
 * @property int $invoice_id_storno id of document for storno
 * @property int $item_id
 * @property int $rent_id
 * @property string $type type of item
 * @property string $date_from
 * @property string $date_until
 * @property string $item_code
 * @property string $item_name
 * @property string $item_note
 * @property int $currency_id
 * @property double $price sell price
 * @property double $exchange exchange for price
 * @property double $neto_price neto price
 * @property int $neto_currency_id
 * @property double $neto_exchange
 * @property double $neto_vat
 * @property double $vat
 * @property double $vat_extra
 * @property double $discount
 * @property double $quantity
 * @property string $auto_generate
 * @property string $created
 * @property string $changed
 *
 * @property Currency $currency
 * @property Currency $netoCurrency
 * @property InvoicesHeader $invoice
 * @property InvoicesHeader $invoiceIdStorno
 * @property Items $item
 * @property Rents $rent
 * @property Users $user
 */
class InvoicesItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_items';
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
        * @param int $invoice_id//
        * @param int $invoice_id_storno// id of document for storno
        * @param int $item_id//
        * @param int $rent_id//
        * @param string $type// type of item
        * @param string $date_from//
        * @param string $date_until//
        * @param string $item_code//
        * @param string $item_name//
        * @param string $item_note//
        * @param int $currency_id//
        * @param double $price// sell price
        * @param double $exchange// exchange for price
        * @param double $neto_price// neto price
        * @param int $neto_currency_id//
        * @param double $neto_exchange//
        * @param double $neto_vat//
        * @param double $vat//
        * @param double $vat_extra//
        * @param double $discount//
        * @param double $quantity//
        * @param string $auto_generate//
        * @param string $created//
        * @param string $changed//
        * @return InvoicesItems    */
    public static function create($id, $user_id, $invoice_id, $invoice_id_storno, $item_id, $rent_id, $type, $date_from, $date_until, $item_code, $item_name, $item_note, $currency_id, $price, $exchange, $neto_price, $neto_currency_id, $neto_exchange, $neto_vat, $vat, $vat_extra, $discount, $quantity, $auto_generate, $created, $changed): InvoicesItems
    {
        $invoicesItems = new static();
                $invoicesItems->id = $id;
                $invoicesItems->user_id = $user_id;
                $invoicesItems->invoice_id = $invoice_id;
                $invoicesItems->invoice_id_storno = $invoice_id_storno;
                $invoicesItems->item_id = $item_id;
                $invoicesItems->rent_id = $rent_id;
                $invoicesItems->type = $type;
                $invoicesItems->date_from = $date_from;
                $invoicesItems->date_until = $date_until;
                $invoicesItems->item_code = $item_code;
                $invoicesItems->item_name = $item_name;
                $invoicesItems->item_note = $item_note;
                $invoicesItems->currency_id = $currency_id;
                $invoicesItems->price = $price;
                $invoicesItems->exchange = $exchange;
                $invoicesItems->neto_price = $neto_price;
                $invoicesItems->neto_currency_id = $neto_currency_id;
                $invoicesItems->neto_exchange = $neto_exchange;
                $invoicesItems->neto_vat = $neto_vat;
                $invoicesItems->vat = $vat;
                $invoicesItems->vat_extra = $vat_extra;
                $invoicesItems->discount = $discount;
                $invoicesItems->quantity = $quantity;
                $invoicesItems->auto_generate = $auto_generate;
                $invoicesItems->created = $created;
                $invoicesItems->changed = $changed;
        
        return $invoicesItems;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $invoice_id//
            * @param int $invoice_id_storno// id of document for storno
            * @param int $item_id//
            * @param int $rent_id//
            * @param string $type// type of item
            * @param string $date_from//
            * @param string $date_until//
            * @param string $item_code//
            * @param string $item_name//
            * @param string $item_note//
            * @param int $currency_id//
            * @param double $price// sell price
            * @param double $exchange// exchange for price
            * @param double $neto_price// neto price
            * @param int $neto_currency_id//
            * @param double $neto_exchange//
            * @param double $neto_vat//
            * @param double $vat//
            * @param double $vat_extra//
            * @param double $discount//
            * @param double $quantity//
            * @param string $auto_generate//
            * @param string $created//
            * @param string $changed//
        * @return InvoicesItems    */
    public function edit($id, $user_id, $invoice_id, $invoice_id_storno, $item_id, $rent_id, $type, $date_from, $date_until, $item_code, $item_name, $item_note, $currency_id, $price, $exchange, $neto_price, $neto_currency_id, $neto_exchange, $neto_vat, $vat, $vat_extra, $discount, $quantity, $auto_generate, $created, $changed): InvoicesItems
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->invoice_id = $invoice_id;
            $this->invoice_id_storno = $invoice_id_storno;
            $this->item_id = $item_id;
            $this->rent_id = $rent_id;
            $this->type = $type;
            $this->date_from = $date_from;
            $this->date_until = $date_until;
            $this->item_code = $item_code;
            $this->item_name = $item_name;
            $this->item_note = $item_note;
            $this->currency_id = $currency_id;
            $this->price = $price;
            $this->exchange = $exchange;
            $this->neto_price = $neto_price;
            $this->neto_currency_id = $neto_currency_id;
            $this->neto_exchange = $neto_exchange;
            $this->neto_vat = $neto_vat;
            $this->vat = $vat;
            $this->vat_extra = $vat_extra;
            $this->discount = $discount;
            $this->quantity = $quantity;
            $this->auto_generate = $auto_generate;
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
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'invoice_id_storno' => Yii::t('app', 'Invoice Id Storno'),
            'item_id' => Yii::t('app', 'Item ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'type' => Yii::t('app', 'Type'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_until' => Yii::t('app', 'Date Until'),
            'item_code' => Yii::t('app', 'Item Code'),
            'item_name' => Yii::t('app', 'Item Name'),
            'item_note' => Yii::t('app', 'Item Note'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'price' => Yii::t('app', 'Price'),
            'exchange' => Yii::t('app', 'Exchange'),
            'neto_price' => Yii::t('app', 'Neto Price'),
            'neto_currency_id' => Yii::t('app', 'Neto Currency ID'),
            'neto_exchange' => Yii::t('app', 'Neto Exchange'),
            'neto_vat' => Yii::t('app', 'Neto Vat'),
            'vat' => Yii::t('app', 'Vat'),
            'vat_extra' => Yii::t('app', 'Vat Extra'),
            'discount' => Yii::t('app', 'Discount'),
            'quantity' => Yii::t('app', 'Quantity'),
            'auto_generate' => Yii::t('app', 'Auto Generate'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetoCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'neto_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(InvoicesHeader::class, ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceIdStorno()
    {
        return $this->hasOne(InvoicesHeader::class, ['id' => 'invoice_id_storno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::class, ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
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
     * @return \reception\entities\MyRent\queries\InvoicesItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesItemsQuery(get_called_class());
    }
}
