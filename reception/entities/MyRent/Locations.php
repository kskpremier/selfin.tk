<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectRealstateMailDescriptions;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property string $location_id
 * @property int $location_type_id
 * @property string $location
 * @property int $parent_id
 * @property string $created
 * @property string $changed
 *
 * @property ObjectRealstateMailDescription[] $objectRealstateMailDescriptions
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
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
        * @param string $location_id//
        * @param int $location_type_id//
        * @param string $location//
        * @param int $parent_id//
        * @param string $created//
        * @param string $changed//
        * @return Locations    */
    public static function create($id, $location_id, $location_type_id, $location, $parent_id, $created, $changed): Locations
    {
        $locations = new static();
                $locations->id = $id;
                $locations->location_id = $location_id;
                $locations->location_type_id = $location_type_id;
                $locations->location = $location;
                $locations->parent_id = $parent_id;
                $locations->created = $created;
                $locations->changed = $changed;
        
        return $locations;
    }

    /**
            * @param int $id//
            * @param string $location_id//
            * @param int $location_type_id//
            * @param string $location//
            * @param int $parent_id//
            * @param string $created//
            * @param string $changed//
        * @return Locations    */
    public function edit($id, $location_id, $location_type_id, $location, $parent_id, $created, $changed): Locations
    {

            $this->id = $id;
            $this->location_id = $location_id;
            $this->location_type_id = $location_type_id;
            $this->location = $location;
            $this->parent_id = $parent_id;
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
            'location_id' => Yii::t('app', 'Location ID'),
            'location_type_id' => Yii::t('app', 'Location Type ID'),
            'location' => Yii::t('app', 'Location'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectRealstateMailDescriptions()
    {
        return $this->hasMany(ObjectRealstateMailDescription::class, ['language_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LocationsQuery(get_called_class());
    }
}
