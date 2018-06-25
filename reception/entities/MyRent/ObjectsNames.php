<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectType;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsRealestates;

/**
 * This is the model class for table "objects_names".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_type_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsTypes $objectType
 * @property Users $user
 * @property ObjectsRealestates[] $objectsRealestates
 */
class ObjectsNames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_names';
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
        * @param int $object_type_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsNames    */
    public static function create($id, $user_id, $object_type_id, $code, $name, $created, $changed): ObjectsNames
    {
        $objectsNames = new static();
                $objectsNames->id = $id;
                $objectsNames->user_id = $user_id;
                $objectsNames->object_type_id = $object_type_id;
                $objectsNames->code = $code;
                $objectsNames->name = $name;
                $objectsNames->created = $created;
                $objectsNames->changed = $changed;
        
        return $objectsNames;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_type_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsNames    */
    public function edit($id, $user_id, $object_type_id, $code, $name, $created, $changed): ObjectsNames
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_type_id = $object_type_id;
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
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(ObjectsTypes::class, ['id' => 'object_type_id']);
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
    public function getObjectsRealestates()
    {
        return $this->hasMany(ObjectsRealestates::class, ['object_name_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsNamesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsNamesQuery(get_called_class());
    }
}
