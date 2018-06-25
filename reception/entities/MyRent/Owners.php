<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\User;
use reception\entities\MyRent\OwnersB2bs;
use reception\entities\MyRent\OwnersContracts;
use reception\entities\MyRent\Units;

/**
 * This is the model class for table "owners".
 *
 * @property int $id
 * @property int $user_id
 * @property string $guid
 * @property string $code
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $adress
 * @property string $zip
 * @property string $city
 * @property int $country_id
 * @property string $note
 * @property string $oib
 * @property string $report_note
 * @property string $id_number
 * @property string $tel
 * @property string $email
 * @property string $web
 * @property string $vat_obligation
 * @property string $iban
 * @property string $swift
 * @property string $contact_name
 * @property string $type
 * @property int $tax how many percent is owner paying tax
 * @property double $vat vat of owner
 * @property string $enable_portal enable owners portal
 * @property string $new_rent enbale of adding new rent on portal
 * @property string $city_tax is owner paying city tax
 * @property string $portal_change enable changes in portal
 * @property string $show_in_calendar show details in calendar
 * @property string $show_local_price_in_calendar show local price in calendar
 * @property string $show_conatct_in_calendar show contact name in calendar
 * @property string $mail_new send mail when new reservation comes
 * @property string $mail_new_plain send mail when new reservation comes - onlin info
 * @property string $mail_confirmation send mail when confirmation is send
 * @property string $mail_voucher send email when sending voucher
 * @property string $new_rent_searchable is new rent from owner searchable or not
 * @property string $invoice_for_city_tax create aditional invoice for city tax
 * @property string $white_label remove myRent from owners portal and put users
 * @property string $online check if owner is online
 * @property string $portal_header show header in portal
 * @property string $portal_footer show footer in portal
 * @property string $online_datetime last time online
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader[] $invoicesHeaders
 * @property Countries $country
 * @property Users $user
 * @property OwnersB2b[] $ownersB2bs
 * @property OwnersContracts[] $ownersContracts
 * @property Units[] $units
 */
