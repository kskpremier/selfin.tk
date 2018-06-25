<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Group;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_groups_objects".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $group_id
 * @property int $priority
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property ObjectsGroups $group
 * @property Users $user
 */
class ObjectsGroupsObjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_groups_objects';
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
        * @param int $group_id//
        * @param int $priority//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsGroupsObjects    */
    public static function create($id, $user_id, $object_id, $group_id, $priority, $created, $changed): ObjectsGroupsObjects
    {
        $objectsGroupsObjects = new static();
                $objectsGroupsObjects->id = $id;
                $objectsGroupsObjects->user_id = $user_id;
                $objectsGroupsObjects->object_id = $object_id;
                $objectsGroupsObjects->group_id = $group_id;
                $objectsGroupsObjects->priority = $priority;
                $objectsGroupsObjects->created = $created;
                $objectsGroupsObjects->changed = $changed;
        
        return $objectsGroupsObjects;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $group_id//
            * @param int $priority//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsGroupsObjects    */
    public function edit($id, $user_id, $object_id, $group_id, $priority, $created, $changed): ObjectsGroupsObjects
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->group_id = $group_id;
            $this->priority = $priority;
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
            'group_id' => Yii::t('app', 'Group ID'),
            'priority' => Yii::t('app', 'Priority'),
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
    public function getGroup()
    {
        return $this->hasOne(ObjectsGroups::class, ['id' => 'group_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsGroupsObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsGroupsObjectsQuery(get_called_class());
    }
}
