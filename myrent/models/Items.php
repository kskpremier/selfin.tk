<?php

namespace myrent\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property int $user_id
 * @property string $color
 * @property string $code
 * @property string $name
 * @property string $note
 * @property string $description
 * @property string $cancellation_policy
 * @property double $price
 * @property double $exchange
 * @property int $vat vat in %
 * @property string $price_rent get price from rent
 * @property string $price_rent_advance item for advance payment
 * @property string $price_rent_owner item for invoce from owner to agency
 * @property string $price_rent_provision item for rent provision
 * @property string $default use for system to auto generate
 * @property string $advance_payment item for advance payment on final invoice (-1)
 * @property string $breakfast
 * @property string $pay_in_hotel
 * @property string $refundable
 * @property string $city_tax calculate city tax, by guests
 * @property string $by_day multiply price by day
 * @property string $by_guest
 * @property string $percent calculate price by percent on rent prices
 * @property string $created
 * @property string $changed
 *
 * @property CustomersPrices[] $customersPrices
 * @property Rents[] $rents
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
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
            [['user_id', 'vat'], 'integer'],
            [['note', 'description', 'cancellation_policy', 'price_rent', 'price_rent_advance', 'price_rent_owner', 'price_rent_provision', 'default', 'advance_payment', 'breakfast', 'pay_in_hotel', 'refundable', 'city_tax', 'by_day', 'by_guest', 'percent'], 'string'],
            [['price', 'exchange'], 'number'],
            [['created', 'changed'], 'safe'],
            [['color', 'code', 'name'], 'string', 'max' => 50],
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
            'color' => 'Color',
            'code' => 'Code',
            'name' => 'Name',
            'note' => 'Note',
            'description' => 'Description',
            'cancellation_policy' => 'Cancellation Policy',
            'price' => 'Price',
            'exchange' => 'Exchange',
            'vat' => 'Vat',
            'price_rent' => 'Price Rent',
            'price_rent_advance' => 'Price Rent Advance',
            'price_rent_owner' => 'Price Rent Owner',
            'price_rent_provision' => 'Price Rent Provision',
            'default' => 'Default',
            'advance_payment' => 'Advance Payment',
            'breakfast' => 'Breakfast',
            'pay_in_hotel' => 'Pay In Hotel',
            'refundable' => 'Refundable',
            'city_tax' => 'City Tax',
            'by_day' => 'By Day',
            'by_guest' => 'By Guest',
            'percent' => 'Percent',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['item_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemsQuery(get_called_class());
    }
}
