<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Customer;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_prices_days_customers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property int $customer_id
 * @property int $group_id this is just grouping for syncing (no conenction with grouos)
 * @property int $stock
 * @property string $day
 * @property string $check_in
 * @property string $check_out
 * @property double $price
 * @property double $price_b2b
 * @property double $price_special
 * @property int $min_stay
 * @property double $price_extra
 * @property double $extra_from
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property Customers $customer
 * @property Items $item
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPricesDaysCustomers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_days_customers';
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
        * @param int $customer_id//
        * @param int $group_id// this is just grouping for syncing (no conenction with grouos)
        * @param int $stock//
        * @param string $day//
        * @param string $check_in//
        * @param string $check_out//
        * @param double $price//
        * @param double $price_b2b//
        * @param double $price_special//
        * @param int $min_stay//
        * @param double $price_extra//
        * @param double $extra_from//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesDaysCustomers    */
    public static function create($id, $user_id, $object_id, $item_id, $customer_id, $group_id, $stock, $day, $check_in, $check_out, $price, $price_b2b, $price_special, $min_stay, $price_extra, $extra_from, $enable, $created, $changed): ObjectsPricesDaysCustomers
    {
        $objectsPricesDaysCustomers = new static();
                $objectsPricesDaysCustomers->id = $id;
                $objectsPricesDaysCustomers->user_id = $user_id;
                $objectsPricesDaysCustomers->object_id = $object_id;
                $objectsPricesDaysCustomers->item_id = $item_id;
                $objectsPricesDaysCustomers->customer_id = $customer_id;
                $objectsPricesDaysCustomers->group_id = $group_id;
                $objectsPricesDaysCustomers->stock = $stock;
                $objectsPricesDaysCustomers->day = $day;
                $objectsPricesDaysCustomers->check_in = $check_in;
                $objectsPricesDaysCustomers->check_out = $check_out;
                $objectsPricesDaysCustomers->price = $price;
                $objectsPricesDaysCustomers->price_b2b = $price_b2b;
                $objectsPricesDaysCustomers->price_special = $price_special;
                $objectsPricesDaysCustomers->min_stay = $min_stay;
                $objectsPricesDaysCustomers->price_extra = $price_extra;
                $objectsPricesDaysCustomers->extra_from = $extra_from;
                $objectsPricesDaysCustomers->enable = $enable;
                $objectsPricesDaysCustomers->created = $created;
                $objectsPricesDaysCustomers->changed = $changed;
        
        return $objectsPricesDaysCustomers;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param int $customer_id//
            * @param int $group_id// this is just grouping for syncing (no conenction with grouos)
            * @param int $stock//
            * @param string $day//
            * @param string $check_in//
            * @param string $check_out//
            * @param double $price//
            * @param double $price_b2b//
            * @param double $price_special//
            * @param int $min_stay//
            * @param double $price_extra//
            * @param double $extra_from//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesDaysCustomers    */
    public function edit($id, $user_id, $object_id, $item_id, $customer_id, $group_id, $stock, $day, $check_in, $check_out, $price, $price_b2b, $price_special, $min_stay, $price_extra, $extra_from, $enable, $created, $changed): ObjectsPricesDaysCustomers
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->customer_id = $customer_id;
            $this->group_id = $group_id;
            $this->stock = $stock;
            $this->day = $day;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->price = $price;
            $this->price_b2b = $price_b2b;
            $this->price_special = $price_special;
            $this->min_stay = $min_stay;
            $this->price_extra = $price_extra;
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'stock' => Yii::t('app', 'Stock'),
            'day' => Yii::t('app', 'Day'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'price' => Yii::t('app', 'Price'),
            'price_b2b' => Yii::t('app', 'Price B2b'),
            'price_special' => Yii::t('app', 'Price Special'),
            'min_stay' => Yii::t('app', 'Min Stay'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'extra_from' => Yii::t('app', 'Extra From'),
            'enable' => Yii::t('app', 'Enable'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::class, ['id' => 'customer_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsPricesDaysCustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesDaysCustomersQuery(get_called_class());
    }
}
