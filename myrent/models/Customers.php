<?php

namespace myrent\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_group_id
 * @property string $type
 * @property string $code
 * @property double $partner_discount partner discount for selling 
 * @property string $username
 * @property string $password
 * @property string $guid
 * @property string $color
 * @property string $name
 * @property string $address
 * @property string $city_name
 * @property string $city_zip
 * @property string $vat_id id of customer
 * @property string $mb
 * @property string $oib
 * @property string $note
 * @property string $note_invoice
 * @property string $contact_name
 * @property string $facebook
 * @property string $skype
 * @property string $contact_tel
 * @property string $contact_email
 * @property int $country_id
 * @property string $favourite
 * @property string $partner
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Countries $country
 * @property CustomersGroups $customerGroup
 * @property CustomersB2b[] $customersB2bs
 * @property CustomersObjects[] $customersObjects
 * @property CustomersPrices[] $customersPrices
 * @property Rents[] $rents
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRentLocal');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'customer_group_id', 'country_id'], 'integer'],
            [['type', 'note', 'note_invoice', 'favourite', 'partner', 'active'], 'string'],
            [['partner_discount'], 'number'],
            [['created', 'changed'], 'safe'],
            [['code', 'username', 'password', 'guid', 'color', 'city_name', 'city_zip', 'vat_id', 'mb', 'oib', 'facebook', 'skype', 'contact_tel', 'contact_email'], 'string', 'max' => 50],
            [['name', 'address', 'contact_name'], 'string', 'max' => 100],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['customer_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomersGroups::className(), 'targetAttribute' => ['customer_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'customer_group_id' => 'Customer Group ID',
            'type' => 'Type',
            'code' => 'Code',
            'partner_discount' => 'Partner Discount',
            'username' => 'Username',
            'password' => 'Password',
            'guid' => 'Guid',
            'color' => 'Color',
            'name' => 'Name',
            'address' => 'Address',
            'city_name' => 'City Name',
            'city_zip' => 'City Zip',
            'vat_id' => 'Vat ID',
            'mb' => 'Mb',
            'oib' => 'Oib',
            'note' => 'Note',
            'note_invoice' => 'Note Invoice',
            'contact_name' => 'Contact Name',
            'facebook' => 'Facebook',
            'skype' => 'Skype',
            'contact_tel' => 'Contact Tel',
            'contact_email' => 'Contact Email',
            'country_id' => 'Country ID',
            'favourite' => 'Favourite',
            'partner' => 'Partner',
            'active' => 'Active',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomersGroups::className(), ['id' => 'customer_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersB2bs()
    {
        return $this->hasMany(CustomersB2b::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersObjects()
    {
        return $this->hasMany(CustomersObjects::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['customer_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomersQuery(get_called_class());
    }
}
