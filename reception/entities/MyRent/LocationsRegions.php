<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\LocationsAreas;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "locations_regions".
 *
 * @property int $id
 * @property int $user_id
 * @property int $country_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property LocationsAreas[] $locationsAreas
 * @property Countries $country
 * @property Users $user
 */
class LocationsRegions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations_regions';
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
        * @param int $country_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return LocationsRegions    */
    public static function create($id, $user_id, $country_id, $code, $name, $created, $changed): LocationsRegions
    {
        $locationsRegions = new static();
                $locationsRegions->id = $id;
                $locationsRegions->user_id = $user_id;
                $locationsRegions->country_id = $country_id;
                $locationsRegions->code = $code;
                $locationsRegions->name = $name;
                $locationsRegions->created = $created;
                $locationsRegions->changed = $changed;
        
        return $locationsRegions;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $country_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return LocationsRegions    */
    public function edit($id, $user_id, $country_id, $code, $name, $created, $changed): LocationsRegions
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->country_id = $country_id;
            $this->code = $code;
            $this->name = $name;
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
            'country_id' => Yii::t('app', 'Country ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationsAreas()
    {
        return $this->hasMany(LocationsAreas::class, ['region_id' => 'id']);
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LocationsRegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LocationsRegionsQuery(get_called_class());
    }
}
