<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsDistances;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsDistancesPlacesB2bs;

/**
 * This is the model class for table "objects_distances_places".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsDistances[] $objectsDistances
 * @property Users $user
 * @property ObjectsDistancesPlacesB2b[] $objectsDistancesPlacesB2bs
 */
class ObjectsDistancesPlaces extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_distances_places';
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
        * @param string $created//
        * @param string $changed//
        * @return ObjectsDistancesPlaces    */
    public static function create($id, $user_id, $code, $name, $created, $changed): ObjectsDistancesPlaces
    {
        $objectsDistancesPlaces = new static();
                $objectsDistancesPlaces->id = $id;
                $objectsDistancesPlaces->user_id = $user_id;
                $objectsDistancesPlaces->code = $code;
                $objectsDistancesPlaces->name = $name;
                $objectsDistancesPlaces->created = $created;
                $objectsDistancesPlaces->changed = $changed;
        
        return $objectsDistancesPlaces;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsDistancesPlaces    */
    public function edit($id, $user_id, $code, $name, $created, $changed): ObjectsDistancesPlaces
    {

            $this->id = $id;
            $this->user_id = $user_id;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistances()
    {
        return $this->hasMany(ObjectsDistances::class, ['place_id' => 'id']);
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
    public function getObjectsDistancesPlacesB2bs()
    {
        return $this->hasMany(ObjectsDistancesPlacesB2b::class, ['objects_distances_places_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsDistancesPlacesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsDistancesPlacesQuery(get_called_class());
    }
}
