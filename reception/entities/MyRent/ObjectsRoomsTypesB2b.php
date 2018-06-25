<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\RoomsType;

/**
 * This is the model class for table "objects_rooms_types_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $rooms_type_id
 * @property int $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsRoomsTypes $roomsType
 */
class ObjectsRoomsTypesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_types_b2b';
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
        * @param int $rooms_type_id//
        * @param int $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRoomsTypesB2b    */
    public static function create($id, $b2b_id, $rooms_type_id, $value, $created, $changed): ObjectsRoomsTypesB2b
    {
        $objectsRoomsTypesB2b = new static();
                $objectsRoomsTypesB2b->id = $id;
                $objectsRoomsTypesB2b->b2b_id = $b2b_id;
                $objectsRoomsTypesB2b->rooms_type_id = $rooms_type_id;
                $objectsRoomsTypesB2b->value = $value;
                $objectsRoomsTypesB2b->created = $created;
                $objectsRoomsTypesB2b->changed = $changed;
        
        return $objectsRoomsTypesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $rooms_type_id//
            * @param int $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRoomsTypesB2b    */
    public function edit($id, $b2b_id, $rooms_type_id, $value, $created, $changed): ObjectsRoomsTypesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->rooms_type_id = $rooms_type_id;
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
            'rooms_type_id' => Yii::t('app', 'Rooms Type ID'),
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
    public function getRoomsType()
    {
        return $this->hasOne(ObjectsRoomsTypes::class, ['id' => 'rooms_type_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRoomsTypesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsTypesB2bQuery(get_called_class());
    }
}
