<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "rents_old".
 *
 * @property int $id
 * @property int $object_id
 * @property int $rent_status_id
 * @property int $user_id
 * @property string $guid
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
 * @property int $deposit_currency_id
 * @property string $paid
 * @property int $payment_method_id
 * @property string $price_date unitil what date to pay price
 * @property double $exchange exchange number for price
 * @property double $in_advance
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
 * @property string $owner owner
 * @property string $active active rent or not
 * @property string $searchable if it's searcable in rents table
 * @property string $opend when was last time opend
 * @property string $created
 * @property string $changed
 */
class RentsOld extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_old';
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
        * @param int $object_id//
        * @param int $rent_status_id//
        * @param int $user_id//
        * @param string $guid//
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
        * @param int $deposit_currency_id//
        * @param string $paid//
        * @param int $payment_method_id//
        * @param string $price_date// unitil what date to pay price
        * @param double $exchange// exchange number for price
        * @param double $in_advance//
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
        * @param string $owner// owner
        * @param string $active// active rent or not
        * @param string $searchable// if it's searcable in rents table
        * @param string $opend// when was last time opend
        * @param string $created//
        * @param string $changed//
        * @return RentsOld    */
    public static function create($id, $object_id, $rent_status_id, $user_id, $guid, $request_for_payment, $number, $from_date, $from_time, $from_time_confirm, $until_date, $until_time, $until_time_confirm, $note, $note_short, $note_user, $note_cancellation_policy, $discount, $price, $currency_id, $price_extra, $deposit, $deposit_active, $deposit_currency_id, $paid, $payment_method_id, $price_date, $exchange, $in_advance, $in_advance_paid, $in_advance_currency_id, $in_advance_date, $money_recived, $contact_name, $contact_type_id, $contact_email, $contact_tel, $contact_adress, $contact_city_zip, $contact_city, $contact_country_id, $contact_confirm, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $foreign_id_1, $foreign_id_2, $rent_source_provision, $import_message, $erp_id, $owner, $active, $searchable, $opend, $created, $changed): RentsOld
    {
        $rentsOld = new static();
                $rentsOld->id = $id;
                $rentsOld->object_id = $object_id;
                $rentsOld->rent_status_id = $rent_status_id;
                $rentsOld->user_id = $user_id;
                $rentsOld->guid = $guid;
                $rentsOld->request_for_payment = $request_for_payment;
                $rentsOld->number = $number;
                $rentsOld->from_date = $from_date;
                $rentsOld->from_time = $from_time;
                $rentsOld->from_time_confirm = $from_time_confirm;
                $rentsOld->until_date = $until_date;
                $rentsOld->until_time = $until_time;
                $rentsOld->until_time_confirm = $until_time_confirm;
                $rentsOld->note = $note;
                $rentsOld->note_short = $note_short;
                $rentsOld->note_user = $note_user;
                $rentsOld->note_cancellation_policy = $note_cancellation_policy;
                $rentsOld->discount = $discount;
                $rentsOld->price = $price;
                $rentsOld->currency_id = $currency_id;
                $rentsOld->price_extra = $price_extra;
                $rentsOld->deposit = $deposit;
                $rentsOld->deposit_active = $deposit_active;
                $rentsOld->deposit_currency_id = $deposit_currency_id;
                $rentsOld->paid = $paid;
                $rentsOld->payment_method_id = $payment_method_id;
                $rentsOld->price_date = $price_date;
                $rentsOld->exchange = $exchange;
                $rentsOld->in_advance = $in_advance;
                $rentsOld->in_advance_paid = $in_advance_paid;
                $rentsOld->in_advance_currency_id = $in_advance_currency_id;
                $rentsOld->in_advance_date = $in_advance_date;
                $rentsOld->money_recived = $money_recived;
                $rentsOld->contact_name = $contact_name;
                $rentsOld->contact_type_id = $contact_type_id;
                $rentsOld->contact_email = $contact_email;
                $rentsOld->contact_tel = $contact_tel;
                $rentsOld->contact_adress = $contact_adress;
                $rentsOld->contact_city_zip = $contact_city_zip;
                $rentsOld->contact_city = $contact_city;
                $rentsOld->contact_country_id = $contact_country_id;
                $rentsOld->contact_confirm = $contact_confirm;
                $rentsOld->raiting = $raiting;
                $rentsOld->rating_note = $rating_note;
                $rentsOld->rent_import_id = $rent_import_id;
                $rentsOld->rent_source_id = $rent_source_id;
                $rentsOld->foreign_id = $foreign_id;
                $rentsOld->foreign_id_1 = $foreign_id_1;
                $rentsOld->foreign_id_2 = $foreign_id_2;
                $rentsOld->rent_source_provision = $rent_source_provision;
                $rentsOld->import_message = $import_message;
                $rentsOld->erp_id = $erp_id;
                $rentsOld->owner = $owner;
                $rentsOld->active = $active;
                $rentsOld->searchable = $searchable;
                $rentsOld->opend = $opend;
                $rentsOld->created = $created;
                $rentsOld->changed = $changed;
        
        return $rentsOld;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $rent_status_id//
            * @param int $user_id//
            * @param string $guid//
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
            * @param int $deposit_currency_id//
            * @param string $paid//
            * @param int $payment_method_id//
            * @param string $price_date// unitil what date to pay price
            * @param double $exchange// exchange number for price
            * @param double $in_advance//
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
            * @param string $owner// owner
            * @param string $active// active rent or not
            * @param string $searchable// if it's searcable in rents table
            * @param string $opend// when was last time opend
            * @param string $created//
            * @param string $changed//
        * @return RentsOld    */
    public function edit($id, $object_id, $rent_status_id, $user_id, $guid, $request_for_payment, $number, $from_date, $from_time, $from_time_confirm, $until_date, $until_time, $until_time_confirm, $note, $note_short, $note_user, $note_cancellation_policy, $discount, $price, $currency_id, $price_extra, $deposit, $deposit_active, $deposit_currency_id, $paid, $payment_method_id, $price_date, $exchange, $in_advance, $in_advance_paid, $in_advance_currency_id, $in_advance_date, $money_recived, $contact_name, $contact_type_id, $contact_email, $contact_tel, $contact_adress, $contact_city_zip, $contact_city, $contact_country_id, $contact_confirm, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $foreign_id_1, $foreign_id_2, $rent_source_provision, $import_message, $erp_id, $owner, $active, $searchable, $opend, $created, $changed): RentsOld
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->rent_status_id = $rent_status_id;
            $this->user_id = $user_id;
            $this->guid = $guid;
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
            $this->deposit_currency_id = $deposit_currency_id;
            $this->paid = $paid;
            $this->payment_method_id = $payment_method_id;
            $this->price_date = $price_date;
            $this->exchange = $exchange;
            $this->in_advance = $in_advance;
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
            $this->owner = $owner;
            $this->active = $active;
            $this->searchable = $searchable;
            $this->opend = $opend;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'rent_status_id' => Yii::t('app', 'Rent Status ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'guid' => Yii::t('app', 'Guid'),
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
            'deposit_currency_id' => Yii::t('app', 'Deposit Currency ID'),
            'paid' => Yii::t('app', 'Paid'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'price_date' => Yii::t('app', 'Price Date'),
            'exchange' => Yii::t('app', 'Exchange'),
            'in_advance' => Yii::t('app', 'In Advance'),
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
            'owner' => Yii::t('app', 'Owner'),
            'active' => Yii::t('app', 'Active'),
            'searchable' => Yii::t('app', 'Searchable'),
            'opend' => Yii::t('app', 'Opend'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsOldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsOldQuery(get_called_class());
    }
}
