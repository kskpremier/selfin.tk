<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Amenity;
use reception\entities\MyRent\Room;

/**
 * This is the model class for table "objects_rooms_amenities".
 *
 * @property int $id
 * @property int $room_id
 * @property int $amenity_id
 * @property int $picture_id
 * @property string $create
 * @property string $changed
 *
 * @property Amenities $amenity
 * @property ObjectsRooms $room
 */
class ObjectsRoomsAmenities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_amenities';
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
        * @param int $room_id//
        * @param int $amenity_id//
        * @param int $picture_id//
        * @param string $create//
        * @param string $changed//
        * @return ObjectsRoomsAmenities    */
    public static function create($id, $room_id, $amenity_id, $picture_id, $create, $changed): ObjectsRoomsAmenities
    {
        $objectsRoomsAmenities = new static();
                $objectsRoomsAmenities->id = $id;
                $objectsRoomsAmenities->room_id = $room_id;
                $objectsRoomsAmenities->amenity_id = $amenity_id;
                $objectsRoomsAmenities->picture_id = $picture_id;
                $objectsRoomsAmenities->create = $create;
                $objectsRoomsAmenities->changed = $changed;
        
        return $objectsRoomsAmenities;
    }

    /**
            * @param int $id//
            * @param int $room_id//
            * @param int $amenity_id//
            * @param int $picture_id//
            * @param string $create//
            * @param string $changed//
        * @return ObjectsRoomsAmenities    */
    public function edit($id, $room_id, $amenity_id, $picture_id, $create, $changed): ObjectsRoomsAmenities
    {

            $this->id = $id;
            $this->room_id = $room_id;
            $this->amenity_id = $amenity_id;
            $this->picture_id = $picture_id;
            $this->create = $create;
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
            'room_id' => Yii::t('app', 'Room ID'),
            'amenity_id' => Yii::t('app', 'Amenity ID'),
            'picture_id' => Yii::t('app', 'Picture ID'),
            'create' => Yii::t('app', 'Create'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenity()
    {
        return $this->hasOne(Amenities::class, ['id' => 'amenity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(ObjectsRooms::class, ['id' => 'room_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRoomsAmenitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsAmenitiesQuery(get_called_class());
    }
}
