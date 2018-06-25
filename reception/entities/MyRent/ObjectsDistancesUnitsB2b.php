<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsDistancesUnits;

/**
 * This is the model class for table "objects_distances_units_b2b".
 *
 * @property int $id
 * @property int $objects_distances_units_id
 * @property string $value
 * @property string $changed
 * @property string $created
 *
 * @property ObjectsDistancesUnits $objectsDistancesUnits
 */
class ObjectsDistancesUnitsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_distances_units_b2b';
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
        * @param int $objects_distances_units_id//
        * @param string $value//
        * @param string $changed//
        * @param string $created//
        * @return ObjectsDistancesUnitsB2b    */
    public static function create($id, $objects_distances_units_id, $value, $changed, $created): ObjectsDistancesUnitsB2b
    {
        $objectsDistancesUnitsB2b = new static();
                $objectsDistancesUnitsB2b->id = $id;
                $objectsDistancesUnitsB2b->objects_distances_units_id = $objects_distances_units_id;
                $objectsDistancesUnitsB2b->value = $value;
                $objectsDistancesUnitsB2b->changed = $changed;
                $objectsDistancesUnitsB2b->created = $created;
        
        return $objectsDistancesUnitsB2b;
    }

    /**
            * @param int $id//
            * @param int $objects_distances_units_id//
            * @param string $value//
            * @param string $changed//
            * @param string $created//
        * @return ObjectsDistancesUnitsB2b    */
    public function edit($id, $objects_distances_units_id, $value, $changed, $created): ObjectsDistancesUnitsB2b
    {

            $this->id = $id;
            $this->objects_distances_units_id = $objects_distances_units_id;
            $this->value = $value;
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
            'objects_distances_units_id' => Yii::t('app', 'Objects Distances Units ID'),
            'value' => Yii::t('app', 'Value'),
            'changed' => Yii::t('app', 'Changed'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistancesUnits()
    {
        return $this->hasOne(ObjectsDistancesUnits::class, ['id' => 'objects_distances_units_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsDistancesUnitsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsDistancesUnitsB2bQuery(get_called_class());
    }
}
