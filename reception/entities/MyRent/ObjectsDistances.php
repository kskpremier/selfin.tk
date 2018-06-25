<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Place;
use reception\entities\MyRent\Rent;

/**
 * This is the model class for table "objects_distances".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $rent_id
 * @property int $unit_id ???
 * @property int $place_id
 * @property double $distance
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property string $url web link to that place
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 * @property ObjectsDistancesPlaces $place
 * @property Rents $rent
 */
class ObjectsDistances extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_distances';
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
        * @param int $object_id//
        * @param int $rent_id//
        * @param int $unit_id// ???
        * @param int $place_id//
        * @param double $distance//
        * @param string $name//
        * @param string $latitude//
        * @param string $longitude//
        * @param string $url// web link to that place
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsDistances    */
    public static function create($id, $user_id, $object_id, $rent_id, $unit_id, $place_id, $distance, $name, $latitude, $longitude, $url, $note, $created, $changed): ObjectsDistances
    {
        $objectsDistances = new static();
                $objectsDistances->id = $id;
                $objectsDistances->user_id = $user_id;
                $objectsDistances->object_id = $object_id;
                $objectsDistances->rent_id = $rent_id;
                $objectsDistances->unit_id = $unit_id;
                $objectsDistances->place_id = $place_id;
                $objectsDistances->distance = $distance;
                $objectsDistances->name = $name;
                $objectsDistances->latitude = $latitude;
                $objectsDistances->longitude = $longitude;
                $objectsDistances->url = $url;
                $objectsDistances->note = $note;
                $objectsDistances->created = $created;
                $objectsDistances->changed = $changed;
        
        return $objectsDistances;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $rent_id//
            * @param int $unit_id// ???
            * @param int $place_id//
            * @param double $distance//
            * @param string $name//
            * @param string $latitude//
            * @param string $longitude//
            * @param string $url// web link to that place
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsDistances    */
    public function edit($id, $user_id, $object_id, $rent_id, $unit_id, $place_id, $distance, $name, $latitude, $longitude, $url, $note, $created, $changed): ObjectsDistances
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->rent_id = $rent_id;
            $this->unit_id = $unit_id;
            $this->place_id = $place_id;
            $this->distance = $distance;
            $this->name = $name;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->url = $url;
            $this->note = $note;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'distance' => Yii::t('app', 'Distance'),
            'name' => Yii::t('app', 'Name'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'url' => Yii::t('app', 'Url'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
    public function getPlace()
    {
        return $this->hasOne(ObjectsDistancesPlaces::class, ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsDistancesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsDistancesQuery(get_called_class());
    }
}
