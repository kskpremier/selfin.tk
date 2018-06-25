<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Room;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_rooms_b2b".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property int $room_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsRooms $room
 * @property Users $user
 */
class ObjectsRoomsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_b2b';
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
        * @param int $b2b_id//
        * @param int $room_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRoomsB2b    */
    public static function create($id, $user_id, $b2b_id, $room_id, $value, $created, $changed): ObjectsRoomsB2b
    {
        $objectsRoomsB2b = new static();
                $objectsRoomsB2b->id = $id;
                $objectsRoomsB2b->user_id = $user_id;
                $objectsRoomsB2b->b2b_id = $b2b_id;
                $objectsRoomsB2b->room_id = $room_id;
                $objectsRoomsB2b->value = $value;
                $objectsRoomsB2b->created = $created;
                $objectsRoomsB2b->changed = $changed;
        
        return $objectsRoomsB2b;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param int $room_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRoomsB2b    */
    public function edit($id, $user_id, $b2b_id, $room_id, $value, $created, $changed): ObjectsRoomsB2b
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->room_id = $room_id;
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
            'user_id' => Yii::t('app', 'User ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'room_id' => Yii::t('app', 'Room ID'),
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
    public function getRoom()
    {
        return $this->hasOne(ObjectsRooms::class, ['id' => 'room_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRoomsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsB2bQuery(get_called_class());
    }
}
