<?php

namespace myrent\models;

use function strtotime;
use Yii;

/**
 * This is the model class for table "rents".
 *
 * @property int $id
 * @property int $object_id
 * @property int $rent_status_id
 * @property int $user_id
 * @property int $cleaner_id who cleans it
 * @property int $customer_id Customer
 * @property int $item_id
 * @property int $parent_rent_id Parent ID , for linked reservations
 * @property string $guid
 * @property string $type single or group rent
 * @property string $request_for_payment custom number for requesting for payment
 * @property int $number
 * @property string $from_date
 * @property string $from_time
 * @property string $from_time_confirm confirm time
 * @property string $until_date
 * @property string $until_time
 * @property string $until_time_confirm confirm time
 * @property string $note general note
 * @property string $note_short general short notes
 * @property string $note_user note for prices
 * @property string $note_cancellation_policy
 * @property double $discount discount of price in %
 * @property double $price full price
 * @property int $currency_id
 * @property double $price_extra add extra price (etc. cleaning)
 * @property double $price_netto netto price (price from owner)
 * @property double $deposit price of deposit
 * @property double $rent_source_provision price of provision or commision
 * @property int $deposit_currency_id
 * @property string $deposit_active mark if deposit is active
 * @property string $price_with_vat price has already VAT
 * @property string $price_with_city_tax prace has city tax
 * @property string $paid if rent is paid
 * @property string $money_recived if we recive money
 * @property string $in_advance_paid if advne is paid
 * @property int $payment_method_id
 * @property string $price_date unitil what date to pay price
 * @property double $exchange exchange number for price
 * @property double $in_advance price for advance payment
 * @property double $in_advance_exchange
 * @property double $price_neto price neto getting from owners
 * @property double $price_neto_exchange
 * @property int $price_neto_currency_id
 * @property int $in_advance_currency_id
 * @property string $in_advance_date until what date to pay advance price
 * @property string $contact_name
 * @property int $contact_type_id
 * @property string $contact_email
 * @property string $contact_tel
 * @property string $contact_adress
 * @property string $contact_city_zip
 * @property string $contact_city
 * @property int $contact_country_id
 * @property string $confirm_datetime when is confirmed
 * @property string $contact_confirm contact confirm data and rent
 * @property string $valid_date until what date reservation is valid
 * @property string $valid_time until what time reservation is valid
 * @property int $raiting
 * @property string $rating_note
 * @property int $rent_import_id
 * @property int $rent_source_id rent source ID 
 * @property string $foreign_id id from external systems
 * @property string $foreign_id_1
 * @property string $foreign_id_2
 * @property string $import_message
 * @property string $erp_id id from external system
 * @property string $door_pin set or generate door pin
 * @property string $door_pin_active
 * @property string $owner owner
 * @property string $searchable if it's searcable in rents table
 * @property string $active_temp use for ical sync
 * @property string $active active rent or not
 * @property string $opend when was last time opend
 * @property string $confirmed_date
 * @property string $canceled_date
 * @property string $created
 * @property string $changed
 *
 * @property Guests[] $guests
 * @property Objects $object
 * @property Cleaners $cleaner
 * @property Currency $currency
 * @property Currency $inAdvanceCurrency
 * @property Customers $customer
 * @property Items $item
 * @property Rents $parentRent
 * @property Rents[] $rents
 */
