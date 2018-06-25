<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\CityTaxes;
use reception\entities\MyRent\Countries;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\CurrencyExchanges;
use reception\entities\MyRent\CurrencyLists;
use reception\entities\MyRent\Excursions;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\InvoicesHeaders0;
use reception\entities\MyRent\InvoicesItems;
use reception\entities\MyRent\InvoicesItems0;
use reception\entities\MyRent\Items;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsGroups;
use reception\entities\MyRent\ObjectsPricesNetos;
use reception\entities\MyRent\ObjectsTypesItems;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\Rents0;
use reception\entities\MyRent\RentsItems;
use reception\entities\MyRent\UsersMyrentInvoicesHeaders;

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
 * @property InvoicesHeader[] $invoicesHeaders
 * @property InvoicesHeader[] $invoicesHeaders0
 * @property InvoicesItems[] $invoicesItems
 * @property InvoicesItems[] $invoicesItems0
 * @property Items[] $items
 * @property Objects[] $objects
 * @property ObjectsGroups[] $objectsGroups
 * @property ObjectsPricesNeto[] $objectsPricesNetos
 * @property ObjectsTypesItems[] $objectsTypesItems
 * @property PaymentsRecive[] $paymentsRecives
 * @property Rents[] $rents
 * @property Rents[] $rents0
 * @property RentsItems[] $rentsItems
 * @property UsersMyrentInvoicesHeaders[] $usersMyrentInvoicesHeaders
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $country_id//
        * @param int $sort//
        * @param string $code//
        * @param string $code1//
        * @param string $name//
        * @param string $label//
        * @param string $name_full//
        * @param string $label_minior//
        * @param string $name_minior//
        * @param int $unit_minior//
        * @param int $rate//
        * @param int $unit//
        * @param string $kreirano//
        * @return Currency    */
    public static function create($id, $country_id, $sort, $code, $code1, $name, $label, $name_full, $label_minior, $name_minior, $unit_minior, $rate, $unit, $kreirano): Currency
    {
        $currency = new static();
                $currency->id = $id;
                $currency->country_id = $country_id;
                $currency->sort = $sort;
                $currency->code = $code;
                $currency->code1 = $code1;
                $currency->name = $name;
                $currency->label = $label;
                $currency->name_full = $name_full;
                $currency->label_minior = $label_minior;
                $currency->name_minior = $name_minior;
                $currency->unit_minior = $unit_minior;
                $currency->rate = $rate;
                $currency->unit = $unit;
                $currency->kreirano = $kreirano;
        
        return $currency;
    }

    /**
            * @param int $id//
            * @param int $country_id//
            * @param int $sort//
            * @param string $code//
            * @param string $code1//
            * @param string $name//
            * @param string $label//
            * @param string $name_full//
            * @param string $label_minior//
            * @param string $name_minior//
            * @param int $unit_minior//
            * @param int $rate//
            * @param int $unit//
            * @param string $kreirano//
        * @return Currency    */
    public function edit($id, $country_id, $sort, $code, $code1, $name, $label, $name_full, $label_minior, $name_minior, $unit_minior, $rate, $unit, $kreirano): Currency
    {

            $this->id = $id;
            $this->country_id = $country_id;
            $this->sort = $sort;
            $this->code = $code;
            $this->code1 = $code1;
            $this->name = $name;
            $this->label = $label;
            $this->name_full = $name_full;
            $this->label_minior = $label_minior;
            $this->name_minior = $name_minior;
            $this->unit_minior = $unit_minior;
            $this->rate = $rate;
            $this->unit = $unit;
            $this->kreirano = $kreirano;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_id' => Yii::t('app', 'Country ID'),
            'sort' => Yii::t('app', 'Sort'),
            'code' => Yii::t('app', 'Code'),
            'code1' => Yii::t('app', 'Code1'),
            'name' => Yii::t('app', 'Name'),
            'label' => Yii::t('app', 'Label'),
            'name_full' => Yii::t('app', 'Name Full'),
            'label_minior' => Yii::t('app', 'Label Minior'),
            'name_minior' => Yii::t('app', 'Name Minior'),
            'unit_minior' => Yii::t('app', 'Unit Minior'),
            'rate' => Yii::t('app', 'Rate'),
            'unit' => Yii::t('app', 'Unit'),
            'kreirano' => Yii::t('app', 'Kreirano'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityTaxes()
    {
        return $this->hasMany(CityTaxes::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::class, ['currency_id' => 'id']);
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
    public function getCurrencyExchanges()
    {
        return $this->hasMany(CurrencyExchange::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyLists()
    {
        return $this->hasMany(CurrencyList::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasMany(Excursions::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders0()
    {
        return $this->hasMany(InvoicesHeader::class, ['currency_id_info' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems()
    {
        return $this->hasMany(InvoicesItems::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems0()
    {
        return $this->hasMany(InvoicesItems::class, ['neto_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroups()
    {
        return $this->hasMany(ObjectsGroups::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesNetos()
    {
        return $this->hasMany(ObjectsPricesNeto::class, ['price_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesItems()
    {
        return $this->hasMany(ObjectsTypesItems::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents0()
    {
        return $this->hasMany(Rents::class, ['in_advance_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItems()
    {
        return $this->hasMany(RentsItems::class, ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMyrentInvoicesHeaders()
    {
        return $this->hasMany(UsersMyrentInvoicesHeaders::class, ['currency_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CurrencyQuery(get_called_class());
    }
}
