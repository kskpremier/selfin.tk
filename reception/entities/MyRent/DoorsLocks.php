<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsDoorsLocks;

/**
 * This is the model class for table "doors_locks".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property ObjectsDoorsLocks[] $objectsDoorsLocks
 */
class DoorsLocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doors_locks';
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
        * @param string $created//
        * @param string $changed//
        * @return DoorsLocks    */
    public static function create($id, $user_id, $code, $name, $description, $created, $changed): DoorsLocks
    {
        $doorsLocks = new static();
                $doorsLocks->id = $id;
                $doorsLocks->user_id = $user_id;
                $doorsLocks->code = $code;
                $doorsLocks->name = $name;
                $doorsLocks->description = $description;
                $doorsLocks->created = $created;
                $doorsLocks->changed = $changed;
        
        return $doorsLocks;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $description//
            * @param string $created//
            * @param string $changed//
        * @return DoorsLocks    */
    public function edit($id, $user_id, $code, $name, $description, $created, $changed): DoorsLocks
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDoorsLocks()
    {
        return $this->hasMany(ObjectsDoorsLocks::class, ['door_lock_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\DoorsLocksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\DoorsLocksQuery(get_called_class());
    }
}
