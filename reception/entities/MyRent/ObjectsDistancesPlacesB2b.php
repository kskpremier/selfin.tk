<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\ObjectsDistancesPlaces;

/**
 * This is the model class for table "objects_distances_places_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $objects_distances_places_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsDistancesPlaces $objectsDistancesPlaces
 */
class ObjectsDistancesPlacesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_distances_places_b2b';
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
        * @param int $objects_distances_places_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsDistancesPlacesB2b    */
    public static function create($id, $b2b_id, $objects_distances_places_id, $value, $created, $changed): ObjectsDistancesPlacesB2b
    {
        $objectsDistancesPlacesB2b = new static();
                $objectsDistancesPlacesB2b->id = $id;
                $objectsDistancesPlacesB2b->b2b_id = $b2b_id;
                $objectsDistancesPlacesB2b->objects_distances_places_id = $objects_distances_places_id;
                $objectsDistancesPlacesB2b->value = $value;
                $objectsDistancesPlacesB2b->created = $created;
                $objectsDistancesPlacesB2b->changed = $changed;
        
        return $objectsDistancesPlacesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $objects_distances_places_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsDistancesPlacesB2b    */
    public function edit($id, $b2b_id, $objects_distances_places_id, $value, $created, $changed): ObjectsDistancesPlacesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->objects_distances_places_id = $objects_distances_places_id;
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
            'objects_distances_places_id' => Yii::t('app', 'Objects Distances Places ID'),
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
    public function getObjectsDistancesPlaces()
    {
        return $this->hasOne(ObjectsDistancesPlaces::class, ['id' => 'objects_distances_places_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsDistancesPlacesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsDistancesPlacesB2bQuery(get_called_class());
    }
}
