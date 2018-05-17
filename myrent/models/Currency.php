<?php

namespace myrent\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property int $country_id
 * @property int $sort
 * @property string $code
 * @property string $code1
 * @property string $name
 * @property string $label
 * @property string $name_full
 * @property string $label_minior
 * @property string $name_minior
 * @property int $unit_minior
 * @property int $rate
 * @property int $unit
 * @property string $kreirano
 *
 * @property CityTaxes[] $cityTaxes
 * @property Countries[] $countries
 * @property Countries $country
 * @property CurrencyExchange[] $currencyExchanges
 * @property CurrencyList[] $currencyLists
 * @property Excursions[] $excursions
 * @property Objects[] $objects
 * @property Rents[] $rents
 * @property Rents[] $rents0
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
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
            [['country_id', 'sort', 'unit_minior', 'rate', 'unit'], 'integer'],
            [['kreirano'], 'safe'],
            [['code', 'code1', 'name', 'label', 'name_full', 'label_minior', 'name_minior'], 'string', 'max' => 50],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'sort' => 'Sort',
            'code' => 'Code',
            'code1' => 'Code1',
            'name' => 'Name',
            'label' => 'Label',
            'name_full' => 'Name Full',
            'label_minior' => 'Label Minior',
            'name_minior' => 'Name Minior',
            'unit_minior' => 'Unit Minior',
            'rate' => 'Rate',
            'unit' => 'Unit',
            'kreirano' => 'Kreirano',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityTaxes()
    {
        return $this->hasMany(CityTaxes::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyExchanges()
    {
        return $this->hasMany(CurrencyExchange::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyLists()
    {
        return $this->hasMany(CurrencyList::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasMany(Excursions::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents0()
    {
        return $this->hasMany(Rents::className(), ['in_advance_currency_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObjectsQuery(get_called_class());
    }
}
