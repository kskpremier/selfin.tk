<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_prices_days_neto".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property int $group_id
 * @property int $stock
 * @property string $day
 * @property double $price
 * @property double $price_b2b
 * @property double $price_special
 * @property string $check_in
 * @property string $check_out
 * @property string $enable
 * @property double $price_extra
 * @property double $price_extra_child
 * @property double $extra_from
 * @property int $min_stay
 * @property string $created
 * @property string $changed
 *
 * @property Items $item
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPricesDaysNeto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_days_neto';
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
        * @param int $group_id//
        * @param int $stock//
        * @param string $day//
        * @param double $price//
        * @param double $price_b2b//
        * @param double $price_special//
        * @param string $check_in//
        * @param string $check_out//
        * @param string $enable//
        * @param double $price_extra//
        * @param double $price_extra_child//
        * @param double $extra_from//
        * @param int $min_stay//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesDaysNeto    */
    public static function create($id, $user_id, $object_id, $item_id, $group_id, $stock, $day, $price, $price_b2b, $price_special, $check_in, $check_out, $enable, $price_extra, $price_extra_child, $extra_from, $min_stay, $created, $changed): ObjectsPricesDaysNeto
    {
        $objectsPricesDaysNeto = new static();
                $objectsPricesDaysNeto->id = $id;
                $objectsPricesDaysNeto->user_id = $user_id;
                $objectsPricesDaysNeto->object_id = $object_id;
                $objectsPricesDaysNeto->item_id = $item_id;
                $objectsPricesDaysNeto->group_id = $group_id;
                $objectsPricesDaysNeto->stock = $stock;
                $objectsPricesDaysNeto->day = $day;
                $objectsPricesDaysNeto->price = $price;
                $objectsPricesDaysNeto->price_b2b = $price_b2b;
                $objectsPricesDaysNeto->price_special = $price_special;
                $objectsPricesDaysNeto->check_in = $check_in;
                $objectsPricesDaysNeto->check_out = $check_out;
                $objectsPricesDaysNeto->enable = $enable;
                $objectsPricesDaysNeto->price_extra = $price_extra;
                $objectsPricesDaysNeto->price_extra_child = $price_extra_child;
                $objectsPricesDaysNeto->extra_from = $extra_from;
                $objectsPricesDaysNeto->min_stay = $min_stay;
                $objectsPricesDaysNeto->created = $created;
                $objectsPricesDaysNeto->changed = $changed;
        
        return $objectsPricesDaysNeto;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param int $group_id//
            * @param int $stock//
            * @param string $day//
            * @param double $price//
            * @param double $price_b2b//
            * @param double $price_special//
            * @param string $check_in//
            * @param string $check_out//
            * @param string $enable//
            * @param double $price_extra//
            * @param double $price_extra_child//
            * @param double $extra_from//
            * @param int $min_stay//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesDaysNeto    */
    public function edit($id, $user_id, $object_id, $item_id, $group_id, $stock, $day, $price, $price_b2b, $price_special, $check_in, $check_out, $enable, $price_extra, $price_extra_child, $extra_from, $min_stay, $created, $changed): ObjectsPricesDaysNeto
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->group_id = $group_id;
            $this->stock = $stock;
            $this->day = $day;
            $this->price = $price;
            $this->price_b2b = $price_b2b;
            $this->price_special = $price_special;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->enable = $enable;
            $this->price_extra = $price_extra;
            $this->price_extra_child = $price_extra_child;
            $this->extra_from = $extra_from;
            $this->min_stay = $min_stay;
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
            'group_id' => Yii::t('app', 'Group ID'),
            'stock' => Yii::t('app', 'Stock'),
            'day' => Yii::t('app', 'Day'),
            'price' => Yii::t('app', 'Price'),
            'price_b2b' => Yii::t('app', 'Price B2b'),
            'price_special' => Yii::t('app', 'Price Special'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'enable' => Yii::t('app', 'Enable'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'price_extra_child' => Yii::t('app', 'Price Extra Child'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'min_stay' => Yii::t('app', 'Min Stay'),
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
     * @return \reception\entities\MyRent\queries\ObjectsPricesDaysNetoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesDaysNetoQuery(get_called_class());
    }
}
