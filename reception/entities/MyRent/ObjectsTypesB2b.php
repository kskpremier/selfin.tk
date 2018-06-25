<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\ObjectsTypes;

/**
 * This is the model class for table "objects_types_b2b".
 *
 * @property int $id
 * @property int $objects_types_id
 * @property int $b2b_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsTypes $objectsTypes
 */
class ObjectsTypesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_types_b2b';
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
        * @param int $objects_types_id//
        * @param int $b2b_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsTypesB2b    */
    public static function create($id, $objects_types_id, $b2b_id, $value, $created, $changed): ObjectsTypesB2b
    {
        $objectsTypesB2b = new static();
                $objectsTypesB2b->id = $id;
                $objectsTypesB2b->objects_types_id = $objects_types_id;
                $objectsTypesB2b->b2b_id = $b2b_id;
                $objectsTypesB2b->value = $value;
                $objectsTypesB2b->created = $created;
                $objectsTypesB2b->changed = $changed;
        
        return $objectsTypesB2b;
    }

    /**
            * @param int $id//
            * @param int $objects_types_id//
            * @param int $b2b_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsTypesB2b    */
    public function edit($id, $objects_types_id, $b2b_id, $value, $created, $changed): ObjectsTypesB2b
    {

            $this->id = $id;
            $this->objects_types_id = $objects_types_id;
            $this->b2b_id = $b2b_id;
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
            'objects_types_id' => Yii::t('app', 'Objects Types ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
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
    public function getObjectsTypes()
    {
        return $this->hasOne(ObjectsTypes::class, ['id' => 'objects_types_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsTypesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsTypesB2bQuery(get_called_class());
    }
}
