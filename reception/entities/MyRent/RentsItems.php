<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "rents_items".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property int $item_id
 * @property int $worker_id
 * @property int $currency_id
 * @property string $code code of item
 * @property string $name name of item
 * @property string $note
 * @property double $price
 * @property double $quantity
 * @property double $discount % - percent discount
 * @property double $vat % - percent vat
 * @property double $vat_extra % - percent vat
 * @property double $exchange
 * @property string $maunal add manualy
 * @property string $created
 * @property string $changed
 *
 * @property Currency $currency
 * @property Items $item
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class RentsItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_items';
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
        * @param int $rent_id//
        * @param int $item_id//
        * @param int $worker_id//
        * @param int $currency_id//
        * @param string $code// code of item
        * @param string $name// name of item
        * @param string $note//
        * @param double $price//
        * @param double $quantity//
        * @param double $discount// % - percent discount
        * @param double $vat// % - percent vat
        * @param double $vat_extra// % - percent vat
        * @param double $exchange//
        * @param string $maunal// add manualy
        * @param string $created//
        * @param string $changed//
        * @return RentsItems    */
    public static function create($id, $user_id, $rent_id, $item_id, $worker_id, $currency_id, $code, $name, $note, $price, $quantity, $discount, $vat, $vat_extra, $exchange, $maunal, $created, $changed): RentsItems
    {
        $rentsItems = new static();
                $rentsItems->id = $id;
                $rentsItems->user_id = $user_id;
                $rentsItems->rent_id = $rent_id;
                $rentsItems->item_id = $item_id;
                $rentsItems->worker_id = $worker_id;
                $rentsItems->currency_id = $currency_id;
                $rentsItems->code = $code;
                $rentsItems->name = $name;
                $rentsItems->note = $note;
                $rentsItems->price = $price;
                $rentsItems->quantity = $quantity;
                $rentsItems->discount = $discount;
                $rentsItems->vat = $vat;
                $rentsItems->vat_extra = $vat_extra;
                $rentsItems->exchange = $exchange;
                $rentsItems->maunal = $maunal;
                $rentsItems->created = $created;
                $rentsItems->changed = $changed;
        
        return $rentsItems;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param int $item_id//
            * @param int $worker_id//
            * @param int $currency_id//
            * @param string $code// code of item
            * @param string $name// name of item
            * @param string $note//
            * @param double $price//
            * @param double $quantity//
            * @param double $discount// % - percent discount
            * @param double $vat// % - percent vat
            * @param double $vat_extra// % - percent vat
            * @param double $exchange//
            * @param string $maunal// add manualy
            * @param string $created//
            * @param string $changed//
        * @return RentsItems    */
    public function edit($id, $user_id, $rent_id, $item_id, $worker_id, $currency_id, $code, $name, $note, $price, $quantity, $discount, $vat, $vat_extra, $exchange, $maunal, $created, $changed): RentsItems
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->item_id = $item_id;
            $this->worker_id = $worker_id;
            $this->currency_id = $currency_id;
            $this->code = $code;
            $this->name = $name;
            $this->note = $note;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->discount = $discount;
            $this->vat = $vat;
            $this->vat_extra = $vat_extra;
            $this->exchange = $exchange;
            $this->maunal = $maunal;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'price' => Yii::t('app', 'Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'discount' => Yii::t('app', 'Discount'),
            'vat' => Yii::t('app', 'Vat'),
            'vat_extra' => Yii::t('app', 'Vat Extra'),
            'exchange' => Yii::t('app', 'Exchange'),
            'maunal' => Yii::t('app', 'Maunal'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsItemsQuery(get_called_class());
    }
}
