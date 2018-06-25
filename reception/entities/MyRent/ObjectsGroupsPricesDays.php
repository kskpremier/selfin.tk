<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Group;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_groups_prices_days".
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id link to group_id (diferent from normal prices!)
 * @property int $item_id
 * @property string $day
 * @property int $stock
 * @property double $price
 * @property double $price_single single price (booking.com)
 * @property double $price_b2b
 * @property double $price_extra
 * @property double $extra_from
 * @property double $price_special special price, for promotions
 * @property double $price_extra_child
 * @property string $check_in
 * @property string $check_out
 * @property string $enable
 * @property int $min_stay
 * @property string $created
 * @property string $changed
 *
 * @property Items $item
 * @property ObjectsGroups $group
 * @property Users $user
 */
class ObjectsGroupsPricesDays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_groups_prices_days';
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
        * @param int $group_id// link to group_id (diferent from normal prices!)
        * @param int $item_id//
        * @param string $day//
        * @param int $stock//
        * @param double $price//
        * @param double $price_single// single price (booking.com)
        * @param double $price_b2b//
        * @param double $price_extra//
        * @param double $extra_from//
        * @param double $price_special// special price, for promotions
        * @param double $price_extra_child//
        * @param string $check_in//
        * @param string $check_out//
        * @param string $enable//
        * @param int $min_stay//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsGroupsPricesDays    */
    public static function create($id, $user_id, $group_id, $item_id, $day, $stock, $price, $price_single, $price_b2b, $price_extra, $extra_from, $price_special, $price_extra_child, $check_in, $check_out, $enable, $min_stay, $created, $changed): ObjectsGroupsPricesDays
    {
        $objectsGroupsPricesDays = new static();
                $objectsGroupsPricesDays->id = $id;
                $objectsGroupsPricesDays->user_id = $user_id;
                $objectsGroupsPricesDays->group_id = $group_id;
                $objectsGroupsPricesDays->item_id = $item_id;
                $objectsGroupsPricesDays->day = $day;
                $objectsGroupsPricesDays->stock = $stock;
                $objectsGroupsPricesDays->price = $price;
                $objectsGroupsPricesDays->price_single = $price_single;
                $objectsGroupsPricesDays->price_b2b = $price_b2b;
                $objectsGroupsPricesDays->price_extra = $price_extra;
                $objectsGroupsPricesDays->extra_from = $extra_from;
                $objectsGroupsPricesDays->price_special = $price_special;
                $objectsGroupsPricesDays->price_extra_child = $price_extra_child;
                $objectsGroupsPricesDays->check_in = $check_in;
                $objectsGroupsPricesDays->check_out = $check_out;
                $objectsGroupsPricesDays->enable = $enable;
                $objectsGroupsPricesDays->min_stay = $min_stay;
                $objectsGroupsPricesDays->created = $created;
                $objectsGroupsPricesDays->changed = $changed;
        
        return $objectsGroupsPricesDays;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $group_id// link to group_id (diferent from normal prices!)
            * @param int $item_id//
            * @param string $day//
            * @param int $stock//
            * @param double $price//
            * @param double $price_single// single price (booking.com)
            * @param double $price_b2b//
            * @param double $price_extra//
            * @param double $extra_from//
            * @param double $price_special// special price, for promotions
            * @param double $price_extra_child//
            * @param string $check_in//
            * @param string $check_out//
            * @param string $enable//
            * @param int $min_stay//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsGroupsPricesDays    */
    public function edit($id, $user_id, $group_id, $item_id, $day, $stock, $price, $price_single, $price_b2b, $price_extra, $extra_from, $price_special, $price_extra_child, $check_in, $check_out, $enable, $min_stay, $created, $changed): ObjectsGroupsPricesDays
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->group_id = $group_id;
            $this->item_id = $item_id;
            $this->day = $day;
            $this->stock = $stock;
            $this->price = $price;
            $this->price_single = $price_single;
            $this->price_b2b = $price_b2b;
            $this->price_extra = $price_extra;
            $this->extra_from = $extra_from;
            $this->price_special = $price_special;
            $this->price_extra_child = $price_extra_child;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->enable = $enable;
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
            'group_id' => Yii::t('app', 'Group ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'day' => Yii::t('app', 'Day'),
            'stock' => Yii::t('app', 'Stock'),
            'price' => Yii::t('app', 'Price'),
            'price_single' => Yii::t('app', 'Price Single'),
            'price_b2b' => Yii::t('app', 'Price B2b'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'price_special' => Yii::t('app', 'Price Special'),
            'price_extra_child' => Yii::t('app', 'Price Extra Child'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'enable' => Yii::t('app', 'Enable'),
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
     * @return \reception\entities\MyRent\queries\ObjectsGroupsPricesDaysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsGroupsPricesDaysQuery(get_called_class());
    }
}
