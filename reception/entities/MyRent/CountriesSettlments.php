<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\CityTaxes;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Units;

/**
 * This is the model class for table "countries_settlments".
 *
 * @property int $id
 * @property int $country_id
 * @property int $user_id
 * @property int $currency_id
 * @property string $place_zip
 * @property string $place
 * @property string $type
 * @property string $settlment
 * @property string $county
 * @property string $created
 * @property string $changed
 *
 * @property CityTaxes[] $cityTaxes
 * @property Countries $country
 * @property Users $user
 * @property Units[] $units
 */
class CountriesSettlments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries_settlments';
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
        * @param int $user_id//
        * @param int $currency_id//
        * @param string $place_zip//
        * @param string $place//
        * @param string $type//
        * @param string $settlment//
        * @param string $county//
        * @param string $created//
        * @param string $changed//
        * @return CountriesSettlments    */
    public static function create($id, $country_id, $user_id, $currency_id, $place_zip, $place, $type, $settlment, $county, $created, $changed): CountriesSettlments
    {
        $countriesSettlments = new static();
                $countriesSettlments->id = $id;
                $countriesSettlments->country_id = $country_id;
                $countriesSettlments->user_id = $user_id;
                $countriesSettlments->currency_id = $currency_id;
                $countriesSettlments->place_zip = $place_zip;
                $countriesSettlments->place = $place;
                $countriesSettlments->type = $type;
                $countriesSettlments->settlment = $settlment;
                $countriesSettlments->county = $county;
                $countriesSettlments->created = $created;
                $countriesSettlments->changed = $changed;
        
        return $countriesSettlments;
    }

    /**
            * @param int $id//
            * @param int $country_id//
            * @param int $user_id//
            * @param int $currency_id//
            * @param string $place_zip//
            * @param string $place//
            * @param string $type//
            * @param string $settlment//
            * @param string $county//
            * @param string $created//
            * @param string $changed//
        * @return CountriesSettlments    */
    public function edit($id, $country_id, $user_id, $currency_id, $place_zip, $place, $type, $settlment, $county, $created, $changed): CountriesSettlments
    {

            $this->id = $id;
            $this->country_id = $country_id;
            $this->user_id = $user_id;
            $this->currency_id = $currency_id;
            $this->place_zip = $place_zip;
            $this->place = $place;
            $this->type = $type;
            $this->settlment = $settlment;
            $this->county = $county;
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
            'country_id' => Yii::t('app', 'Country ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'place_zip' => Yii::t('app', 'Place Zip'),
            'place' => Yii::t('app', 'Place'),
            'type' => Yii::t('app', 'Type'),
            'settlment' => Yii::t('app', 'Settlment'),
            'county' => Yii::t('app', 'County'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityTaxes()
    {
        return $this->hasMany(CityTaxes::class, ['countries_settlments_id' => 'id']);
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
    public function getUnits()
    {
        return $this->hasMany(Units::class, ['settlment_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CountriesSettlmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CountriesSettlmentsQuery(get_called_class());
    }
}
