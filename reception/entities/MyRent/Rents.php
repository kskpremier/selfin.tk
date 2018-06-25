<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\FriendsRents;
use reception\entities\MyRent\Guests;
use reception\entities\MyRent\GuestsCityTaxes;
use reception\entities\MyRent\GuestsImports;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\InvoicesItems;
use reception\entities\MyRent\LogB2bs;
use reception\entities\MyRent\LogRentsCards;
use reception\entities\MyRent\Messages;
use reception\entities\MyRent\ObjectsDistances;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Cleaner;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\InAdvanceCurrency;
use reception\entities\MyRent\Customer;
use reception\entities\MyRent\Item;
use reception\entities\MyRent\PaymentMethod;
use reception\entities\MyRent\ParentRent;
use reception\entities\MyRent\RentSource;
use reception\entities\MyRent\RentStatus;
use reception\entities\MyRent\User;
use reception\entities\MyRent\RentsApartments;
use reception\entities\MyRent\RentsB2bs;
use reception\entities\MyRent\RentsCards;
use reception\entities\MyRent\RentsCleanings;
use reception\entities\MyRent\RentsDocuments;
use reception\entities\MyRent\RentsDoorsLocks;
use reception\entities\MyRent\RentsEmailsLogs;
use reception\entities\MyRent\RentsGroupsRents;
use reception\entities\MyRent\RentsImports;
use reception\entities\MyRent\RentsItems;
use reception\entities\MyRent\RentsLogs;
use reception\entities\MyRent\RentsOffers;
use reception\entities\MyRent\RentsPricesDays;
use reception\entities\MyRent\RentsWorkersLogs;
use reception\entities\MyRent\Reviews;
use reception\entities\MyRent\Treasuries;

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
 * @property int $language_id language of the guests
 * @property string $guid
 * @property string $type single or group rent
 * @property string $confirm status if reservation is confirmed
 * @property string $check_in status for check in
 * @property string $check_out status for check out
 * @property string $request_for_payment custom number for requesting for payment
 * @property string $request_for_payment_grp custom grpoup number for requesting for payment
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
 * @property string $note_cards
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
 * @property string $foreign_id_1 secondery (maser reservation)
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
 * @property string $rent_changed when rent was changed
 * @property string $confirmed_date
 * @property string $canceled_date
 * @property string $created
 * @property string $changed
 *
 * @property FriendsRents[] $friendsRents
 * @property Guests[] $guests
 * @property GuestsCityTaxes[] $guestsCityTaxes
 * @property GuestsImport[] $guestsImports
 * @property InvoicesHeader[] $invoicesHeaders
 * @property InvoicesItems[] $invoicesItems
 * @property LogB2b[] $logB2bs
 * @property LogRentsCards[] $logRentsCards
 * @property Messages[] $messages
 * @property ObjectsDistances[] $objectsDistances
 * @property PaymentsRecive[] $paymentsRecives
 * @property Objects $object
 * @property Cleaners $cleaner
 * @property Currency $currency
 * @property Currency $inAdvanceCurrency
 * @property Customers $customer
 * @property Items $item
 * @property PaymentMethods $paymentMethod
 * @property Rents $parentRent
 * @property Rents[] $rents
 * @property RentsSources $rentSource
 * @property RentsStatus $rentStatus
 * @property Users $user
 * @property RentsApartments[] $rentsApartments
 * @property RentsB2b[] $rentsB2bs
 * @property RentsCards[] $rentsCards
 * @property RentsCleaning[] $rentsCleanings
 * @property RentsDocuments[] $rentsDocuments
 * @property RentsDoorsLocks[] $rentsDoorsLocks
 * @property RentsEmailsLog[] $rentsEmailsLogs
 * @property RentsGroupsRents[] $rentsGroupsRents
 * @property RentsImports[] $rentsImports
 * @property RentsItems[] $rentsItems
 * @property RentsLog[] $rentsLogs
 * @property RentsOffers[] $rentsOffers
 * @property RentsPricesDays[] $rentsPricesDays
 * @property RentsWorkersLog[] $rentsWorkersLogs
 * @property Reviews[] $reviews
 * @property Treasury[] $treasuries
 */
