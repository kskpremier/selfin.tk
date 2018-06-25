<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_rooms_floors".
 *
 * @property int $id
 * @property int $user_id
 * @property int $floor
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class ObjectsRoomsFloors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_floors';
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
        * @param int $floor//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRoomsFloors    */
    public static function create($id, $user_id, $floor, $code, $name, $created, $changed): ObjectsRoomsFloors
    {
        $objectsRoomsFloors = new static();
                $objectsRoomsFloors->id = $id;
                $objectsRoomsFloors->user_id = $user_id;
                $objectsRoomsFloors->floor = $floor;
                $objectsRoomsFloors->code = $code;
                $objectsRoomsFloors->name = $name;
                $objectsRoomsFloors->created = $created;
                $objectsRoomsFloors->changed = $changed;
        
        return $objectsRoomsFloors;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $floor//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRoomsFloors    */
    public function edit($id, $user_id, $floor, $code, $name, $created, $changed): ObjectsRoomsFloors
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->floor = $floor;
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
            'floor' => Yii::t('app', 'Floor'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
     * @return \reception\entities\MyRent\queries\ObjectsRoomsFloorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsFloorsQuery(get_called_class());
    }
}
