<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "rents_parents".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_status_id
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
 * @property double $discount discaunt of price in %
 * @property double $price full price
 * @property int $currency_id
 * @property double $price_extra add extra price (etc. cleaning)
 * @property double $deposit
 * @property string $deposit_active mark if deposit is active
 * @property string $price_with_vat price has already VAT
 * @property string $price_with_city_tax prace has city tax
 * @property int $deposit_currency_id
 * @property string $paid
 * @property int $payment_method_id
 * @property string $price_date unitil what date to pay price
 * @property double $exchange exchange number for price
 * @property double $in_advance
 * @property double $in_advance_exchange
 * @property string $in_advance_paid
 * @property int $in_advance_currency_id
 * @property string $in_advance_date until what date to pay advance price
 * @property string $money_recived
 * @property string $contact_name
 * @property int $contact_type_id
 * @property string $contact_email
 * @property string $contact_tel
 * @property string $contact_adress
 * @property string $contact_city_zip
 * @property string $contact_city
 * @property int $contact_country_id
 * @property string $contact_confirm contact confirm data and rent
 * @property int $raiting
 * @property string $rating_note
 * @property int $rent_import_id
 * @property int $rent_source_id rent source ID 
 * @property string $foreign_id id from external systems
 * @property string $foreign_id_1
 * @property string $foreign_id_2
 * @property double $rent_source_provision price of provision
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
 */
