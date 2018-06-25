<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_addition_charges_groups".
 *
 * @property int $id
 * @property int $user_id
 * @property int $name
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class ObjectsAdditionChargesGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_addition_charges_groups';
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
        * @param int $name//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsAdditionChargesGroups    */
    public static function create($id, $user_id, $name, $created, $changed): ObjectsAdditionChargesGroups
    {
        $objectsAdditionChargesGroups = new static();
                $objectsAdditionChargesGroups->id = $id;
                $objectsAdditionChargesGroups->user_id = $user_id;
                $objectsAdditionChargesGroups->name = $name;
                $objectsAdditionChargesGroups->created = $created;
                $objectsAdditionChargesGroups->changed = $changed;
        
        return $objectsAdditionChargesGroups;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsAdditionChargesGroups    */
    public function edit($id, $user_id, $name, $created, $changed): ObjectsAdditionChargesGroups
    {

            $this->id = $id;
            $this->user_id = $user_id;
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
     * @return \reception\entities\MyRent\queries\ObjectsAdditionChargesGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsAdditionChargesGroupsQuery(get_called_class());
    }
}