class Rents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $object_id//
        * @param int $rent_status_id//
        * @param int $user_id//
        * @param int $cleaner_id// who cleans it
        * @param int $customer_id// Customer
        * @param int $item_id//
        * @param int $parent_rent_id// Parent ID , for linked reservations
        * @param int $language_id// language of the guests
        * @param string $guid//
        * @param string $type// single or group rent
        * @param string $confirm// status if reservation is confirmed
        * @param string $check_in// status for check in
        * @param string $check_out// status for check out
        * @param string $request_for_payment// custom number for requesting for payment
        * @param string $request_for_payment_grp// custom grpoup number for requesting for payment
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
        * @param string $note_cards//
        * @param double $discount// discount of price in %
        * @param double $price// full price
        * @param int $currency_id//
        * @param double $price_extra// add extra price (etc. cleaning)
        * @param double $price_netto// netto price (price from owner)
        * @param double $deposit// price of deposit
        * @param double $rent_source_provision// price of provision or commision
        * @param int $deposit_currency_id//
        * @param string $deposit_active// mark if deposit is active
        * @param string $price_with_vat// price has already VAT
        * @param string $price_with_city_tax// prace has city tax
        * @param string $paid// if rent is paid
        * @param string $money_recived// if we recive money
        * @param string $in_advance_paid// if advne is paid
        * @param int $payment_method_id//
        * @param string $price_date// unitil what date to pay price
        * @param double $exchange// exchange number for price
        * @param double $in_advance// price for advance payment
        * @param double $in_advance_exchange//
        * @param double $price_neto// price neto getting from owners
        * @param double $price_neto_exchange//
        * @param int $price_neto_currency_id//
        * @param int $in_advance_currency_id//
        * @param string $in_advance_date// until what date to pay advance price
        * @param string $contact_name//
        * @param int $contact_type_id//
        * @param string $contact_email//
        * @param string $contact_tel//
        * @param string $contact_adress//
        * @param string $contact_city_zip//
        * @param string $contact_city//
        * @param int $contact_country_id//
        * @param string $confirm_datetime// when is confirmed
        * @param string $contact_confirm// contact confirm data and rent
        * @param string $valid_date// until what date reservation is valid
        * @param string $valid_time// until what time reservation is valid
        * @param int $raiting//
        * @param string $rating_note//
        * @param int $rent_import_id//
        * @param int $rent_source_id// rent source ID 
        * @param string $foreign_id// id from external systems
        * @param string $foreign_id_1// secondery (maser reservation)
        * @param string $foreign_id_2//
        * @param string $import_message//
        * @param string $erp_id// id from external system
        * @param string $door_pin// set or generate door pin
        * @param string $door_pin_active//
        * @param string $owner// owner
        * @param string $searchable// if it's searcable in rents table
        * @param string $active_temp// use for ical sync
        * @param string $active// active rent or not
        * @param string $opend// when was last time opend
        * @param string $rent_changed// when rent was changed
        * @param string $confirmed_date//
        * @param string $canceled_date//
        * @param string $created//
        * @param string $changed//
        * @return Rents    */
    public static function create($id, $object_id, $rent_status_id, $user_id, $cleaner_id, $customer_id, $item_id, $parent_rent_id, $language_id, $guid, $type, $confirm, $check_in, $check_out, $request_for_payment, $request_for_payment_grp, $number, $from_date, $from_time, $from_time_confirm, $until_date, $until_time, $until_time_confirm, $note, $note_short, $note_user, $note_cancellation_policy, $note_cards, $discount, $price, $currency_id, $price_extra, $price_netto, $deposit, $rent_source_provision, $deposit_currency_id, $deposit_active, $price_with_vat, $price_with_city_tax, $paid, $money_recived, $in_advance_paid, $payment_method_id, $price_date, $exchange, $in_advance, $in_advance_exchange, $price_neto, $price_neto_exchange, $price_neto_currency_id, $in_advance_currency_id, $in_advance_date, $contact_name, $contact_type_id, $contact_email, $contact_tel, $contact_adress, $contact_city_zip, $contact_city, $contact_country_id, $confirm_datetime, $contact_confirm, $valid_date, $valid_time, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $foreign_id_1, $foreign_id_2, $import_message, $erp_id, $door_pin, $door_pin_active, $owner, $searchable, $active_temp, $active, $opend, $rent_changed, $confirmed_date, $canceled_date, $created, $changed): Rents
    {
        $rents = new static();
                $rents->id = $id;
                $rents->object_id = $object_id;
                $rents->rent_status_id = $rent_status_id;
                $rents->user_id = $user_id;
                $rents->cleaner_id = $cleaner_id;
                $rents->customer_id = $customer_id;
                $rents->item_id = $item_id;
                $rents->parent_rent_id = $parent_rent_id;
                $rents->language_id = $language_id;
                $rents->guid = $guid;
                $rents->type = $type;
                $rents->confirm = $confirm;
                $rents->check_in = $check_in;
                $rents->check_out = $check_out;
                $rents->request_for_payment = $request_for_payment;
                $rents->request_for_payment_grp = $request_for_payment_grp;
                $rents->number = $number;
                $rents->from_date = $from_date;
                $rents->from_time = $from_time;
                $rents->from_time_confirm = $from_time_confirm;
                $rents->until_date = $until_date;
                $rents->until_time = $until_time;
                $rents->until_time_confirm = $until_time_confirm;
                $rents->note = $note;
                $rents->note_short = $note_short;
                $rents->note_user = $note_user;
                $rents->note_cancellation_policy = $note_cancellation_policy;
                $rents->note_cards = $note_cards;
                $rents->discount = $discount;
                $rents->price = $price;
                $rents->currency_id = $currency_id;
                $rents->price_extra = $price_extra;
                $rents->price_netto = $price_netto;
                $rents->deposit = $deposit;
                $rents->rent_source_provision = $rent_source_provision;
                $rents->deposit_currency_id = $deposit_currency_id;
                $rents->deposit_active = $deposit_active;
                $rents->price_with_vat = $price_with_vat;
                $rents->price_with_city_tax = $price_with_city_tax;
                $rents->paid = $paid;
                $rents->money_recived = $money_recived;
                $rents->in_advance_paid = $in_advance_paid;
                $rents->payment_method_id = $payment_method_id;
                $rents->price_date = $price_date;
                $rents->exchange = $exchange;
                $rents->in_advance = $in_advance;
                $rents->in_advance_exchange = $in_advance_exchange;
                $rents->price_neto = $price_neto;
                $rents->price_neto_exchange = $price_neto_exchange;
                $rents->price_neto_currency_id = $price_neto_currency_id;
                $rents->in_advance_currency_id = $in_advance_currency_id;
                $rents->in_advance_date = $in_advance_date;
                $rents->contact_name = $contact_name;
                $rents->contact_type_id = $contact_type_id;
                $rents->contact_email = $contact_email;
                $rents->contact_tel = $contact_tel;
                $rents->contact_adress = $contact_adress;
                $rents->contact_city_zip = $contact_city_zip;
                $rents->contact_city = $contact_city;
                $rents->contact_country_id = $contact_country_id;
                $rents->confirm_datetime = $confirm_datetime;
                $rents->contact_confirm = $contact_confirm;
                $rents->valid_date = $valid_date;
                $rents->valid_time = $valid_time;
                $rents->raiting = $raiting;
                $rents->rating_note = $rating_note;
                $rents->rent_import_id = $rent_import_id;
                $rents->rent_source_id = $rent_source_id;
                $rents->foreign_id = $foreign_id;
                $rents->foreign_id_1 = $foreign_id_1;
                $rents->foreign_id_2 = $foreign_id_2;
                $rents->import_message = $import_message;
                $rents->erp_id = $erp_id;
                $rents->door_pin = $door_pin;
                $rents->door_pin_active = $door_pin_active;
                $rents->owner = $owner;
                $rents->searchable = $searchable;
                $rents->active_temp = $active_temp;
                $rents->active = $active;
                $rents->opend = $opend;
                $rents->rent_changed = $rent_changed;
                $rents->confirmed_date = $confirmed_date;
                $rents->canceled_date = $canceled_date;
                $rents->created = $created;
                $rents->changed = $changed;
        
        return $rents;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $rent_status_id//
            * @param int $user_id//
            * @param int $cleaner_id// who cleans it
            * @param int $customer_id// Customer
            * @param int $item_id//
            * @param int $parent_rent_id// Parent ID , for linked reservations
            * @param int $language_id// language of the guests
            * @param string $guid//
            * @param string $type// single or group rent
            * @param string $confirm// status if reservation is confirmed
            * @param string $check_in// status for check in
            * @param string $check_out// status for check out
            * @param string $request_for_payment// custom number for requesting for payment
            * @param string $request_for_payment_grp// custom grpoup number for requesting for payment
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
            * @param string $note_cards//
            * @param double $discount// discount of price in %
            * @param double $price// full price
            * @param int $currency_id//
            * @param double $price_extra// add extra price (etc. cleaning)
            * @param double $price_netto// netto price (price from owner)
            * @param double $deposit// price of deposit
            * @param double $rent_source_provision// price of provision or commision
            * @param int $deposit_currency_id//
            * @param string $deposit_active// mark if deposit is active
            * @param string $price_with_vat// price has already VAT
            * @param string $price_with_city_tax// prace has city tax
            * @param string $paid// if rent is paid
            * @param string $money_recived// if we recive money
            * @param string $in_advance_paid// if advne is paid
            * @param int $payment_method_id//
            * @param string $price_date// unitil what date to pay price
            * @param double $exchange// exchange number for price
            * @param double $in_advance// price for advance payment
            * @param double $in_advance_exchange//
            * @param double $price_neto// price neto getting from owners
            * @param double $price_neto_exchange//
            * @param int $price_neto_currency_id//
            * @param int $in_advance_currency_id//
            * @param string $in_advance_date// until what date to pay advance price
            * @param string $contact_name//
            * @param int $contact_type_id//
            * @param string $contact_email//
            * @param string $contact_tel//
            * @param string $contact_adress//
            * @param string $contact_city_zip//
            * @param string $contact_city//
            * @param int $contact_country_id//
            * @param string $confirm_datetime// when is confirmed
            * @param string $contact_confirm// contact confirm data and rent
            * @param string $valid_date// until what date reservation is valid
            * @param string $valid_time// until what time reservation is valid
            * @param int $raiting//
            * @param string $rating_note//
            * @param int $rent_import_id//
            * @param int $rent_source_id// rent source ID 
            * @param string $foreign_id// id from external systems
            * @param string $foreign_id_1// secondery (maser reservation)
            * @param string $foreign_id_2//
            * @param string $import_message//
            * @param string $erp_id// id from external system
            * @param string $door_pin// set or generate door pin
            * @param string $door_pin_active//
            * @param string $owner// owner
            * @param string $searchable// if it's searcable in rents table
            * @param string $active_temp// use for ical sync
            * @param string $active// active rent or not
            * @param string $opend// when was last time opend
            * @param string $rent_changed// when rent was changed
            * @param string $confirmed_date//
            * @param string $canceled_date//
            * @param string $created//
            * @param string $changed//
        * @return Rents    */
    public function edit($id, $object_id, $rent_status_id, $user_id, $cleaner_id, $customer_id, $item_id, $parent_rent_id, $language_id, $guid, $type, $confirm, $check_in, $check_out, $request_for_payment, $request_for_payment_grp, $number, $from_date, $from_time, $from_time_confirm, $until_date, $until_time, $until_time_confirm, $note, $note_short, $note_user, $note_cancellation_policy, $note_cards, $discount, $price, $currency_id, $price_extra, $price_netto, $deposit, $rent_source_provision, $deposit_currency_id, $deposit_active, $price_with_vat, $price_with_city_tax, $paid, $money_recived, $in_advance_paid, $payment_method_id, $price_date, $exchange, $in_advance, $in_advance_exchange, $price_neto, $price_neto_exchange, $price_neto_currency_id, $in_advance_currency_id, $in_advance_date, $contact_name, $contact_type_id, $contact_email, $contact_tel, $contact_adress, $contact_city_zip, $contact_city, $contact_country_id, $confirm_datetime, $contact_confirm, $valid_date, $valid_time, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $foreign_id_1, $foreign_id_2, $import_message, $erp_id, $door_pin, $door_pin_active, $owner, $searchable, $active_temp, $active, $opend, $rent_changed, $confirmed_date, $canceled_date, $created, $changed): Rents
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->rent_status_id = $rent_status_id;
            $this->user_id = $user_id;
            $this->cleaner_id = $cleaner_id;
            $this->customer_id = $customer_id;
            $this->item_id = $item_id;
            $this->parent_rent_id = $parent_rent_id;
            $this->language_id = $language_id;
            $this->guid = $guid;
            $this->type = $type;
            $this->confirm = $confirm;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->request_for_payment = $request_for_payment;
            $this->request_for_payment_grp = $request_for_payment_grp;
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
            $this->note_cards = $note_cards;
            $this->discount = $discount;
            $this->price = $price;
            $this->currency_id = $currency_id;
            $this->price_extra = $price_extra;
            $this->price_netto = $price_netto;
            $this->deposit = $deposit;
            $this->rent_source_provision = $rent_source_provision;
            $this->deposit_currency_id = $deposit_currency_id;
            $this->deposit_active = $deposit_active;
            $this->price_with_vat = $price_with_vat;
            $this->price_with_city_tax = $price_with_city_tax;
            $this->paid = $paid;
            $this->money_recived = $money_recived;
            $this->in_advance_paid = $in_advance_paid;
            $this->payment_method_id = $payment_method_id;
            $this->price_date = $price_date;
            $this->exchange = $exchange;
            $this->in_advance = $in_advance;
            $this->in_advance_exchange = $in_advance_exchange;
            $this->price_neto = $price_neto;
            $this->price_neto_exchange = $price_neto_exchange;
            $this->price_neto_currency_id = $price_neto_currency_id;
            $this->in_advance_currency_id = $in_advance_currency_id;
            $this->in_advance_date = $in_advance_date;
            $this->contact_name = $contact_name;
            $this->contact_type_id = $contact_type_id;
            $this->contact_email = $contact_email;
            $this->contact_tel = $contact_tel;
            $this->contact_adress = $contact_adress;
            $this->contact_city_zip = $contact_city_zip;
            $this->contact_city = $contact_city;
            $this->contact_country_id = $contact_country_id;
            $this->confirm_datetime = $confirm_datetime;
            $this->contact_confirm = $contact_confirm;
            $this->valid_date = $valid_date;
            $this->valid_time = $valid_time;
            $this->raiting = $raiting;
            $this->rating_note = $rating_note;
            $this->rent_import_id = $rent_import_id;
            $this->rent_source_id = $rent_source_id;
            $this->foreign_id = $foreign_id;
            $this->foreign_id_1 = $foreign_id_1;
            $this->foreign_id_2 = $foreign_id_2;
            $this->import_message = $import_message;
            $this->erp_id = $erp_id;
            $this->door_pin = $door_pin;
            $this->door_pin_active = $door_pin_active;
            $this->owner = $owner;
            $this->searchable = $searchable;
            $this->active_temp = $active_temp;
            $this->active = $active;
            $this->opend = $opend;
            $this->rent_changed = $rent_changed;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'rent_status_id' => Yii::t('app', 'Rent Status ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'cleaner_id' => Yii::t('app', 'Cleaner ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'parent_rent_id' => Yii::t('app', 'Parent Rent ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'guid' => Yii::t('app', 'Guid'),
            'type' => Yii::t('app', 'Type'),
            'confirm' => Yii::t('app', 'Confirm'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'request_for_payment' => Yii::t('app', 'Request For Payment'),
            'request_for_payment_grp' => Yii::t('app', 'Request For Payment Grp'),
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
            'note_cards' => Yii::t('app', 'Note Cards'),
            'discount' => Yii::t('app', 'Discount'),
            'price' => Yii::t('app', 'Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'price_extra' => Yii::t('app', 'Price Extra'),
            'price_netto' => Yii::t('app', 'Price Netto'),
            'deposit' => Yii::t('app', 'Deposit'),
            'rent_source_provision' => Yii::t('app', 'Rent Source Provision'),
            'deposit_currency_id' => Yii::t('app', 'Deposit Currency ID'),
            'deposit_active' => Yii::t('app', 'Deposit Active'),
            'price_with_vat' => Yii::t('app', 'Price With Vat'),
            'price_with_city_tax' => Yii::t('app', 'Price With City Tax'),
            'paid' => Yii::t('app', 'Paid'),
            'money_recived' => Yii::t('app', 'Money Recived'),
            'in_advance_paid' => Yii::t('app', 'In Advance Paid'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'price_date' => Yii::t('app', 'Price Date'),
            'exchange' => Yii::t('app', 'Exchange'),
            'in_advance' => Yii::t('app', 'In Advance'),
            'in_advance_exchange' => Yii::t('app', 'In Advance Exchange'),
            'price_neto' => Yii::t('app', 'Price Neto'),
            'price_neto_exchange' => Yii::t('app', 'Price Neto Exchange'),
            'price_neto_currency_id' => Yii::t('app', 'Price Neto Currency ID'),
            'in_advance_currency_id' => Yii::t('app', 'In Advance Currency ID'),
            'in_advance_date' => Yii::t('app', 'In Advance Date'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'contact_type_id' => Yii::t('app', 'Contact Type ID'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_tel' => Yii::t('app', 'Contact Tel'),
            'contact_adress' => Yii::t('app', 'Contact Adress'),
            'contact_city_zip' => Yii::t('app', 'Contact City Zip'),
            'contact_city' => Yii::t('app', 'Contact City'),
            'contact_country_id' => Yii::t('app', 'Contact Country ID'),
            'confirm_datetime' => Yii::t('app', 'Confirm Datetime'),
            'contact_confirm' => Yii::t('app', 'Contact Confirm'),
            'valid_date' => Yii::t('app', 'Valid Date'),
            'valid_time' => Yii::t('app', 'Valid Time'),
            'raiting' => Yii::t('app', 'Raiting'),
            'rating_note' => Yii::t('app', 'Rating Note'),
            'rent_import_id' => Yii::t('app', 'Rent Import ID'),
            'rent_source_id' => Yii::t('app', 'Rent Source ID'),
            'foreign_id' => Yii::t('app', 'Foreign ID'),
            'foreign_id_1' => Yii::t('app', 'Foreign Id 1'),
            'foreign_id_2' => Yii::t('app', 'Foreign Id 2'),
            'import_message' => Yii::t('app', 'Import Message'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'door_pin' => Yii::t('app', 'Door Pin'),
            'door_pin_active' => Yii::t('app', 'Door Pin Active'),
            'owner' => Yii::t('app', 'Owner'),
            'searchable' => Yii::t('app', 'Searchable'),
            'active_temp' => Yii::t('app', 'Active Temp'),
            'active' => Yii::t('app', 'Active'),
            'opend' => Yii::t('app', 'Opend'),
            'rent_changed' => Yii::t('app', 'Rent Changed'),
            'confirmed_date' => Yii::t('app', 'Confirmed Date'),
            'canceled_date' => Yii::t('app', 'Canceled Date'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriendsRents()
    {
        return $this->hasMany(FriendsRents::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(Guests::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'contact_country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsCityTaxes()
    {
        return $this->hasMany(GuestsCityTaxes::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsImports()
    {
        return $this->hasMany(GuestsImport::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems()
    {
        return $this->hasMany(InvoicesItems::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogB2bs()
    {
        return $this->hasMany(LogB2b::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogRentsCards()
    {
        return $this->hasMany(LogRentsCards::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistances()
    {
        return $this->hasMany(ObjectsDistances::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['rent_id' => 'id']);
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
    public function getCleaner()
    {
        return $this->hasOne(Cleaners::class, ['id' => 'cleaner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInAdvanceCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'in_advance_currency_id']);
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
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethods::class, ['id' => 'payment_method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'parent_rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['parent_rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentSource()
    {
        return $this->hasOne(RentsSources::class, ['id' => 'rent_source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentStatus()
    {
        return $this->hasOne(RentsStatus::class, ['id' => 'rent_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsApartments()
    {
        return $this->hasMany(RentsApartments::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsB2bs()
    {
        return $this->hasMany(RentsB2b::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsCards()
    {
        return $this->hasMany(RentsCards::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsCleanings()
    {
        return $this->hasMany(RentsCleaning::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsDocuments()
    {
        return $this->hasMany(RentsDocuments::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsDoorsLocks()
    {
        return $this->hasMany(RentsDoorsLocks::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsEmailsLogs()
    {
        return $this->hasMany(RentsEmailsLog::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsGroupsRents()
    {
        return $this->hasMany(RentsGroupsRents::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsImports()
    {
        return $this->hasMany(RentsImports::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItems()
    {
        return $this->hasMany(RentsItems::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsLogs()
    {
        return $this->hasMany(RentsLog::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsOffers()
    {
        return $this->hasMany(RentsOffers::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsPricesDays()
    {
        return $this->hasMany(RentsPricesDays::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsWorkersLogs()
    {
        return $this->hasMany(RentsWorkersLog::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreasuries()
    {
        return $this->hasMany(Treasury::class, ['rent_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsQuery(get_called_class());
    }
}
