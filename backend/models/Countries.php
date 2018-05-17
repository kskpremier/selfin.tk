<?php

namespace backend\models;

use Yii;

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
 * @property Resellers[] $resellers
 * @property UnitWelcomeDescription[] $unitWelcomeDescriptions
 * @property Units[] $units
 * @property Users[] $users
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
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
        return Yii::$app->get('dbMyRentLocal');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id', 'currency_id', 'telephone_code'], 'integer'],
            [['created', 'changed'], 'safe'],
            [['code1', 'code2', 'country', 'name_local', 'web_code', 'time_format'], 'string', 'max' => 50],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_id' => 'Language ID',
            'currency_id' => 'Currency ID',
            'code1' => 'Code1',
            'code2' => 'Code2',
            'country' => 'Country',
            'name_local' => 'Name Local',
            'telephone_code' => 'Telephone Code',
            'web_code' => 'Web Code',
            'time_format' => 'Time Format',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
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
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesB2bs()
    {
        return $this->hasMany(CountriesB2b::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesSettlments()
    {
        return $this->hasMany(CountriesSettlments::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencies()
    {
        return $this->hasMany(Currency::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyLists()
    {
        return $this->hasMany(CurrencyList::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasMany(Excursions::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResellers()
    {
        return $this->hasMany(Resellers::className(), ['company_country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitWelcomeDescriptions()
    {
        return $this->hasMany(UnitWelcomeDescription::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['company_country_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountriesQuery(get_called_class());
    }
}
