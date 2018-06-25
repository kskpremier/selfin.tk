<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Group;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "items_b2b".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property int $object_id
 * @property int $group_id
 * @property int $item_id
 * @property string $value
 * @property double $price_percent
 * @property double $price1_percent booking.com price1 
 * @property string $single_price_active
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Items $item
 * @property Objects $object
 * @property ObjectsGroups $group
 * @property Users $user
 */
class ItemsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_b2b';
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
        * @param int $b2b_id//
        * @param int $object_id//
        * @param int $group_id//
        * @param int $item_id//
        * @param string $value//
        * @param double $price_percent//
        * @param double $price1_percent// booking.com price1 
        * @param string $single_price_active//
        * @param string $created//
        * @param string $changed//
        * @return ItemsB2b    */
    public static function create($id, $user_id, $b2b_id, $object_id, $group_id, $item_id, $value, $price_percent, $price1_percent, $single_price_active, $created, $changed): ItemsB2b
    {
        $itemsB2b = new static();
                $itemsB2b->id = $id;
                $itemsB2b->user_id = $user_id;
                $itemsB2b->b2b_id = $b2b_id;
                $itemsB2b->object_id = $object_id;
                $itemsB2b->group_id = $group_id;
                $itemsB2b->item_id = $item_id;
                $itemsB2b->value = $value;
                $itemsB2b->price_percent = $price_percent;
                $itemsB2b->price1_percent = $price1_percent;
                $itemsB2b->single_price_active = $single_price_active;
                $itemsB2b->created = $created;
                $itemsB2b->changed = $changed;
        
        return $itemsB2b;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param int $object_id//
            * @param int $group_id//
            * @param int $item_id//
            * @param string $value//
            * @param double $price_percent//
            * @param double $price1_percent// booking.com price1 
            * @param string $single_price_active//
            * @param string $created//
            * @param string $changed//
        * @return ItemsB2b    */
    public function edit($id, $user_id, $b2b_id, $object_id, $group_id, $item_id, $value, $price_percent, $price1_percent, $single_price_active, $created, $changed): ItemsB2b
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->object_id = $object_id;
            $this->group_id = $group_id;
            $this->item_id = $item_id;
            $this->value = $value;
            $this->price_percent = $price_percent;
            $this->price1_percent = $price1_percent;
            $this->single_price_active = $single_price_active;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'value' => Yii::t('app', 'Value'),
            'price_percent' => Yii::t('app', 'Price Percent'),
            'price1_percent' => Yii::t('app', 'Price1 Percent'),
            'single_price_active' => Yii::t('app', 'Single Price Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
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
    public function getGroup()
    {
        return $this->hasOne(ObjectsGroups::class, ['id' => 'group_id']);
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
     * @return \reception\entities\MyRent\queries\ItemsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ItemsB2bQuery(get_called_class());
    }
}
