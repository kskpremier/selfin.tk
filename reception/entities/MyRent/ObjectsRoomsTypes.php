<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsRooms;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsRoomsTypesB2bs;

/**
 * This is the model class for table "objects_rooms_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $type
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsRooms[] $objectsRooms
 * @property Users $user
 * @property ObjectsRoomsTypesB2b[] $objectsRoomsTypesB2bs
 */
class ObjectsRoomsTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rooms_types';
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
        * @param string $type//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRoomsTypes    */
    public static function create($id, $user_id, $code, $type, $name, $created, $changed): ObjectsRoomsTypes
    {
        $objectsRoomsTypes = new static();
                $objectsRoomsTypes->id = $id;
                $objectsRoomsTypes->user_id = $user_id;
                $objectsRoomsTypes->code = $code;
                $objectsRoomsTypes->type = $type;
                $objectsRoomsTypes->name = $name;
                $objectsRoomsTypes->created = $created;
                $objectsRoomsTypes->changed = $changed;
        
        return $objectsRoomsTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $type//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRoomsTypes    */
    public function edit($id, $user_id, $code, $type, $name, $created, $changed): ObjectsRoomsTypes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->type = $type;
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
            'code' => Yii::t('app', 'Code'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRooms()
    {
        return $this->hasMany(ObjectsRooms::class, ['type_id' => 'id']);
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
    public function getObjectsRoomsTypesB2bs()
    {
        return $this->hasMany(ObjectsRoomsTypesB2b::class, ['rooms_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRoomsTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRoomsTypesQuery(get_called_class());
    }
}
