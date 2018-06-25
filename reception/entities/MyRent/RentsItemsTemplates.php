<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_items_templates".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property string $code
 * @property string $name
 * @property string $item_name
 * @property string $item_code
 * @property double $price
 * @property double $discount
 * @property double $quantity
 * @property double $vat
 * @property string $created
 * @property string $changed
 *
 * @property Items $item
 * @property Objects $object
 * @property Users $user
 */
class RentsItemsTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_items_templates';
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
        * @param int $item_id//
        * @param string $code//
        * @param string $name//
        * @param string $item_name//
        * @param string $item_code//
        * @param double $price//
        * @param double $discount//
        * @param double $quantity//
        * @param double $vat//
        * @param string $created//
        * @param string $changed//
        * @return RentsItemsTemplates    */
    public static function create($id, $user_id, $object_id, $item_id, $code, $name, $item_name, $item_code, $price, $discount, $quantity, $vat, $created, $changed): RentsItemsTemplates
    {
        $rentsItemsTemplates = new static();
                $rentsItemsTemplates->id = $id;
                $rentsItemsTemplates->user_id = $user_id;
                $rentsItemsTemplates->object_id = $object_id;
                $rentsItemsTemplates->item_id = $item_id;
                $rentsItemsTemplates->code = $code;
                $rentsItemsTemplates->name = $name;
                $rentsItemsTemplates->item_name = $item_name;
                $rentsItemsTemplates->item_code = $item_code;
                $rentsItemsTemplates->price = $price;
                $rentsItemsTemplates->discount = $discount;
                $rentsItemsTemplates->quantity = $quantity;
                $rentsItemsTemplates->vat = $vat;
                $rentsItemsTemplates->created = $created;
                $rentsItemsTemplates->changed = $changed;
        
        return $rentsItemsTemplates;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param string $code//
            * @param string $name//
            * @param string $item_name//
            * @param string $item_code//
            * @param double $price//
            * @param double $discount//
            * @param double $quantity//
            * @param double $vat//
            * @param string $created//
            * @param string $changed//
        * @return RentsItemsTemplates    */
    public function edit($id, $user_id, $object_id, $item_id, $code, $name, $item_name, $item_code, $price, $discount, $quantity, $vat, $created, $changed): RentsItemsTemplates
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->code = $code;
            $this->name = $name;
            $this->item_name = $item_name;
            $this->item_code = $item_code;
            $this->price = $price;
            $this->discount = $discount;
            $this->quantity = $quantity;
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
            'item_id' => Yii::t('app', 'Item ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'item_name' => Yii::t('app', 'Item Name'),
            'item_code' => Yii::t('app', 'Item Code'),
            'price' => Yii::t('app', 'Price'),
            'discount' => Yii::t('app', 'Discount'),
            'quantity' => Yii::t('app', 'Quantity'),
            'vat' => Yii::t('app', 'Vat'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
     * @return \reception\entities\MyRent\queries\RentsItemsTemplatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsItemsTemplatesQuery(get_called_class());
    }
}
