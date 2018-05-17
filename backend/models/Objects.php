<?php

namespace backend\models;

use backend\query\models\ObjectsQuery;
use Yii;

/**
 * This is the model class for table "objects".
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property int $object_type_id
 * @property int $worker_id
 * @property int $cleaner_id
 * @property int $laundry_id
 * @property int $profile_id link ti profile for otas
 * @property string $type single property or group property
 * @property string $erp_id
 * @property string $object_type_extra
 * @property int $item_id
 * @property string $guid
 * @property string $price_calculation E  per extra people, Q - qountity, R - room, P - person
 * @property string $calculation_type P percent, F fiks
 * @property string $object
 * @property string $name
 * @property string $color
 * @property string $picture name of main picture
 * @property double $price
 * @property double $exchange
 * @property int $currency_id
 * @property int $vat VAT in %
 * @property int $vat_advance VAT for advance in %
 * @property int $balance_payment how many days before arrivl to pay full amont
 * @property int $sort how to sort objects
 * @property string $note
 * @property string $note_long for general notes, log
 * @property string $description
 * @property double $advance_percent
 * @property double $review
 * @property double $owner_provision owner provision
 * @property string $web is it for web
 * @property string $instant is enable instant book
 * @property string $active active globaly in myRent
 * @property string $details show details in offer, mail, guest portal
 * @property string $pay_casche if apartment is reciving casche
 * @property string $pay_iban iban transaction
 * @property string $pay_paypal paypal payments
 * @property string $pay_card if apartment is reciving credit cards
 * @property string $city_tax if we need to charge extra for city tax
 * @property string $guest_portal_details show property details on guest portal
 * @property string $own is this property your own
 * @property string $front_page display on web, fron page
 * @property string $door_id ID of door for self check in
 * @property string $created
 * @property string $changed
 *
 * @property CustomersObjects[] $customersObjects
 * @property CustomersPrices[] $customersPrices
 * @property Cleaners $cleaner
 * @property Currency $currency
 * @property Rents[] $rents
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'unit_id', 'object_type_id', 'worker_id', 'cleaner_id', 'laundry_id', 'profile_id', 'item_id', 'currency_id', 'vat', 'vat_advance', 'balance_payment', 'sort'], 'integer'],
            [['type', 'object_type_extra', 'price_calculation', 'calculation_type', 'note', 'note_long', 'description', 'web', 'instant', 'active', 'details', 'pay_casche', 'pay_iban', 'pay_paypal', 'pay_card', 'city_tax', 'guest_portal_details', 'own', 'front_page'], 'string'],
            [['price', 'exchange', 'advance_percent', 'review', 'owner_provision'], 'number'],
            [['created', 'changed'], 'safe'],
            [['erp_id', 'guid', 'object', 'color', 'door_id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['picture'], 'string', 'max' => 200],
            [['cleaner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cleaners::className(), 'targetAttribute' => ['cleaner_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
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
            'unit_id' => 'Unit ID',
            'object_type_id' => 'Object Type ID',
            'worker_id' => 'Worker ID',
            'cleaner_id' => 'Cleaner ID',
            'laundry_id' => 'Laundry ID',
            'profile_id' => 'Profile ID',
            'type' => 'Type',
            'erp_id' => 'Erp ID',
            'object_type_extra' => 'Object Type Extra',
            'item_id' => 'Item ID',
            'guid' => 'Guid',
            'price_calculation' => 'Price Calculation',
            'calculation_type' => 'Calculation Type',
            'object' => 'Object',
            'name' => 'Name',
            'color' => 'Color',
            'picture' => 'Picture',
            'price' => 'Price',
            'exchange' => 'Exchange',
            'currency_id' => 'Currency ID',
            'vat' => 'Vat',
            'vat_advance' => 'Vat Advance',
            'balance_payment' => 'Balance Payment',
            'sort' => 'Sort',
            'note' => 'Note',
            'note_long' => 'Note Long',
            'description' => 'Description',
            'advance_percent' => 'Advance Percent',
            'review' => 'Review',
            'owner_provision' => 'Owner Provision',
            'web' => 'Web',
            'instant' => 'Instant',
            'active' => 'Active',
            'details' => 'Details',
            'pay_casche' => 'Pay Casche',
            'pay_iban' => 'Pay Iban',
            'pay_paypal' => 'Pay Paypal',
            'pay_card' => 'Pay Card',
            'city_tax' => 'City Tax',
            'guest_portal_details' => 'Guest Portal Details',
            'own' => 'Own',
            'front_page' => 'Front Page',
            'door_id' => 'Door ID',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersObjects()
    {
        return $this->hasMany(CustomersObjects::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaner()
    {
        return $this->hasOne(Cleaners::className(), ['id' => 'cleaner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsForPeriod($start,$finish)
    {
//        $query = new ObjectsQuery($this);

        return $this->hasMany(Rents::className(), ['object_id' => 'id'])->forPeriod($start,$finish);
    }

    /**
     * @inheritdoc
     * @return ObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ObjectsQuery(get_called_class());
    }
}