class Owners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owners';
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
        * @param string $guid//
        * @param string $code//
        * @param string $username//
        * @param string $password//
        * @param string $name//
        * @param string $adress//
        * @param string $zip//
        * @param string $city//
        * @param int $country_id//
        * @param string $note//
        * @param string $oib//
        * @param string $report_note//
        * @param string $id_number//
        * @param string $tel//
        * @param string $email//
        * @param string $web//
        * @param string $vat_obligation//
        * @param string $iban//
        * @param string $swift//
        * @param string $contact_name//
        * @param string $type//
        * @param int $tax// how many percent is owner paying tax
        * @param double $vat// vat of owner
        * @param string $enable_portal// enable owners portal
        * @param string $new_rent// enbale of adding new rent on portal
        * @param string $city_tax// is owner paying city tax
        * @param string $portal_change// enable changes in portal
        * @param string $show_in_calendar// show details in calendar
        * @param string $show_local_price_in_calendar// show local price in calendar
        * @param string $show_conatct_in_calendar// show contact name in calendar
        * @param string $mail_new// send mail when new reservation comes
        * @param string $mail_new_plain// send mail when new reservation comes - onlin info
        * @param string $mail_confirmation// send mail when confirmation is send
        * @param string $mail_voucher// send email when sending voucher
        * @param string $new_rent_searchable// is new rent from owner searchable or not
        * @param string $invoice_for_city_tax// create aditional invoice for city tax
        * @param string $white_label// remove myRent from owners portal and put users
        * @param string $online// check if owner is online
        * @param string $portal_header// show header in portal
        * @param string $portal_footer// show footer in portal
        * @param string $online_datetime// last time online
        * @param string $created//
        * @param string $changed//
        * @return Owners    */
    public static function create($id, $user_id, $guid, $code, $username, $password, $name, $adress, $zip, $city, $country_id, $note, $oib, $report_note, $id_number, $tel, $email, $web, $vat_obligation, $iban, $swift, $contact_name, $type, $tax, $vat, $enable_portal, $new_rent, $city_tax, $portal_change, $show_in_calendar, $show_local_price_in_calendar, $show_conatct_in_calendar, $mail_new, $mail_new_plain, $mail_confirmation, $mail_voucher, $new_rent_searchable, $invoice_for_city_tax, $white_label, $online, $portal_header, $portal_footer, $online_datetime, $created, $changed): Owners
    {
        $owners = new static();
                $owners->id = $id;
                $owners->user_id = $user_id;
                $owners->guid = $guid;
                $owners->code = $code;
                $owners->username = $username;
                $owners->password = $password;
                $owners->name = $name;
                $owners->adress = $adress;
                $owners->zip = $zip;
                $owners->city = $city;
                $owners->country_id = $country_id;
                $owners->note = $note;
                $owners->oib = $oib;
                $owners->report_note = $report_note;
                $owners->id_number = $id_number;
                $owners->tel = $tel;
                $owners->email = $email;
                $owners->web = $web;
                $owners->vat_obligation = $vat_obligation;
                $owners->iban = $iban;
                $owners->swift = $swift;
                $owners->contact_name = $contact_name;
                $owners->type = $type;
                $owners->tax = $tax;
                $owners->vat = $vat;
                $owners->enable_portal = $enable_portal;
                $owners->new_rent = $new_rent;
                $owners->city_tax = $city_tax;
                $owners->portal_change = $portal_change;
                $owners->show_in_calendar = $show_in_calendar;
                $owners->show_local_price_in_calendar = $show_local_price_in_calendar;
                $owners->show_conatct_in_calendar = $show_conatct_in_calendar;
                $owners->mail_new = $mail_new;
                $owners->mail_new_plain = $mail_new_plain;
                $owners->mail_confirmation = $mail_confirmation;
                $owners->mail_voucher = $mail_voucher;
                $owners->new_rent_searchable = $new_rent_searchable;
                $owners->invoice_for_city_tax = $invoice_for_city_tax;
                $owners->white_label = $white_label;
                $owners->online = $online;
                $owners->portal_header = $portal_header;
                $owners->portal_footer = $portal_footer;
                $owners->online_datetime = $online_datetime;
                $owners->created = $created;
                $owners->changed = $changed;
        
        return $owners;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $guid//
            * @param string $code//
            * @param string $username//
            * @param string $password//
            * @param string $name//
            * @param string $adress//
            * @param string $zip//
            * @param string $city//
            * @param int $country_id//
            * @param string $note//
            * @param string $oib//
            * @param string $report_note//
            * @param string $id_number//
            * @param string $tel//
            * @param string $email//
            * @param string $web//
            * @param string $vat_obligation//
            * @param string $iban//
            * @param string $swift//
            * @param string $contact_name//
            * @param string $type//
            * @param int $tax// how many percent is owner paying tax
            * @param double $vat// vat of owner
            * @param string $enable_portal// enable owners portal
            * @param string $new_rent// enbale of adding new rent on portal
            * @param string $city_tax// is owner paying city tax
            * @param string $portal_change// enable changes in portal
            * @param string $show_in_calendar// show details in calendar
            * @param string $show_local_price_in_calendar// show local price in calendar
            * @param string $show_conatct_in_calendar// show contact name in calendar
            * @param string $mail_new// send mail when new reservation comes
            * @param string $mail_new_plain// send mail when new reservation comes - onlin info
            * @param string $mail_confirmation// send mail when confirmation is send
            * @param string $mail_voucher// send email when sending voucher
            * @param string $new_rent_searchable// is new rent from owner searchable or not
            * @param string $invoice_for_city_tax// create aditional invoice for city tax
            * @param string $white_label// remove myRent from owners portal and put users
            * @param string $online// check if owner is online
            * @param string $portal_header// show header in portal
            * @param string $portal_footer// show footer in portal
            * @param string $online_datetime// last time online
            * @param string $created//
            * @param string $changed//
        * @return Owners    */
    public function edit($id, $user_id, $guid, $code, $username, $password, $name, $adress, $zip, $city, $country_id, $note, $oib, $report_note, $id_number, $tel, $email, $web, $vat_obligation, $iban, $swift, $contact_name, $type, $tax, $vat, $enable_portal, $new_rent, $city_tax, $portal_change, $show_in_calendar, $show_local_price_in_calendar, $show_conatct_in_calendar, $mail_new, $mail_new_plain, $mail_confirmation, $mail_voucher, $new_rent_searchable, $invoice_for_city_tax, $white_label, $online, $portal_header, $portal_footer, $online_datetime, $created, $changed): Owners
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guid = $guid;
            $this->code = $code;
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->adress = $adress;
            $this->zip = $zip;
            $this->city = $city;
            $this->country_id = $country_id;
            $this->note = $note;
            $this->oib = $oib;
            $this->report_note = $report_note;
            $this->id_number = $id_number;
            $this->tel = $tel;
            $this->email = $email;
            $this->web = $web;
            $this->vat_obligation = $vat_obligation;
            $this->iban = $iban;
            $this->swift = $swift;
            $this->contact_name = $contact_name;
            $this->type = $type;
            $this->tax = $tax;
            $this->vat = $vat;
            $this->enable_portal = $enable_portal;
            $this->new_rent = $new_rent;
            $this->city_tax = $city_tax;
            $this->portal_change = $portal_change;
            $this->show_in_calendar = $show_in_calendar;
            $this->show_local_price_in_calendar = $show_local_price_in_calendar;
            $this->show_conatct_in_calendar = $show_conatct_in_calendar;
            $this->mail_new = $mail_new;
            $this->mail_new_plain = $mail_new_plain;
            $this->mail_confirmation = $mail_confirmation;
            $this->mail_voucher = $mail_voucher;
            $this->new_rent_searchable = $new_rent_searchable;
            $this->invoice_for_city_tax = $invoice_for_city_tax;
            $this->white_label = $white_label;
            $this->online = $online;
            $this->portal_header = $portal_header;
            $this->portal_footer = $portal_footer;
            $this->online_datetime = $online_datetime;
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
            'guid' => Yii::t('app', 'Guid'),
            'code' => Yii::t('app', 'Code'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'name' => Yii::t('app', 'Name'),
            'adress' => Yii::t('app', 'Adress'),
            'zip' => Yii::t('app', 'Zip'),
            'city' => Yii::t('app', 'City'),
            'country_id' => Yii::t('app', 'Country ID'),
            'note' => Yii::t('app', 'Note'),
            'oib' => Yii::t('app', 'Oib'),
            'report_note' => Yii::t('app', 'Report Note'),
            'id_number' => Yii::t('app', 'Id Number'),
            'tel' => Yii::t('app', 'Tel'),
            'email' => Yii::t('app', 'Email'),
            'web' => Yii::t('app', 'Web'),
            'vat_obligation' => Yii::t('app', 'Vat Obligation'),
            'iban' => Yii::t('app', 'Iban'),
            'swift' => Yii::t('app', 'Swift'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'type' => Yii::t('app', 'Type'),
            'tax' => Yii::t('app', 'Tax'),
            'vat' => Yii::t('app', 'Vat'),
            'enable_portal' => Yii::t('app', 'Enable Portal'),
            'new_rent' => Yii::t('app', 'New Rent'),
            'city_tax' => Yii::t('app', 'City Tax'),
            'portal_change' => Yii::t('app', 'Portal Change'),
            'show_in_calendar' => Yii::t('app', 'Show In Calendar'),
            'show_local_price_in_calendar' => Yii::t('app', 'Show Local Price In Calendar'),
            'show_conatct_in_calendar' => Yii::t('app', 'Show Conatct In Calendar'),
            'mail_new' => Yii::t('app', 'Mail New'),
            'mail_new_plain' => Yii::t('app', 'Mail New Plain'),
            'mail_confirmation' => Yii::t('app', 'Mail Confirmation'),
            'mail_voucher' => Yii::t('app', 'Mail Voucher'),
            'new_rent_searchable' => Yii::t('app', 'New Rent Searchable'),
            'invoice_for_city_tax' => Yii::t('app', 'Invoice For City Tax'),
            'white_label' => Yii::t('app', 'White Label'),
            'online' => Yii::t('app', 'Online'),
            'portal_header' => Yii::t('app', 'Portal Header'),
            'portal_footer' => Yii::t('app', 'Portal Footer'),
            'online_datetime' => Yii::t('app', 'Online Datetime'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'country_id']);
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
    public function getOwnersB2bs()
    {
        return $this->hasMany(OwnersB2b::class, ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwnersContracts()
    {
        return $this->hasMany(OwnersContracts::class, ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::class, ['owner_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\OwnersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\OwnersQuery(get_called_class());
    }
}
