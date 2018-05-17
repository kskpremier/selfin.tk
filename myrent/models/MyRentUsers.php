<?php

namespace myrent\models;

use reception\entities\User\User;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $reseller_id
 * @property int $user_type_id
 * @property int $super_id
 * @property string $admin is it free account
 * @property string $free
 * @property string $code internal code for user
 * @property string $user
 * @property string $password
 * @property string $guid
 * @property string $oib VAT id
 * @property string $tax_id TAX id
 * @property string $company_id company ID number
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property string $tel_mobile
 * @property string $skype
 * @property string $note
 * @property string $note_user not for users to display
 * @property int $picture_id
 * @property int $logo_id
 * @property string $longitude for maps
 * @property string $latitude for maps
 * @property string $company_name
 * @property string $company_adress
 * @property string $company_city_zip
 * @property string $company_city_name
 * @property int $company_country_id
 * @property int $timezone
 * @property string $bank_name
 * @property string $invoice_text
 * @property string $vat_obligation
 * @property double $vat
 * @property string $invoice_footer
 * @property string $IBAN
 * @property string $SWIFT
 * @property string $mail_confirmation
 * @property string $mail_reminder
 * @property string $link_web
 * @property string $link_web_object link for web site for object details
 * @property string $link_payment link for payment from web page
 * @property string $link_facebook
 * @property string $link_youtube
 * @property string $link_tweeter
 * @property string $link_instagram
 * @property string $owners_domain use it for payment gatway link portal
 * @property string $key
 * @property string $translate enable translate, or not
 * @property string $fix_currency use fix or daily currency
 * @property string $booking_engine eneble booking engine
 * @property string $active
 * @property string $online see if user is online
 * @property string $created
 * @property string $changed
 *
 * @property Amenities[] $amenities
 * @property B2bSettings[] $b2bSettings
 * @property Blogs[] $blogs
 * @property Cleaners[] $cleaners
 * @property CountriesSettlments[] $countriesSettlments
 * @property CreditCards[] $creditCards
 * @property CurrencyExchange[] $currencyExchanges
 * @property Customers[] $customers
 * @property CustomersGroups[] $customersGroups
 * @property CustomersObjects[] $customersObjects
 * @property CustomersPrices[] $customersPrices
 * @property CustomersTypes[] $customersTypes
 * @property EmailsTemplates[] $emailsTemplates
 * @property EmailsTimers[] $emailsTimers
 * @property EmailsTypes[] $emailsTypes
 * @property Excursions[] $excursions
 * @property ExcursionsPictures[] $excursionsPictures
 * @property Guests[] $guests
 * @property Items[] $items
 * @property Objects[] $objects
 * @property Rents[] $rents
 * @property RentsItems[] $rentsItems
 * @property RentsLog[] $rentsLogs
 * @property RentsSources[] $rentsSources
 * @property RentsStatus[] $rentsStatuses
 * @property UnitWelcomeDescription[] $unitWelcomeDescriptions
 * @property Units[] $units
 * @property UnitsFiles[] $unitsFiles
 * @property Countries $companyCountry
 * @property Pictures $picture
 * @property Pictures $logo
 * @property Resellers $reseller
 * @property UsersSuper $super
 * @property WorkersTypes $userType
 * @property UsersB2b[] $usersB2bs
 * @property UsersEmail[] $usersEmails
 * @property UsersGuests[] $usersGuests
 * @property UsersMyrentContract[] $usersMyrentContracts
 * @property UsersMyrentInvoicesHeaders[] $usersMyrentInvoicesHeaders
 * @property Workers[] $workers
 */
class MyRentUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
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
            [['reseller_id', 'user_type_id', 'super_id', 'picture_id', 'logo_id', 'company_country_id', 'timezone'], 'integer'],
            [['admin', 'free', 'note', 'note_user', 'invoice_text', 'vat_obligation', 'invoice_footer', 'translate', 'fix_currency', 'booking_engine', 'active', 'online'], 'string'],
            [['vat'], 'number'],
            [['created', 'changed'], 'safe'],
            [['code', 'user', 'password', 'guid', 'oib', 'tax_id', 'company_id', 'name', 'email', 'tel', 'tel_mobile', 'skype', 'longitude', 'latitude', 'company_name', 'company_adress', 'company_city_zip', 'company_city_name', 'bank_name', 'IBAN', 'SWIFT', 'mail_confirmation', 'mail_reminder'], 'string', 'max' => 50],
            [['link_web', 'link_web_object', 'link_payment', 'link_facebook', 'link_youtube', 'link_tweeter', 'link_instagram', 'owners_domain', 'key'], 'string', 'max' => 100],
            [['user', 'email'], 'unique', 'targetAttribute' => ['user', 'email']],
            [['company_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['company_country_id' => 'id']],
            [['picture_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pictures::className(), 'targetAttribute' => ['picture_id' => 'id']],
            [['logo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pictures::className(), 'targetAttribute' => ['logo_id' => 'id']],
            [['reseller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resellers::className(), 'targetAttribute' => ['reseller_id' => 'id']],
            [['super_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersSuper::className(), 'targetAttribute' => ['super_id' => 'id']],
            [['user_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkersTypes::className(), 'targetAttribute' => ['user_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reseller_id' => 'Reseller ID',
            'user_type_id' => 'User Type ID',
            'super_id' => 'Super ID',
            'admin' => 'Admin',
            'free' => 'Free',
            'code' => 'Code',
            'user' => 'User',
            'password' => 'Password',
            'guid' => 'Guid',
            'oib' => 'Oib',
            'tax_id' => 'Tax ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'email' => 'Email',
            'tel' => 'Tel',
            'tel_mobile' => 'Tel Mobile',
            'skype' => 'Skype',
            'note' => 'Note',
            'note_user' => 'Note User',
            'picture_id' => 'Picture ID',
            'logo_id' => 'Logo ID',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'company_name' => 'Company Name',
            'company_adress' => 'Company Adress',
            'company_city_zip' => 'Company City Zip',
            'company_city_name' => 'Company City Name',
            'company_country_id' => 'Company Country ID',
            'timezone' => 'Timezone',
            'bank_name' => 'Bank Name',
            'invoice_text' => 'Invoice Text',
            'vat_obligation' => 'Vat Obligation',
            'vat' => 'Vat',
            'invoice_footer' => 'Invoice Footer',
            'IBAN' => 'Iban',
            'SWIFT' => 'Swift',
            'mail_confirmation' => 'Mail Confirmation',
            'mail_reminder' => 'Mail Reminder',
            'link_web' => 'Link Web',
            'link_web_object' => 'Link Web Object',
            'link_payment' => 'Link Payment',
            'link_facebook' => 'Link Facebook',
            'link_youtube' => 'Link Youtube',
            'link_tweeter' => 'Link Tweeter',
            'link_instagram' => 'Link Instagram',
            'owners_domain' => 'Owners Domain',
            'key' => 'Key',
            'translate' => 'Translate',
            'fix_currency' => 'Fix Currency',
            'booking_engine' => 'Booking Engine',
            'active' => 'Active',
            'online' => 'Online',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenities()
    {
        return $this->hasMany(Amenities::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2bSettings()
    {
        return $this->hasMany(B2bSettings::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blogs::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaners()
    {
        return $this->hasMany(Cleaners::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesSettlments()
    {
        return $this->hasMany(CountriesSettlments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditCards()
    {
        return $this->hasMany(CreditCards::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyExchanges()
    {
        return $this->hasMany(CurrencyExchange::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersGroups()
    {
        return $this->hasMany(CustomersGroups::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersObjects()
    {
        return $this->hasMany(CustomersObjects::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersTypes()
    {
        return $this->hasMany(CustomersTypes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTemplates()
    {
        return $this->hasMany(EmailsTemplates::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTimers()
    {
        return $this->hasMany(EmailsTimers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTypes()
    {
        return $this->hasMany(EmailsTypes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasMany(Excursions::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursionsPictures()
    {
        return $this->hasMany(ExcursionsPictures::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(Guests::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItems()
    {
        return $this->hasMany(RentsItems::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsLogs()
    {
        return $this->hasMany(RentsLog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsSources()
    {
        return $this->hasMany(RentsSources::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsStatuses()
    {
        return $this->hasMany(RentsStatus::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitWelcomeDescriptions()
    {
        return $this->hasMany(UnitWelcomeDescription::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsFiles()
    {
        return $this->hasMany(UnitsFiles::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'company_country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(Pictures::className(), ['id' => 'picture_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogo()
    {
        return $this->hasOne(Pictures::className(), ['id' => 'logo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReseller()
    {
        return $this->hasOne(Resellers::className(), ['id' => 'reseller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuper()
    {
        return $this->hasOne(UsersSuper::className(), ['id' => 'super_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(WorkersTypes::className(), ['id' => 'user_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersB2bs()
    {
        return $this->hasMany(UsersB2b::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersEmails()
    {
        return $this->hasMany(UsersEmail::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGuests()
    {
        return $this->hasMany(UsersGuests::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMyrentContracts()
    {
        return $this->hasMany(UsersMyrentContract::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMyrentInvoicesHeaders()
    {
        return $this->hasMany(UsersMyrentInvoicesHeaders::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMobileUser()
    {
        return $this->hasMany(User::className(), ['external_id' => 'id']);
    }


    /**
     * @inheritdoc
     * @return MyRentUsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MyRentUsersQuery(get_called_class());
    }
}
