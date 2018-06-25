<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Customer;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "customers_prices".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property int $customer_id
 * @property int $group_id this is just grouping for syncing (no conenction with grouos)
 * @property string $day
 * @property string $check_id
 * @property string $check_out
 * @property double $price
 * @property double $alotman
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
class CustomersPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_prices';
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
        * @param string $day//
        * @param string $check_id//
        * @param string $check_out//
        * @param double $price//
        * @param double $alotman//
        * @param double $price_special//
        * @param int $min_stay//
        * @param double $price_extra//
        * @param double $extra_from//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return CustomersPrices    */
    public static function create($id, $user_id, $object_id, $item_id, $customer_id, $group_id, $day, $check_id, $check_out, $price, $alotman, $price_special, $min_stay, $price_extra, $extra_from, $enable, $created, $changed): CustomersPrices
    {
        $customersPrices = new static();
                $customersPrices->id = $id;
                $customersPrices->user_id = $user_id;
                $customersPrices->object_id = $object_id;
                $customersPrices->item_id = $item_id;
                $customersPrices->customer_id = $customer_id;
                $customersPrices->group_id = $group_id;
                $customersPrices->day = $day;
                $customersPrices->check_id = $check_id;
                $customersPrices->check_out = $check_out;
                $customersPrices->price = $price;
                $customersPrices->alotman = $alotman;
                $customersPrices->price_special = $price_special;
                $customersPrices->min_stay = $min_stay;
                $customersPrices->price_extra = $price_extra;
                $customersPrices->extra_from = $extra_from;
                $customersPrices->enable = $enable;
                $customersPrices->created = $created;
                $customersPrices->changed = $changed;
        
        return $customersPrices;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param int $customer_id//
            * @param int $group_id// this is just grouping for syncing (no conenction with grouos)
            * @param string $day//
            * @param string $check_id//
            * @param string $check_out//
            * @param double $price//
            * @param double $alotman//
            * @param double $price_special//
            * @param int $min_stay//
            * @param double $price_extra//
            * @param double $extra_from//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return CustomersPrices    */
    public function edit($id, $user_id, $object_id, $item_id, $customer_id, $group_id, $day, $check_id, $check_out, $price, $alotman, $price_special, $min_stay, $price_extra, $extra_from, $enable, $created, $changed): CustomersPrices
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
            $this->customer_id = $customer_id;
            $this->group_id = $group_id;
            $this->day = $day;
            $this->check_id = $check_id;
            $this->check_out = $check_out;
            $this->price = $price;
            $this->alotman = $alotman;
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
            'day' => Yii::t('app', 'Day'),
            'check_id' => Yii::t('app', 'Check ID'),
            'check_out' => Yii::t('app', 'Check Out'),
            'price' => Yii::t('app', 'Price'),
            'alotman' => Yii::t('app', 'Alotman'),
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
     * @return \reception\entities\MyRent\queries\CustomersPricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CustomersPricesQuery(get_called_class());
    }
}
