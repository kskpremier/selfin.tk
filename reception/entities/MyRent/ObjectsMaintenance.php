<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Check;
use reception\entities\MyRent\CleanLinen;
use reception\entities\MyRent\NotCleanLinen;
use reception\entities\MyRent\Clean;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_maintenance".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $check_id
 * @property int $clean_id
 * @property int $clean_linen_id
 * @property int $not_clean_linen_id
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property ObjectsChecks $check
 * @property ObjectsCleanLinens $cleanLinen
 * @property ObjectsCleanNotLinens $notCleanLinen
 * @property ObjectsCleans $clean
 * @property Users $user
 */
class ObjectsMaintenance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_maintenance';
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
        * @param int $check_id//
        * @param int $clean_id//
        * @param int $clean_linen_id//
        * @param int $not_clean_linen_id//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsMaintenance    */
    public static function create($id, $user_id, $object_id, $check_id, $clean_id, $clean_linen_id, $not_clean_linen_id, $created, $changed): ObjectsMaintenance
    {
        $objectsMaintenance = new static();
                $objectsMaintenance->id = $id;
                $objectsMaintenance->user_id = $user_id;
                $objectsMaintenance->object_id = $object_id;
                $objectsMaintenance->check_id = $check_id;
                $objectsMaintenance->clean_id = $clean_id;
                $objectsMaintenance->clean_linen_id = $clean_linen_id;
                $objectsMaintenance->not_clean_linen_id = $not_clean_linen_id;
                $objectsMaintenance->created = $created;
                $objectsMaintenance->changed = $changed;
        
        return $objectsMaintenance;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $check_id//
            * @param int $clean_id//
            * @param int $clean_linen_id//
            * @param int $not_clean_linen_id//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsMaintenance    */
    public function edit($id, $user_id, $object_id, $check_id, $clean_id, $clean_linen_id, $not_clean_linen_id, $created, $changed): ObjectsMaintenance
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->check_id = $check_id;
            $this->clean_id = $clean_id;
            $this->clean_linen_id = $clean_linen_id;
            $this->not_clean_linen_id = $not_clean_linen_id;
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
            'check_id' => Yii::t('app', 'Check ID'),
            'clean_id' => Yii::t('app', 'Clean ID'),
            'clean_linen_id' => Yii::t('app', 'Clean Linen ID'),
            'not_clean_linen_id' => Yii::t('app', 'Not Clean Linen ID'),
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
    public function getCheck()
    {
        return $this->hasOne(ObjectsChecks::class, ['id' => 'check_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleanLinen()
    {
        return $this->hasOne(ObjectsCleanLinens::class, ['id' => 'clean_linen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotCleanLinen()
    {
        return $this->hasOne(ObjectsCleanNotLinens::class, ['id' => 'not_clean_linen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClean()
    {
        return $this->hasOne(ObjectsCleans::class, ['id' => 'clean_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsMaintenanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsMaintenanceQuery(get_called_class());
    }
}
