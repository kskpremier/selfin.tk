<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\DoorLock;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_doors_locks".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $door_lock_id
 * @property string $created
 * @property string $changed
 *
 * @property DoorsLocks $doorLock
 * @property Objects $object
 * @property Users $user
 */
class ObjectsDoorsLocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_doors_locks';
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
        * @param int $door_lock_id//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsDoorsLocks    */
    public static function create($id, $user_id, $object_id, $door_lock_id, $created, $changed): ObjectsDoorsLocks
    {
        $objectsDoorsLocks = new static();
                $objectsDoorsLocks->id = $id;
                $objectsDoorsLocks->user_id = $user_id;
                $objectsDoorsLocks->object_id = $object_id;
                $objectsDoorsLocks->door_lock_id = $door_lock_id;
                $objectsDoorsLocks->created = $created;
                $objectsDoorsLocks->changed = $changed;
        
        return $objectsDoorsLocks;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $door_lock_id//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsDoorsLocks    */
    public function edit($id, $user_id, $object_id, $door_lock_id, $created, $changed): ObjectsDoorsLocks
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->door_lock_id = $door_lock_id;
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
            'door_lock_id' => Yii::t('app', 'Door Lock ID'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorsLocks::class, ['id' => 'door_lock_id']);
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsDoorsLocksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsDoorsLocksQuery(get_called_class());
    }
}