class RentsParents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_parents';
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
        * @param int $rent_status_id//
        * @param int $cleaner_id// who cleans it
        * @param int $customer_id// Customer
        * @param int $item_id//
        * @param int $parent_rent_id// Parent ID , for linked reservations
        * @param string $guid//
        * @param string $type// single or group rent
        * @param string $request_for_payment// custom number for requesting for payment
        * @param int $number//
        * @param string $from_date//
        * @param string $from_time//
        * @param string $from_time_confirm// confirm time
        * @param string $until_date//
        * @param string $until_time//
        * @param string $until_time_confirm// confirm time
        * @param string $note// general note
        * @param string $note_short// general short notes
        * @param string $note_user// note for prices
        * @param string $note_cancellation_policy//
        * @param double $discount// discaunt of price in %
        * @param double $price// full price
        * @param int $currency_id//
        * @param double $price_extra// add extra price (etc. cleaning)
        * @param double $deposit//
        * @param string $deposit_active// mark if deposit is active
        * @param string $price_with_vat// price has already VAT
        * @param string $price_with_city_tax// prace has city tax
        * @param int $deposit_currency_id//
        * @param string $paid//
        * @param int $payment_method_id//
        * @param string $price_date// unitil what date to pay price
        * @param double $exchange// exchange number for price
        * @param double $in_advance//
        * @param double $in_advance_exchange//
        * @param string $in_advance_paid//
        * @param int $in_advance_currency_id//
        * @param string $in_advance_date// until what date to pay advance price
        * @param string $money_recived//
        * @param string $contact_name//
        * @param int $contact_type_id//
        * @param string $contact_email//
        * @param string $contact_tel//
        * @param string $contact_adress//
        * @param string $contact_city_zip//
        * @param string $contact_city//
        * @param int $contact_country_id//
        * @param string $contact_confirm// contact confirm data and rent
        * @param int $raiting//
        * @param string $rating_note//
        * @param int $rent_import_id//
        * @param int $rent_source_id// rent source ID 
        * @param string $foreign_id// id from external systems
        * @param string $foreign_id_1//
        * @param string $foreign_id_2//
        * @param double $rent_source_provision// price of provision
        * @param string $import_message//
        * @param string $erp_id// id from external system
        * @param string $door_pin// set or generate door pin
        * @param string $door_pin_active//
        * @param string $owner// owner
        * @param string $searchable// if it's searcable in rents table
        * @param string $active_temp// use for ical sync
        * @param string $active// active rent or not
        * @param string $opend// when was last time opend
        * @param string $confirmed_date//
        * @param string $canceled_date//
        * @param string $created//
        * @param string $changed//
        * @return RentsParents    */
    public static function create($id, $user_id, $rent_status_id, $cleaner_id, $customer_id, $item_id, $parent_rent_id, $guid, $type, $request_for_payment, $number, $from_date, $from_time, $from_time_confirm, $until_date, $until_time, $until_time_confirm, $note, $note_short, $note_user, $note_cancellation_policy, $discount, $price, $currency_id, $price_extra, $deposit, $deposit_active, $price_with_vat, $price_with_city_tax, $deposit_currency_id, $paid, $payment_method_id, $price_date, $exchange, $in_advance, $in_advance_exchange, $in_advance_paid, $in_advance_currency_id, $in_advance_date, $money_recived, $contact_name, $contact_type_id, $contact_email, $contact_tel, $contact_adress, $contact_city_zip, $contact_city, $contact_country_id, $contact_confirm, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $foreign_id_1, $foreign_id_2, $rent_source_provision, $import_message, $erp_id, $door_pin, $door_pin_active, $owner, $searchable, $active_temp, $active, $opend, $confirmed_date, $canceled_date, $created, $changed): RentsParents
    {
        $rentsParents = new static();
                $rentsParents->id = $id;
                $rentsParents->user_id = $user_id;
                $rentsParents->rent_status_id = $rent_status_id;
                $rentsParents->cleaner_id = $cleaner_id;
                $rentsParents->customer_id = $customer_id;
                $rentsParents->item_id = $item_id;
                $rentsParents->parent_rent_id = $parent_rent_id;
                $rentsParents->guid = $guid;
                $rentsParents->type = $type;
                $rentsParents->request_for_payment = $request_for_payment;
                $rentsParents->number = $number;
                $rentsParents->from_date = $from_date;
                $rentsParents->from_time = $from_time;
                $rentsParents->from_time_confirm = $from_time_confirm;
                $rentsParents->until_date = $until_date;
                $rentsParents->until_time = $until_time;
                $rentsParents->until_time_confirm = $until_time_confirm;
                $rentsParents->note = $note;
                $rentsParents->note_short = $note_short;
                $rentsParents->note_user = $note_user;
                $rentsParents->note_cancellation_policy = $note_cancellation_policy;
                $rentsParents->discount = $discount;
                $rentsParents->price = $price;
                $rentsParents->currency_id = $currency_id;
                $rentsParents->price_extra = $price_extra;
                $rentsParents->deposit = $deposit;
                $rentsParents->deposit_active = $deposit_active;
                $rentsParents->price_with_vat = $price_with_vat;
                $rentsParents->price_with_city_tax = $price_with_city_tax;
                $rentsParents->deposit_currency_id = $deposit_currency_id;
                $rentsParents->paid = $paid;
                $rentsParents->payment_method_id = $payment_method_id;
                $rentsParents->price_date = $price_date;
                $rentsParents->exchange = $exchange;
                $rentsParents->in_advance = $in_advance;
                $rentsParents->in_advance_exchange = $in_advance_exchange;
                $rentsParents->in_advance_paid = $in_advance_paid;
                $rentsParents->in_advance_currency_id = $in_advance_currency_id;
                $rentsParents->in_advance_date = $in_advance_date;
                $rentsParents->money_recived = $money_recived;
                $rentsParents->contact_name = $contact_name;
                $rentsParents->contact_type_id = $contact_type_id;
                $rentsParents->contact_email = $contact_email;
                $rentsParents->contact_tel = $contact_tel;
                $rentsParents->contact_adress = $contact_adress;
                $rentsParents->contact_city_zip = $contact_city_zip;
                $rentsParents->contact_city = $contact_city;
                $rentsParents->contact_country_id = $contact_country_id;
                $rentsParents->contact_confirm = $contact_confirm;
                $rentsParents->raiting = $raiting;
                $rentsParents->rating_note = $rating_note;
                $rentsParents->rent_import_id = $rent_import_id;
                $rentsParents->rent_source_id = $rent_source_id;
                $rentsParents->foreign_id = $foreign_id;
                $rentsParents->foreign_id_1 = $foreign_id_1;
                $rentsParents->foreign_id_2 = $foreign_id_2;
                $rentsParents->rent_source_provision = $rent_source_provision;
                $rentsParents->import_message = $import_message;
                $rentsParents->erp_id = $erp_id;
                $rentsParents->door_pin = $door_pin;
                $rentsParents->door_pin_active = $door_pin_active;
                $rentsParents->owner = $owner;
                $rentsParents->searchable = $searchable;
                $rentsParents->active_temp = $active_temp;
                $rentsParents->active = $active;
                $rentsParents->opend = $opend;
                $rentsParents->confirmed_date = $confirmed_date;
                $rentsParents->canceled_date = $canceled_date;
                $rentsParents->created = $created;
                $rentsParents->changed = $changed;
        
        return $rentsParents;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_status_id//
            * @param int $cleaner_id// who cleans it
            * @param int $customer_id// Customer
            * @param int $item_id//
            * @param int $parent_rent_id// Parent ID , for linked reservations
            * @param string $guid//
            * @param string $type// single or group rent
            * @param string $request_for_payment// custom number for requesting for payment
            * @param int $number//
            * @param string $from_date//
            * @param string $from_time//
            * @param string $from_time_confirm// confirm time
            * @param string $until_date//
            * @param string $until_time//
            * @param string $until_time_confirm// confirm time
            * @param string $note// general note
            * @param string $note_short// general short notes
            * @param string $note_user// note for prices
            * @param string $note_cancellation_policy//
            * @param double $discount// discaunt of price in %
            * @param double $price// full price
            * @param int $currency_id//
            * @param double $price_extra// add extra price (etc. cleaning)
            * @param double $deposit//
            * @param string $deposit_active// mark if deposit is active
            * @param string $price_with_vat// price has already VAT
            * @param string $price_with_city_tax// prace has city tax
            * @param int $deposit_currency_id//
            * @param string $paid//
            * @param int $payment_method_id//
            * @param string $price_date// unitil what date to pay price
            * @param double $exchange// exchange number for price
            * @param double $in_advance//
            * @param double $in_advance_exchange//
            * @param string $in_advance_paid//
            * @param int $in_advance_currency_id//
            * @param string $in_advance_date// until what date to pay advance price
            * @param string $money_recived//
            * @param string $contact_name//
            * @param int $contact_type_id//
            * @param string $contact_email//
            * @param string $contact_tel//
            * @param string $contact_adress//
            * @param string $contact_city_zip//
            * @param string $contact_city//
            * @param int $contact_country_id//
            * @param string $contact_confirm// contact confirm data and rent
            * @param int $raiting//
            * @param string $rating_note//
            * @param int $rent_import_id//
            * @param int $rent_source_id// rent source ID 
            * @param string $foreign_id// id from external systems
            * @param string $foreign_id_1//
            * @param string $foreign_id_2//
            * @param double $rent_source_provision// price of provision
            * @param string $import_message//
            * @param string $erp_id// id from external system
            * @param string $door_pin// set or generate door pin
            * @param string $door_pin_active//
            * @param string $owner// owner
            * @param string $searchable// if it's searcable in rents table
            * @param string $active_temp// use for ical sync
            * @param string $active// active rent or not
            * @param string $opend// when was last time opend
            * @param string $confirmed_date//
            * @param string $canceled_date//
            * @param string $created//
            * @param string $changed//
        * @return RentsParents    */
    public function edit($id, $user_id, $rent_status_id, $cleaner_id, $customer_id, $item_id, $parent_rent_id, $guid, $type, $request_for_payment, $number, $from_date, $from_time, $from_time_confirm, $until_date, $until_time, $until_time_confirm, $note, $note_short, $note_user, $note_cancellation_policy, $discount, $price, $currency_id, $price_extra, $deposit, $deposit_active, $price_with_vat, $price_with_city_tax, $deposit_currency_id, $paid, $payment_method_id, $price_date, $exchange, $in_advance, $in_advance_exchange, $in_advance_paid, $in_advance_currency_id, $in_advance_date, $money_recived, $contact_name, $contact_type_id, $contact_email, $contact_tel, $contact_adress, $contact_city_zip, $contact_city, $contact_country_id, $contact_confirm, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $foreign_id_1, $foreign_id_2, $rent_source_provision, $import_message, $erp_id, $door_pin, $door_pin_active, $owner, $searchable, $active_temp, $active, $opend, $confirmed_date, $canceled_date, $created, $changed): RentsParents
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_status_id = $rent_status_id;
            $this->cleaner_id = $cleaner_id;
            $this->customer_id = $customer_id;
            $this->item_id = $item_id;
            $this->parent_rent_id = $parent_rent_id;
            $this->guid = $guid;
            $this->type = $type;
            $this->request_for_payment = $request_for_payment;
            $this->number = $number;
            $this->from_date = $from_date;
            $this->from_time = $from_time;
            $this->from_time_confirm = $from_time_confirm;
            $this->until_date = $until_date;
            $this->until_time = $until_time;
            $this->until_time_confirm = $until_time_confirm;
            $this->note = $note;
            $this->note_short = $note_short;
            $this->note_user = $note_user;
            $this->note_cancellation_policy = $note_cancellation_policy;
            $this->discount = $discount;
            $this->price = $price;
            $this->currency_id = $currency_id;
            $this->price_extra = $price_extra;
            $this->deposit = $deposit;
            $this->deposit_active = $deposit_active;
            $this->price_with_vat = $price_with_vat;
            $this->price_with_city_tax = $price_with_city_tax;
            $this->deposit_currency_id = $deposit_currency_id;
            $this->paid = $paid;
            $this->payment_method_id = $payment_method_id;
            $this->price_date = $price_date;
            $this->exchange = $exchange;
            $this->in_advance = $in_advance;
            $this->in_advance_exchange = $in_advance_exchange;
            $this->in_advance_paid = $in_advance_paid;
            $this->in_advance_currency_id = $in_advance_currency_id;
            $this->in_advance_date = $in_advance_date;
            $this->money_recived = $money_recived;
            $this->contact_name = $contact_name;
            $this->contact_type_id = $contact_type_id;
            $this->contact_email = $contact_email;
            $this->contact_tel = $contact_tel;
            $this->contact_adress = $contact_adress;
            $this->contact_city_zip = $contact_city_zip;
            $this->contact_city = $contact_city;
            $this->contact_country_id = $contact_country_id;
            $this->contact_confirm = $contact_confirm;
            $this->raiting = $raiting;
            $this->rating_note = $rating_note;
            $this->rent_import_id = $rent_import_id;
            $this->rent_source_id = $rent_source_id;
            $this->foreign_id = $foreign_id;
            $this->foreign_id_1 = $foreign_id_1;
            $this->foreign_id_2 = $foreign_id_2;
            $this->rent_source_provision = $rent_source_provision;
            $this->import_message = $import_message;
            $this->erp_id = $erp_id;
            $this->door_pin = $door_pin;
            $this->door_pin_active = $door_pin_active;
            $this->owner = $owner;
            $this->searchable = $searchable;
            $this->active_temp = $active_temp;
            $this->active = $active;
            $this->opend = $opend;
            $this->confirmed_date = $confirmed_date;
            $this->canceled_date = $canceled_date;
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
            'rent_status_id' => Yii::t('app', 'Rent Status ID'),
            'cleaner_id' => Yii::t('app', 'Cleaner ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'parent_rent_id' => Yii::t('app', 'Parent Rent ID'),
            'guid' => Yii::t('app', 'Guid'),
            'type' => Yii::t('app', 'Type'),
            'request_for_payment' => Yii::t('app', 'Request For Payment'),
            'number' => Yii::t('app', 'Number'),
            'from_date' => Yii::t('app', 'From Date'),
            'from_time' => Yii::t('app', 'From Time'),
            'from_time_confirm' => Yii::t('app', 'From Time Confirm'),
            'until_date' => Yii::t('app', 'Until Date'),
            'until_time' => Yii::t('app', 'Until Time'),
            'until_time_confirm' => Yii::t('app', 'Until Time Confirm'),
            'note' => Yii::t('app', 'Note'),
            'note_short' => Yii::t('app', 'Note Short'),
            'note_user' => Yii::t('app', 'Note User'),
            'note_cancellation_policy' => Yii::t('app', 'Note Cancellation Policy'),
            'discount' => Yii::t('app', 'Discount'),
            'price' => Yii::t('app', 'Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'deposit' => Yii::t('app', 'Deposit'),
            'deposit_active' => Yii::t('app', 'Deposit Active'),
            'price_with_vat' => Yii::t('app', 'Price With Vat'),
            'price_with_city_tax' => Yii::t('app', 'Price With City Tax'),
            'deposit_currency_id' => Yii::t('app', 'Deposit Currency ID'),
            'paid' => Yii::t('app', 'Paid'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'price_date' => Yii::t('app', 'Price Date'),
            'exchange' => Yii::t('app', 'Exchange'),
            'in_advance' => Yii::t('app', 'In Advance'),
            'in_advance_exchange' => Yii::t('app', 'In Advance Exchange'),
            'in_advance_paid' => Yii::t('app', 'In Advance Paid'),
            'in_advance_currency_id' => Yii::t('app', 'In Advance Currency ID'),
            'in_advance_date' => Yii::t('app', 'In Advance Date'),
            'money_recived' => Yii::t('app', 'Money Recived'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'contact_type_id' => Yii::t('app', 'Contact Type ID'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_tel' => Yii::t('app', 'Contact Tel'),
            'contact_adress' => Yii::t('app', 'Contact Adress'),
            'contact_city_zip' => Yii::t('app', 'Contact City Zip'),
            'contact_city' => Yii::t('app', 'Contact City'),
            'contact_country_id' => Yii::t('app', 'Contact Country ID'),
            'contact_confirm' => Yii::t('app', 'Contact Confirm'),
            'raiting' => Yii::t('app', 'Raiting'),
            'rating_note' => Yii::t('app', 'Rating Note'),
            'rent_import_id' => Yii::t('app', 'Rent Import ID'),
            'rent_source_id' => Yii::t('app', 'Rent Source ID'),
            'foreign_id' => Yii::t('app', 'Foreign ID'),
            'foreign_id_1' => Yii::t('app', 'Foreign Id 1'),
            'foreign_id_2' => Yii::t('app', 'Foreign Id 2'),
            'rent_source_provision' => Yii::t('app', 'Rent Source Provision'),
            'import_message' => Yii::t('app', 'Import Message'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'door_pin' => Yii::t('app', 'Door Pin'),
            'door_pin_active' => Yii::t('app', 'Door Pin Active'),
            'owner' => Yii::t('app', 'Owner'),
            'searchable' => Yii::t('app', 'Searchable'),
            'active_temp' => Yii::t('app', 'Active Temp'),
            'active' => Yii::t('app', 'Active'),
            'opend' => Yii::t('app', 'Opend'),
            'confirmed_date' => Yii::t('app', 'Confirmed Date'),
            'canceled_date' => Yii::t('app', 'Canceled Date'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsParentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsParentsQuery(get_called_class());
    }
}
