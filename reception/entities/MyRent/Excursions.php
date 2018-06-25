<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ExcursionsPictures;

/**
 * This is the model class for table "excursions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property double $duration
 * @property string $duration_type
 * @property string $adress
 * @property string $description
 * @property string $description_short
 * @property string $note
 * @property string $picture
 * @property string $latitude
 * @property string $longitude
 * @property double $price
 * @property int $currency_id
 * @property string $city
 * @property string $city_zip
 * @property int $country_id
 * @property string $active
 * @property string $changed
 * @property string $created
 *
 * @property Countries $country
 * @property Currency $currency
 * @property Users $user
 * @property ExcursionsPictures[] $excursionsPictures
 */
class Excursions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'excursions';
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
        * @param string $code//
        * @param string $name//
        * @param double $duration//
        * @param string $duration_type//
        * @param string $adress//
        * @param string $description//
        * @param string $description_short//
        * @param string $note//
        * @param string $picture//
        * @param string $latitude//
        * @param string $longitude//
        * @param double $price//
        * @param int $currency_id//
        * @param string $city//
        * @param string $city_zip//
        * @param int $country_id//
        * @param string $active//
        * @param string $changed//
        * @param string $created//
        * @return Excursions    */
    public static function create($id, $user_id, $code, $name, $duration, $duration_type, $adress, $description, $description_short, $note, $picture, $latitude, $longitude, $price, $currency_id, $city, $city_zip, $country_id, $active, $changed, $created): Excursions
    {
        $excursions = new static();
                $excursions->id = $id;
                $excursions->user_id = $user_id;
                $excursions->code = $code;
                $excursions->name = $name;
                $excursions->duration = $duration;
                $excursions->duration_type = $duration_type;
                $excursions->adress = $adress;
                $excursions->description = $description;
                $excursions->description_short = $description_short;
                $excursions->note = $note;
                $excursions->picture = $picture;
                $excursions->latitude = $latitude;
                $excursions->longitude = $longitude;
                $excursions->price = $price;
                $excursions->currency_id = $currency_id;
                $excursions->city = $city;
                $excursions->city_zip = $city_zip;
                $excursions->country_id = $country_id;
                $excursions->active = $active;
                $excursions->changed = $changed;
                $excursions->created = $created;
        
        return $excursions;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param double $duration//
            * @param string $duration_type//
            * @param string $adress//
            * @param string $description//
            * @param string $description_short//
            * @param string $note//
            * @param string $picture//
            * @param string $latitude//
            * @param string $longitude//
            * @param double $price//
            * @param int $currency_id//
            * @param string $city//
            * @param string $city_zip//
            * @param int $country_id//
            * @param string $active//
            * @param string $changed//
            * @param string $created//
        * @return Excursions    */
    public function edit($id, $user_id, $code, $name, $duration, $duration_type, $adress, $description, $description_short, $note, $picture, $latitude, $longitude, $price, $currency_id, $city, $city_zip, $country_id, $active, $changed, $created): Excursions
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
            $this->duration = $duration;
            $this->duration_type = $duration_type;
            $this->adress = $adress;
            $this->description = $description;
            $this->description_short = $description_short;
            $this->note = $note;
            $this->picture = $picture;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->price = $price;
            $this->currency_id = $currency_id;
            $this->city = $city;
            $this->city_zip = $city_zip;
            $this->country_id = $country_id;
            $this->active = $active;
            $this->changed = $changed;
            $this->created = $created;
    
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'duration' => Yii::t('app', 'Duration'),
            'duration_type' => Yii::t('app', 'Duration Type'),
            'adress' => Yii::t('app', 'Adress'),
            'description' => Yii::t('app', 'Description'),
            'description_short' => Yii::t('app', 'Description Short'),
            'note' => Yii::t('app', 'Note'),
            'picture' => Yii::t('app', 'Picture'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'price' => Yii::t('app', 'Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'city' => Yii::t('app', 'City'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'country_id' => Yii::t('app', 'Country ID'),
            'active' => Yii::t('app', 'Active'),
            'changed' => Yii::t('app', 'Changed'),
            'created' => Yii::t('app', 'Created'),
        ];
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
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
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
    public function getExcursionsPictures()
    {
        return $this->hasMany(ExcursionsPictures::class, ['excursions_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ExcursionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ExcursionsQuery(get_called_class());
    }
}