class Rents extends \yii\db\ActiveRecord
{
     public const STATUS_ACTIVE  = 10;
     public const STATUS_CANCELLED = 20;
     public const STATUS_REGISTERED = 30;
     public const STATUS_WARNING = 40;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rents';
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
            [['object_id', 'user_id'], 'required'],
            [['object_id', 'rent_status_id', 'user_id', 'cleaner_id', 'customer_id', 'item_id', 'parent_rent_id', 'number', 'currency_id', 'deposit_currency_id', 'payment_method_id', 'price_neto_currency_id', 'in_advance_currency_id', 'contact_type_id', 'contact_country_id', 'raiting', 'rent_import_id', 'rent_source_id'], 'integer'],
            [['type', 'from_time_confirm', 'until_time_confirm', 'note', 'note_user', 'note_cancellation_policy', 'deposit_active', 'price_with_vat', 'price_with_city_tax', 'paid', 'money_recived', 'in_advance_paid', 'contact_confirm', 'rating_note', 'import_message', 'door_pin_active', 'owner', 'searchable', 'active_temp', 'active'], 'string'],
            [['from_date', 'from_time', 'until_date', 'until_time', 'price_date', 'in_advance_date', 'confirm_datetime', 'valid_date', 'valid_time', 'opend', 'confirmed_date', 'canceled_date', 'created', 'changed'], 'safe'],
            [['discount', 'price', 'price_extra', 'price_netto', 'deposit', 'rent_source_provision', 'exchange', 'in_advance', 'in_advance_exchange', 'price_neto', 'price_neto_exchange'], 'number'],
            [['guid', 'request_for_payment', 'door_pin'], 'string', 'max' => 50],
            [['note_short'], 'string', 'max' => 255],
            [['contact_name', 'contact_email', 'contact_tel', 'contact_adress', 'contact_city_zip', 'contact_city', 'foreign_id', 'foreign_id_1', 'foreign_id_2', 'erp_id'], 'string', 'max' => 100],
            [['guid'], 'unique'],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['object_id' => 'id']],
            [['cleaner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cleaners::className(), 'targetAttribute' => ['cleaner_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['in_advance_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['in_advance_currency_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['parent_rent_id'], 'exist', 'skipOnError' => true, 'targetClass' =>  Rents::className(), 'targetAttribute' => ['parent_rent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'rent_status_id' => 'Rent Status ID',
            'user_id' => 'User ID',
            'cleaner_id' => 'Cleaner ID',
            'customer_id' => 'Customer ID',
            'item_id' => 'Item ID',
            'parent_rent_id' => 'Parent Rent ID',
            'guid' => 'Guid',
            'type' => 'Type',
            'request_for_payment' => 'Request For Payment',
            'number' => 'Number',
            'from_date' => 'From Date',
            'from_time' => 'From Time',
            'from_time_confirm' => 'From Time Confirm',
            'until_date' => 'Until Date',
            'until_time' => 'Until Time',
            'until_time_confirm' => 'Until Time Confirm',
            'note' => 'Note',
            'note_short' => 'Note Short',
            'note_user' => 'Note User',
            'note_cancellation_policy' => 'Note Cancellation Policy',
            'discount' => 'Discount',
            'price' => 'Price',
            'currency_id' => 'Currency ID',
            'price_extra' => 'Price Extra',
            'price_netto' => 'Price Netto',
            'deposit' => 'Deposit',
            'rent_source_provision' => 'Rent Source Provision',
            'deposit_currency_id' => 'Deposit Currency ID',
            'deposit_active' => 'Deposit Active',
            'price_with_vat' => 'Price With Vat',
            'price_with_city_tax' => 'Price With City Tax',
            'paid' => 'Paid',
            'money_recived' => 'Money Recived',
            'in_advance_paid' => 'In Advance Paid',
            'payment_method_id' => 'Payment Method ID',
            'price_date' => 'Price Date',
            'exchange' => 'Exchange',
            'in_advance' => 'In Advance',
            'in_advance_exchange' => 'In Advance Exchange',
            'price_neto' => 'Price Neto',
            'price_neto_exchange' => 'Price Neto Exchange',
            'price_neto_currency_id' => 'Price Neto Currency ID',
            'in_advance_currency_id' => 'In Advance Currency ID',
            'in_advance_date' => 'In Advance Date',
            'contact_name' => 'Contact Name',
            'contact_type_id' => 'Contact Type ID',
            'contact_email' => 'Contact Email',
            'contact_tel' => 'Contact Tel',
            'contact_adress' => 'Contact Adress',
            'contact_city_zip' => 'Contact City Zip',
            'contact_city' => 'Contact City',
            'contact_country_id' => 'Contact Country ID',
            'confirm_datetime' => 'Confirm Datetime',
            'contact_confirm' => 'Contact Confirm',
            'valid_date' => 'Valid Date',
            'valid_time' => 'Valid Time',
            'raiting' => 'Raiting',
            'rating_note' => 'Rating Note',
            'rent_import_id' => 'Rent Import ID',
            'rent_source_id' => 'Rent Source ID',
            'foreign_id' => 'Foreign ID',
            'foreign_id_1' => 'Foreign Id 1',
            'foreign_id_2' => 'Foreign Id 2',
            'import_message' => 'Import Message',
            'erp_id' => 'Erp ID',
            'door_pin' => 'Door Pin',
            'door_pin_active' => 'Door Pin Active',
            'owner' => 'Owner',
            'searchable' => 'Searchable',
            'active_temp' => 'Active Temp',
            'active' => 'Active',
            'opend' => 'Opend',
            'confirmed_date' => 'Confirmed Date',
            'canceled_date' => 'Canceled Date',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    public function getNights(){
        return (integer)((strtotime ($this->until_date) - strtotime($this->from_date))/24/60/60);
    }
    
    public function getDaysBefore(){
        return ((strtotime ($this->until_date) - time())>0)? (integer)((strtotime ($this->until_date) - time() )/24/60/60) ." days" : "" ;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(Guests::className(), ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::className(), ['id' => 'object_id']);
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
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInAdvanceCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'in_advance_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentRent()
    {
        return $this->hasOne(Rents::className(), ['id' => 'parent_rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsStatus()
    {
        return $this->hasOne(RentsStatus::className(), ['id' => 'rent_status_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'contact_country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsSources()
    {
        return $this->hasOne(RentsSources::className(), ['id' => 'rent_source_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['parent_rent_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MyRentUsers::className(), ['id' => 'user_id']);
    }

    public function getReception(){
        return $this->object->user_id;
    }
    /**
     * @inheritdoc
     * @return RentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RentsQuery(get_called_class());
    }
}
