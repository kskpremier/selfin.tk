<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsRoomsBeds;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_rooms_beds_type".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $dimenzion_x
 * @property int $dimenzion_y
 * @property int $persons_optimal
 * @property int $persons_max
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsRoomsBeds[] $objectsRoomsBeds
 * @property Users $user
 */
class ObjectsRoomsBedsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_beds_type';
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
        * @param string $code//
        * @param string $name//
        * @param string $description//
        * @param int $dimenzion_x//
        * @param int $dimenzion_y//
        * @param int $persons_optimal//
        * @param int $persons_max//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRoomsBedsType    */
    public static function create($id, $user_id, $code, $name, $description, $dimenzion_x, $dimenzion_y, $persons_optimal, $persons_max, $created, $changed): ObjectsRoomsBedsType
    {
        $objectsRoomsBedsType = new static();
                $objectsRoomsBedsType->id = $id;
                $objectsRoomsBedsType->user_id = $user_id;
                $objectsRoomsBedsType->code = $code;
                $objectsRoomsBedsType->name = $name;
                $objectsRoomsBedsType->description = $description;
                $objectsRoomsBedsType->dimenzion_x = $dimenzion_x;
                $objectsRoomsBedsType->dimenzion_y = $dimenzion_y;
                $objectsRoomsBedsType->persons_optimal = $persons_optimal;
                $objectsRoomsBedsType->persons_max = $persons_max;
                $objectsRoomsBedsType->created = $created;
                $objectsRoomsBedsType->changed = $changed;
        
        return $objectsRoomsBedsType;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $description//
            * @param int $dimenzion_x//
            * @param int $dimenzion_y//
            * @param int $persons_optimal//
            * @param int $persons_max//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRoomsBedsType    */
    public function edit($id, $user_id, $code, $name, $description, $dimenzion_x, $dimenzion_y, $persons_optimal, $persons_max, $created, $changed): ObjectsRoomsBedsType
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
            $this->description = $description;
            $this->dimenzion_x = $dimenzion_x;
            $this->dimenzion_y = $dimenzion_y;
            $this->persons_optimal = $persons_optimal;
            $this->persons_max = $persons_max;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'dimenzion_x' => Yii::t('app', 'Dimenzion X'),
            'dimenzion_y' => Yii::t('app', 'Dimenzion Y'),
            'persons_optimal' => Yii::t('app', 'Persons Optimal'),
            'persons_max' => Yii::t('app', 'Persons Max'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsBeds()
    {
        return $this->hasMany(ObjectsRoomsBeds::class, ['bed_type_id' => 'id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRoomsBedsTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsBedsTypeQuery(get_called_class());
    }
}
