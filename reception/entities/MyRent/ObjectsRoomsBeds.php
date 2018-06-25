<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Room;
use reception\entities\MyRent\BedType;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_rooms_beds".
 *
 * @property int $id
 * @property int $user_id
 * @property int $room_id
 * @property int $bed_type_id
 * @property int $quantity
 * @property int $dimenzion_x
 * @property int $dimenzion_y
 * @property int $persons_optimal
 * @property int $persons_max
 * @property string $picture picure of bed
 * @property string $name
 * @property string $code
 * @property string $description
 * @property string $ceated
 * @property string $changed
 *
 * @property ObjectsRooms $room
 * @property ObjectsRoomsBedsType $bedType
 * @property Users $user
 */
class ObjectsRoomsBeds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_beds';
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
        * @param int $bed_type_id//
        * @param int $quantity//
        * @param int $dimenzion_x//
        * @param int $dimenzion_y//
        * @param int $persons_optimal//
        * @param int $persons_max//
        * @param string $picture// picure of bed
        * @param string $name//
        * @param string $code//
        * @param string $description//
        * @param string $ceated//
        * @param string $changed//
        * @return ObjectsRoomsBeds    */
    public static function create($id, $user_id, $room_id, $bed_type_id, $quantity, $dimenzion_x, $dimenzion_y, $persons_optimal, $persons_max, $picture, $name, $code, $description, $ceated, $changed): ObjectsRoomsBeds
    {
        $objectsRoomsBeds = new static();
                $objectsRoomsBeds->id = $id;
                $objectsRoomsBeds->user_id = $user_id;
                $objectsRoomsBeds->room_id = $room_id;
                $objectsRoomsBeds->bed_type_id = $bed_type_id;
                $objectsRoomsBeds->quantity = $quantity;
                $objectsRoomsBeds->dimenzion_x = $dimenzion_x;
                $objectsRoomsBeds->dimenzion_y = $dimenzion_y;
                $objectsRoomsBeds->persons_optimal = $persons_optimal;
                $objectsRoomsBeds->persons_max = $persons_max;
                $objectsRoomsBeds->picture = $picture;
                $objectsRoomsBeds->name = $name;
                $objectsRoomsBeds->code = $code;
                $objectsRoomsBeds->description = $description;
                $objectsRoomsBeds->ceated = $ceated;
                $objectsRoomsBeds->changed = $changed;
        
        return $objectsRoomsBeds;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $room_id//
            * @param int $bed_type_id//
            * @param int $quantity//
            * @param int $dimenzion_x//
            * @param int $dimenzion_y//
            * @param int $persons_optimal//
            * @param int $persons_max//
            * @param string $picture// picure of bed
            * @param string $name//
            * @param string $code//
            * @param string $description//
            * @param string $ceated//
            * @param string $changed//
        * @return ObjectsRoomsBeds    */
    public function edit($id, $user_id, $room_id, $bed_type_id, $quantity, $dimenzion_x, $dimenzion_y, $persons_optimal, $persons_max, $picture, $name, $code, $description, $ceated, $changed): ObjectsRoomsBeds
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->room_id = $room_id;
            $this->bed_type_id = $bed_type_id;
            $this->quantity = $quantity;
            $this->dimenzion_x = $dimenzion_x;
            $this->dimenzion_y = $dimenzion_y;
            $this->persons_optimal = $persons_optimal;
            $this->persons_max = $persons_max;
            $this->picture = $picture;
            $this->name = $name;
            $this->code = $code;
            $this->description = $description;
            $this->ceated = $ceated;
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
            'bed_type_id' => Yii::t('app', 'Bed Type ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'dimenzion_x' => Yii::t('app', 'Dimenzion X'),
            'dimenzion_y' => Yii::t('app', 'Dimenzion Y'),
            'persons_optimal' => Yii::t('app', 'Persons Optimal'),
            'persons_max' => Yii::t('app', 'Persons Max'),
            'picture' => Yii::t('app', 'Picture'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'description' => Yii::t('app', 'Description'),
            'ceated' => Yii::t('app', 'Ceated'),
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
    public function getBedType()
    {
        return $this->hasOne(ObjectsRoomsBedsType::class, ['id' => 'bed_type_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRoomsBedsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsBedsQuery(get_called_class());
    }
}
