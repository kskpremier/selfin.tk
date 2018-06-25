<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Region;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Units;

/**
 * This is the model class for table "locations_areas".
 *
 * @property int $id
 * @property int $user_id
 * @property int $region_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property LocationsRegions $region
 * @property Users $user
 * @property Units[] $units
 */
class LocationsAreas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations_areas';
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
        * @param int $region_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return LocationsAreas    */
    public static function create($id, $user_id, $region_id, $code, $name, $created, $changed): LocationsAreas
    {
        $locationsAreas = new static();
                $locationsAreas->id = $id;
                $locationsAreas->user_id = $user_id;
                $locationsAreas->region_id = $region_id;
                $locationsAreas->code = $code;
                $locationsAreas->name = $name;
                $locationsAreas->created = $created;
                $locationsAreas->changed = $changed;
        
        return $locationsAreas;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $region_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return LocationsAreas    */
    public function edit($id, $user_id, $region_id, $code, $name, $created, $changed): LocationsAreas
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->region_id = $region_id;
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
            'region_id' => Yii::t('app', 'Region ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(LocationsRegions::class, ['id' => 'region_id']);
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
        return $this->hasMany(Units::class, ['area_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LocationsAreasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LocationsAreasQuery(get_called_class());
    }
}
