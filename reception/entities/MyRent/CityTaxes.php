<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\CountriesSettlments;
use reception\entities\MyRent\Currency;

/**
 * This is the model class for table "city_taxes".
 *
 * @property int $id
 * @property int $countries_settlments_id
 * @property int $currency_id
 * @property string $period_from
 * @property string $period_to
 * @property double $adults price
 * @property double $children price
 * @property double $children_young price
 * @property string $created
 * @property string $changed
 *
 * @property CountriesSettlments $countriesSettlments
 * @property Currency $currency
 */
class CityTaxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city_taxes';
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
        * @param int $countries_settlments_id//
        * @param int $currency_id//
        * @param string $period_from//
        * @param string $period_to//
        * @param double $adults// price
        * @param double $children// price
        * @param double $children_young// price
        * @param string $created//
        * @param string $changed//
        * @return CityTaxes    */
    public static function create($id, $countries_settlments_id, $currency_id, $period_from, $period_to, $adults, $children, $children_young, $created, $changed): CityTaxes
    {
        $cityTaxes = new static();
                $cityTaxes->id = $id;
                $cityTaxes->countries_settlments_id = $countries_settlments_id;
                $cityTaxes->currency_id = $currency_id;
                $cityTaxes->period_from = $period_from;
                $cityTaxes->period_to = $period_to;
                $cityTaxes->adults = $adults;
                $cityTaxes->children = $children;
                $cityTaxes->children_young = $children_young;
                $cityTaxes->created = $created;
                $cityTaxes->changed = $changed;
        
        return $cityTaxes;
    }

    /**
            * @param int $id//
            * @param int $countries_settlments_id//
            * @param int $currency_id//
            * @param string $period_from//
            * @param string $period_to//
            * @param double $adults// price
            * @param double $children// price
            * @param double $children_young// price
            * @param string $created//
            * @param string $changed//
        * @return CityTaxes    */
    public function edit($id, $countries_settlments_id, $currency_id, $period_from, $period_to, $adults, $children, $children_young, $created, $changed): CityTaxes
    {

            $this->id = $id;
            $this->countries_settlments_id = $countries_settlments_id;
            $this->currency_id = $currency_id;
            $this->period_from = $period_from;
            $this->period_to = $period_to;
            $this->adults = $adults;
            $this->children = $children;
            $this->children_young = $children_young;
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
            'countries_settlments_id' => Yii::t('app', 'Countries Settlments ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'period_from' => Yii::t('app', 'Period From'),
            'period_to' => Yii::t('app', 'Period To'),
            'adults' => Yii::t('app', 'Adults'),
            'children' => Yii::t('app', 'Children'),
            'children_young' => Yii::t('app', 'Children Young'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesSettlments()
    {
        return $this->hasOne(CountriesSettlments::class, ['id' => 'countries_settlments_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CityTaxesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CityTaxesQuery(get_called_class());
    }
}
