<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Customer;

/**
 * This is the model class for table "customers_b2b".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property Customers $customer
 */
class CustomersB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_b2b';
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
        * @param int $customer_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return CustomersB2b    */
    public static function create($id, $customer_id, $value, $created, $changed): CustomersB2b
    {
        $customersB2b = new static();
                $customersB2b->id = $id;
                $customersB2b->customer_id = $customer_id;
                $customersB2b->value = $value;
                $customersB2b->created = $created;
                $customersB2b->changed = $changed;
        
        return $customersB2b;
    }

    /**
            * @param int $id//
            * @param int $customer_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return CustomersB2b    */
    public function edit($id, $customer_id, $value, $created, $changed): CustomersB2b
    {

            $this->id = $id;
            $this->customer_id = $customer_id;
            $this->value = $value;
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'value' => Yii::t('app', 'Value'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CustomersB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CustomersB2bQuery(get_called_class());
    }
}
