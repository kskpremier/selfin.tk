<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Invoice;

/**
 * This is the model class for table "users_myrent_invoices_items".
 *
 * @property int $id
 * @property int $invoice_id
 * @property string $item_code
 * @property string $item_name
 * @property double $amount
 * @property string $amount_type
 * @property double $price
 * @property double $vat
 * @property double $discount
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property UsersMyrentInvoicesHeaders $invoice
 */
class UsersMyrentInvoicesItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_myrent_invoices_items';
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
        * @param int $invoice_id//
        * @param string $item_code//
        * @param string $item_name//
        * @param double $amount//
        * @param string $amount_type//
        * @param double $price//
        * @param double $vat//
        * @param double $discount//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return UsersMyrentInvoicesItems    */
    public static function create($id, $invoice_id, $item_code, $item_name, $amount, $amount_type, $price, $vat, $discount, $note, $created, $changed): UsersMyrentInvoicesItems
    {
        $usersMyrentInvoicesItems = new static();
                $usersMyrentInvoicesItems->id = $id;
                $usersMyrentInvoicesItems->invoice_id = $invoice_id;
                $usersMyrentInvoicesItems->item_code = $item_code;
                $usersMyrentInvoicesItems->item_name = $item_name;
                $usersMyrentInvoicesItems->amount = $amount;
                $usersMyrentInvoicesItems->amount_type = $amount_type;
                $usersMyrentInvoicesItems->price = $price;
                $usersMyrentInvoicesItems->vat = $vat;
                $usersMyrentInvoicesItems->discount = $discount;
                $usersMyrentInvoicesItems->note = $note;
                $usersMyrentInvoicesItems->created = $created;
                $usersMyrentInvoicesItems->changed = $changed;
        
        return $usersMyrentInvoicesItems;
    }

    /**
            * @param int $id//
            * @param int $invoice_id//
            * @param string $item_code//
            * @param string $item_name//
            * @param double $amount//
            * @param string $amount_type//
            * @param double $price//
            * @param double $vat//
            * @param double $discount//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return UsersMyrentInvoicesItems    */
    public function edit($id, $invoice_id, $item_code, $item_name, $amount, $amount_type, $price, $vat, $discount, $note, $created, $changed): UsersMyrentInvoicesItems
    {

            $this->id = $id;
            $this->invoice_id = $invoice_id;
            $this->item_code = $item_code;
            $this->item_name = $item_name;
            $this->amount = $amount;
            $this->amount_type = $amount_type;
            $this->price = $price;
            $this->vat = $vat;
            $this->discount = $discount;
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
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'item_code' => Yii::t('app', 'Item Code'),
            'item_name' => Yii::t('app', 'Item Name'),
            'amount' => Yii::t('app', 'Amount'),
            'amount_type' => Yii::t('app', 'Amount Type'),
            'price' => Yii::t('app', 'Price'),
            'vat' => Yii::t('app', 'Vat'),
            'discount' => Yii::t('app', 'Discount'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(UsersMyrentInvoicesHeaders::class, ['id' => 'invoice_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersMyrentInvoicesItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersMyrentInvoicesItemsQuery(get_called_class());
    }
}
