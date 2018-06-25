<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Country;

/**
 * This is the model class for table "countries_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $country_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Countries $country
 */
class CountriesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries_b2b';
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
        * @param int $b2b_id//
        * @param int $country_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return CountriesB2b    */
    public static function create($id, $b2b_id, $country_id, $value, $created, $changed): CountriesB2b
    {
        $countriesB2b = new static();
                $countriesB2b->id = $id;
                $countriesB2b->b2b_id = $b2b_id;
                $countriesB2b->country_id = $country_id;
                $countriesB2b->value = $value;
                $countriesB2b->created = $created;
                $countriesB2b->changed = $changed;
        
        return $countriesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $country_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return CountriesB2b    */
    public function edit($id, $b2b_id, $country_id, $value, $created, $changed): CountriesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->country_id = $country_id;
            $this->value = $value;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'country_id' => Yii::t('app', 'Country ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'country_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CountriesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CountriesB2bQuery(get_called_class());
    }
}
