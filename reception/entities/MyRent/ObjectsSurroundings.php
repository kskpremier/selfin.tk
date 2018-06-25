<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_surroundings".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $surrounding_id
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 */
class ObjectsSurroundings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_surroundings';
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
        * @param int $surrounding_id//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsSurroundings    */
    public static function create($id, $user_id, $object_id, $surrounding_id, $created, $changed): ObjectsSurroundings
    {
        $objectsSurroundings = new static();
                $objectsSurroundings->id = $id;
                $objectsSurroundings->user_id = $user_id;
                $objectsSurroundings->object_id = $object_id;
                $objectsSurroundings->surrounding_id = $surrounding_id;
                $objectsSurroundings->created = $created;
                $objectsSurroundings->changed = $changed;
        
        return $objectsSurroundings;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $surrounding_id//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsSurroundings    */
    public function edit($id, $user_id, $object_id, $surrounding_id, $created, $changed): ObjectsSurroundings
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->surrounding_id = $surrounding_id;
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
            'surrounding_id' => Yii::t('app', 'Surrounding ID'),
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsSurroundingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsSurroundingsQuery(get_called_class());
    }
}
