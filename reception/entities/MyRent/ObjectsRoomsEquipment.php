<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Room;
use reception\entities\MyRent\Feature;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_rooms_equipment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $room_id
 * @property int $feature_id
 * @property int $quantity
 * @property string $description
 * @property string $size
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsRooms $room
 * @property ObjectsRoomsEquipmentFeatures $feature
 * @property Users $user
 */
class ObjectsRoomsEquipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_equipment';
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
        * @param int $room_id//
        * @param int $feature_id//
        * @param int $quantity//
        * @param string $description//
        * @param string $size//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRoomsEquipment    */
    public static function create($id, $user_id, $room_id, $feature_id, $quantity, $description, $size, $created, $changed): ObjectsRoomsEquipment
    {
        $objectsRoomsEquipment = new static();
                $objectsRoomsEquipment->id = $id;
                $objectsRoomsEquipment->user_id = $user_id;
                $objectsRoomsEquipment->room_id = $room_id;
                $objectsRoomsEquipment->feature_id = $feature_id;
                $objectsRoomsEquipment->quantity = $quantity;
                $objectsRoomsEquipment->description = $description;
                $objectsRoomsEquipment->size = $size;
                $objectsRoomsEquipment->created = $created;
                $objectsRoomsEquipment->changed = $changed;
        
        return $objectsRoomsEquipment;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $room_id//
            * @param int $feature_id//
            * @param int $quantity//
            * @param string $description//
            * @param string $size//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRoomsEquipment    */
    public function edit($id, $user_id, $room_id, $feature_id, $quantity, $description, $size, $created, $changed): ObjectsRoomsEquipment
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->room_id = $room_id;
            $this->feature_id = $feature_id;
            $this->quantity = $quantity;
            $this->description = $description;
            $this->size = $size;
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
            'room_id' => Yii::t('app', 'Room ID'),
            'feature_id' => Yii::t('app', 'Feature ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'description' => Yii::t('app', 'Description'),
            'size' => Yii::t('app', 'Size'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(ObjectsRooms::class, ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeature()
    {
        return $this->hasOne(ObjectsRoomsEquipmentFeatures::class, ['id' => 'feature_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRoomsEquipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsEquipmentQuery(get_called_class());
    }
}
