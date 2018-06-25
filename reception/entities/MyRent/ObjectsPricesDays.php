<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_prices_days".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property int $group_id this is just grouping for syncing (no conenction with grouos)
 * @property int $stock available stock for selling
 * @property string $day day
 * @property string $check_in
 * @property string $check_out
 * @property double $price standard sell price
 * @property double $price_b2b sell price for B2B partners
 * @property double $price_special specal price, usual as discount
 * @property int $min_stay
 * @property int $days_before number of days before the checkin date
 * @property double $price_extra price for extra persons
 * @property double $price_extra_child
 * @property double $extra_from from what guest is extra price
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property Items $item
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPricesDays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_days';
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
        * @param int $stock// available stock for selling
        * @param string $day// day
        * @param string $check_in//
        * @param string $check_out//
        * @param double $price// standard sell price
        * @param double $price_b2b// sell price for B2B partners
        * @param double $price_special// specal price, usual as discount
        * @param int $min_stay//
        * @param int $days_before// number of days before the checkin date
        * @param double $price_extra// price for extra persons
        * @param double $price_extra_child//
        * @param double $extra_from// from what guest is extra price
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesDays    */
    public static function create($id, $user_id, $object_id, $item_id, $group_id, $stock, $day, $check_in, $check_out, $price, $price_b2b, $price_special, $min_stay, $days_before, $price_extra, $price_extra_child, $extra_from, $enable, $created, $changed): ObjectsPricesDays
    {
        $objectsPricesDays = new static();
                $objectsPricesDays->id = $id;
                $objectsPricesDays->user_id = $user_id;
                $objectsPricesDays->object_id = $object_id;
                $objectsPricesDays->item_id = $item_id;
                $objectsPricesDays->group_id = $group_id;
                $objectsPricesDays->stock = $stock;
                $objectsPricesDays->day = $day;
                $objectsPricesDays->check_in = $check_in;
                $objectsPricesDays->check_out = $check_out;
                $objectsPricesDays->price = $price;
                $objectsPricesDays->price_b2b = $price_b2b;
                $objectsPricesDays->price_special = $price_special;
                $objectsPricesDays->min_stay = $min_stay;
                $objectsPricesDays->days_before = $days_before;
                $objectsPricesDays->price_extra = $price_extra;
                $objectsPricesDays->price_extra_child = $price_extra_child;
                $objectsPricesDays->extra_from = $extra_from;
                $objectsPricesDays->enable = $enable;
                $objectsPricesDays->created = $created;
                $objectsPricesDays->changed = $changed;
        
        return $objectsPricesDays;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param int $group_id// this is just grouping for syncing (no conenction with grouos)
            * @param int $stock// available stock for selling
            * @param string $day// day
            * @param string $check_in//
            * @param string $check_out//
            * @param double $price// standard sell price
            * @param double $price_b2b// sell price for B2B partners
            * @param double $price_special// specal price, usual as discount
            * @param int $min_stay//
            * @param int $days_before// number of days before the checkin date
            * @param double $price_extra// price for extra persons
            * @param double $price_extra_child//
            * @param double $extra_from// from what guest is extra price
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesDays    */
    public function edit($id, $user_id, $object_id, $item_id, $group_id, $stock, $day, $check_in, $check_out, $price, $price_b2b, $price_special, $min_stay, $days_before, $price_extra, $price_extra_child, $extra_from, $enable, $created, $changed): ObjectsPricesDays
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->group_id = $group_id;
            $this->stock = $stock;
            $this->day = $day;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->price = $price;
            $this->price_b2b = $price_b2b;
            $this->price_special = $price_special;
            $this->min_stay = $min_stay;
            $this->days_before = $days_before;
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
            'stock' => Yii::t('app', 'Stock'),
            'day' => Yii::t('app', 'Day'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'price' => Yii::t('app', 'Price'),
            'price_b2b' => Yii::t('app', 'Price B2b'),
            'price_special' => Yii::t('app', 'Price Special'),
            'min_stay' => Yii::t('app', 'Min Stay'),
            'days_before' => Yii::t('app', 'Days Before'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'price_extra_child' => Yii::t('app', 'Price Extra Child'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'enable' => Yii::t('app', 'Enable'),
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
     * @return \reception\entities\MyRent\queries\ObjectsPricesDaysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesDaysQuery(get_called_class());
    }
}
