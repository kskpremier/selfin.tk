<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Customer;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "customers_objects".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property int $object_id
 * @property string $created
 * @property string $changed
 *
 * @property Customers $customer
 * @property Objects $object
 * @property Users $user
 */
class CustomersObjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_objects';
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
        * @param int $customer_id//
        * @param int $object_id//
        * @param string $created//
        * @param string $changed//
        * @return CustomersObjects    */
    public static function create($id, $user_id, $customer_id, $object_id, $created, $changed): CustomersObjects
    {
        $customersObjects = new static();
                $customersObjects->id = $id;
                $customersObjects->user_id = $user_id;
                $customersObjects->customer_id = $customer_id;
                $customersObjects->object_id = $object_id;
                $customersObjects->created = $created;
                $customersObjects->changed = $changed;
        
        return $customersObjects;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $customer_id//
            * @param int $object_id//
            * @param string $created//
            * @param string $changed//
        * @return CustomersObjects    */
    public function edit($id, $user_id, $customer_id, $object_id, $created, $changed): CustomersObjects
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->customer_id = $customer_id;
            $this->object_id = $object_id;
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'object_id' => Yii::t('app', 'Object ID'),
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
     * @return \reception\entities\MyRent\queries\CustomersObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CustomersObjectsQuery(get_called_class());
    }
}
