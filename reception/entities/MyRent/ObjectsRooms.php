<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Type;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsRoomsAmenities;
use reception\entities\MyRent\ObjectsRoomsB2bs;
use reception\entities\MyRent\ObjectsRoomsBeds;
use reception\entities\MyRent\ObjectsRoomsEquipments;

/**
 * This is the model class for table "objects_rooms".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $type_id
 * @property int $floor_id
 * @property string $code
 * @property string $en_suite_bathroom
 * @property string $en_suite_bathroom_type
 * @property string $name
 * @property int $quantity
 * @property int $toilets
 * @property double $floor on what floor is room
 * @property double $space space in m2
 * @property string $description
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property ObjectsRoomsTypes $type
 * @property Users $user
 * @property ObjectsRoomsAmenities[] $objectsRoomsAmenities
 * @property ObjectsRoomsB2b[] $objectsRoomsB2bs
 * @property ObjectsRoomsBeds[] $objectsRoomsBeds
 * @property ObjectsRoomsEquipment[] $objectsRoomsEquipments
 */
class ObjectsRooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms';
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
        * @param int $type_id//
        * @param int $floor_id//
        * @param string $code//
        * @param string $en_suite_bathroom//
        * @param string $en_suite_bathroom_type//
        * @param string $name//
        * @param int $quantity//
        * @param int $toilets//
        * @param double $floor// on what floor is room
        * @param double $space// space in m2
        * @param string $description//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRooms    */
    public static function create($id, $user_id, $object_id, $type_id, $floor_id, $code, $en_suite_bathroom, $en_suite_bathroom_type, $name, $quantity, $toilets, $floor, $space, $description, $created, $changed): ObjectsRooms
    {
        $objectsRooms = new static();
                $objectsRooms->id = $id;
                $objectsRooms->user_id = $user_id;
                $objectsRooms->object_id = $object_id;
                $objectsRooms->type_id = $type_id;
                $objectsRooms->floor_id = $floor_id;
                $objectsRooms->code = $code;
                $objectsRooms->en_suite_bathroom = $en_suite_bathroom;
                $objectsRooms->en_suite_bathroom_type = $en_suite_bathroom_type;
                $objectsRooms->name = $name;
                $objectsRooms->quantity = $quantity;
                $objectsRooms->toilets = $toilets;
                $objectsRooms->floor = $floor;
                $objectsRooms->space = $space;
                $objectsRooms->description = $description;
                $objectsRooms->created = $created;
                $objectsRooms->changed = $changed;
        
        return $objectsRooms;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $type_id//
            * @param int $floor_id//
            * @param string $code//
            * @param string $en_suite_bathroom//
            * @param string $en_suite_bathroom_type//
            * @param string $name//
            * @param int $quantity//
            * @param int $toilets//
            * @param double $floor// on what floor is room
            * @param double $space// space in m2
            * @param string $description//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRooms    */
    public function edit($id, $user_id, $object_id, $type_id, $floor_id, $code, $en_suite_bathroom, $en_suite_bathroom_type, $name, $quantity, $toilets, $floor, $space, $description, $created, $changed): ObjectsRooms
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->type_id = $type_id;
            $this->floor_id = $floor_id;
            $this->code = $code;
            $this->en_suite_bathroom = $en_suite_bathroom;
            $this->en_suite_bathroom_type = $en_suite_bathroom_type;
            $this->name = $name;
            $this->quantity = $quantity;
            $this->toilets = $toilets;
            $this->floor = $floor;
            $this->space = $space;
            $this->description = $description;
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
            'type_id' => Yii::t('app', 'Type ID'),
            'floor_id' => Yii::t('app', 'Floor ID'),
            'code' => Yii::t('app', 'Code'),
            'en_suite_bathroom' => Yii::t('app', 'En Suite Bathroom'),
            'en_suite_bathroom_type' => Yii::t('app', 'En Suite Bathroom Type'),
            'name' => Yii::t('app', 'Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'toilets' => Yii::t('app', 'Toilets'),
            'floor' => Yii::t('app', 'Floor'),
            'space' => Yii::t('app', 'Space'),
            'description' => Yii::t('app', 'Description'),
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
    public function getType()
    {
        return $this->hasOne(ObjectsRoomsTypes::class, ['id' => 'type_id']);
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
    public function getObjectsRoomsAmenities()
    {
        return $this->hasMany(ObjectsRoomsAmenities::class, ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsB2bs()
    {
        return $this->hasMany(ObjectsRoomsB2b::class, ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsBeds()
    {
        return $this->hasMany(ObjectsRoomsBeds::class, ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsEquipments()
    {
        return $this->hasMany(ObjectsRoomsEquipment::class, ['room_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRoomsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsQuery(get_called_class());
    }
}
