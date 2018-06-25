<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\CountriesB2bs;
use reception\entities\MyRent\CountriesSettlments;
use reception\entities\MyRent\Currencies;
use reception\entities\MyRent\CurrencyLists;
use reception\entities\MyRent\Customers;
use reception\entities\MyRent\Excursions;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\LocationsRegions;
use reception\entities\MyRent\Owners;
use reception\entities\MyRent\Resellers;
use reception\entities\MyRent\TransactionsAccounts;
use reception\entities\MyRent\UnitWelcomeDescriptions;
use reception\entities\MyRent\Units;
use reception\entities\MyRent\Users;
use reception\entities\MyRent\UsersIbans;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property int $language_id
 * @property int $currency_id
 * @property string $code1
 * @property string $code2
 * @property string $country
 * @property string $name_local
 * @property int $telephone_code
 * @property string $web_code
 * @property string $time_format
 * @property string $created
 * @property string $changed
 *
 * @property Currency $currency
 * @property Languages $language
 * @property CountriesB2b[] $countriesB2bs
 * @property CountriesSettlments[] $countriesSettlments
 * @property Currency[] $currencies
 * @property CurrencyList[] $currencyLists
 * @property Customers[] $customers
 * @property Excursions[] $excursions
 * @property InvoicesHeader[] $invoicesHeaders
 * @property LocationsRegions[] $locationsRegions
 * @property Owners[] $owners
 * @property Resellers[] $resellers
 * @property TransactionsAccounts[] $transactionsAccounts
 * @property UnitWelcomeDescription[] $unitWelcomeDescriptions
 * @property Units[] $units
 * @property Users[] $users
 * @property UsersIbans[] $usersIbans
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
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
        * @param int $language_id//
        * @param int $currency_id//
        * @param string $code1//
        * @param string $code2//
        * @param string $country//
        * @param string $name_local//
        * @param int $telephone_code//
        * @param string $web_code//
        * @param string $time_format//
        * @param string $created//
        * @param string $changed//
        * @return Countries    */
    public static function create($id, $language_id, $currency_id, $code1, $code2, $country, $name_local, $telephone_code, $web_code, $time_format, $created, $changed): Countries
    {
        $countries = new static();
                $countries->id = $id;
                $countries->language_id = $language_id;
                $countries->currency_id = $currency_id;
                $countries->code1 = $code1;
                $countries->code2 = $code2;
                $countries->country = $country;
                $countries->name_local = $name_local;
                $countries->telephone_code = $telephone_code;
                $countries->web_code = $web_code;
                $countries->time_format = $time_format;
                $countries->created = $created;
                $countries->changed = $changed;
        
        return $countries;
    }

    /**
            * @param int $id//
            * @param int $language_id//
            * @param int $currency_id//
            * @param string $code1//
            * @param string $code2//
            * @param string $country//
            * @param string $name_local//
            * @param int $telephone_code//
            * @param string $web_code//
            * @param string $time_format//
            * @param string $created//
            * @param string $changed//
        * @return Countries    */
    public function edit($id, $language_id, $currency_id, $code1, $code2, $country, $name_local, $telephone_code, $web_code, $time_format, $created, $changed): Countries
    {

            $this->id = $id;
            $this->language_id = $language_id;
            $this->currency_id = $currency_id;
            $this->code1 = $code1;
            $this->code2 = $code2;
            $this->country = $country;
            $this->name_local = $name_local;
            $this->telephone_code = $telephone_code;
            $this->web_code = $web_code;
            $this->time_format = $time_format;
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
            'language_id' => Yii::t('app', 'Language ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'code1' => Yii::t('app', 'Code1'),
            'code2' => Yii::t('app', 'Code2'),
            'country' => Yii::t('app', 'Country'),
            'name_local' => Yii::t('app', 'Name Local'),
            'telephone_code' => Yii::t('app', 'Telephone Code'),
            'web_code' => Yii::t('app', 'Web Code'),
            'time_format' => Yii::t('app', 'Time Format'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesB2bs()
    {
        return $this->hasMany(CountriesB2b::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesSettlments()
    {
        return $this->hasMany(CountriesSettlments::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencies()
    {
        return $this->hasMany(Currency::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyLists()
    {
        return $this->hasMany(CurrencyList::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasMany(Excursions::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['customer_country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationsRegions()
    {
        return $this->hasMany(LocationsRegions::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwners()
    {
        return $this->hasMany(Owners::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResellers()
    {
        return $this->hasMany(Resellers::class, ['company_country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionsAccounts()
    {
        return $this->hasMany(TransactionsAccounts::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitWelcomeDescriptions()
    {
        return $this->hasMany(UnitWelcomeDescription::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::class, ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['company_country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersIbans()
    {
        return $this->hasMany(UsersIbans::class, ['contant_country' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CountriesQuery(get_called_class());
    }
}
