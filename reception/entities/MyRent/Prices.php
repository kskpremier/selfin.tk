<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "_prices".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property int $group_id this is just grouping for syncing (no conenction with grouos)
 * @property string $day
 * @property string $check_in
 * @property string $check_out
 * @property double $price
 * @property double $price_b2b
 * @property double $price_special
 * @property int $min_stay
 * @property double $price_extra
 * @property double $price_extra_child
 * @property double $extra_from
 * @property string $enable
 * @property string $created
 * @property string $changed
 */
class Prices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_prices';
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
        * @param int $group_id// this is just grouping for syncing (no conenction with grouos)
        * @param string $day//
        * @param string $check_in//
        * @param string $check_out//
        * @param double $price//
        * @param double $price_b2b//
        * @param double $price_special//
        * @param int $min_stay//
        * @param double $price_extra//
        * @param double $price_extra_child//
        * @param double $extra_from//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return Prices    */
    public static function create($id, $user_id, $object_id, $item_id, $group_id, $day, $check_in, $check_out, $price, $price_b2b, $price_special, $min_stay, $price_extra, $price_extra_child, $extra_from, $enable, $created, $changed): Prices
    {
        $prices = new static();
                $prices->id = $id;
                $prices->user_id = $user_id;
                $prices->object_id = $object_id;
                $prices->item_id = $item_id;
                $prices->group_id = $group_id;
                $prices->day = $day;
                $prices->check_in = $check_in;
                $prices->check_out = $check_out;
                $prices->price = $price;
                $prices->price_b2b = $price_b2b;
                $prices->price_special = $price_special;
                $prices->min_stay = $min_stay;
                $prices->price_extra = $price_extra;
                $prices->price_extra_child = $price_extra_child;
                $prices->extra_from = $extra_from;
                $prices->enable = $enable;
                $prices->created = $created;
                $prices->changed = $changed;
        
        return $prices;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param int $group_id// this is just grouping for syncing (no conenction with grouos)
            * @param string $day//
            * @param string $check_in//
            * @param string $check_out//
            * @param double $price//
            * @param double $price_b2b//
            * @param double $price_special//
            * @param int $min_stay//
            * @param double $price_extra//
            * @param double $price_extra_child//
            * @param double $extra_from//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return Prices    */
    public function edit($id, $user_id, $object_id, $item_id, $group_id, $day, $check_in, $check_out, $price, $price_b2b, $price_special, $min_stay, $price_extra, $price_extra_child, $extra_from, $enable, $created, $changed): Prices
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->group_id = $group_id;
            $this->day = $day;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->price = $price;
            $this->price_b2b = $price_b2b;
            $this->price_special = $price_special;
            $this->min_stay = $min_stay;
            $this->price_extra = $price_extra;
            $this->price_extra_child = $price_extra_child;
            $this->extra_from = $extra_from;
            $this->enable = $enable;
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
            'day' => Yii::t('app', 'Day'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'price' => Yii::t('app', 'Price'),
            'price_b2b' => Yii::t('app', 'Price B2b'),
            'price_special' => Yii::t('app', 'Price Special'),
            'min_stay' => Yii::t('app', 'Min Stay'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'price_extra_child' => Yii::t('app', 'Price Extra Child'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'enable' => Yii::t('app', 'Enable'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\PricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\PricesQuery(get_called_class());
    }
}
