<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Clean;
use reception\entities\MyRent\Cleaner;
use reception\entities\MyRent\Laundry;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Check;
use reception\entities\MyRent\CleanLinen;
use reception\entities\MyRent\CleanNotLinen;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "objects_checks_logs".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $worker_id
 * @property int $check_id
 * @property int $clean_id cleaner
 * @property int $clean_not_linen_id
 * @property int $clean_linen_id
 * @property int $cleaner_id cleanier id
 * @property int $laundry_id lundry_id who chanege
 * @property string $type
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Cleaners $clean
 * @property Cleaners $cleaner
 * @property Laundries $laundry
 * @property Objects $object
 * @property ObjectsChecks $check
 * @property ObjectsCleanLinens $cleanLinen
 * @property ObjectsCleanNotLinens $cleanNotLinen
 * @property Users $user
 * @property Workers $worker
 */
class ObjectsChecksLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_checks_logs';
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
        * @param int $worker_id//
        * @param int $check_id//
        * @param int $clean_id// cleaner
        * @param int $clean_not_linen_id//
        * @param int $clean_linen_id//
        * @param int $cleaner_id// cleanier id
        * @param int $laundry_id// lundry_id who chanege
        * @param string $type//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsChecksLogs    */
    public static function create($id, $user_id, $object_id, $worker_id, $check_id, $clean_id, $clean_not_linen_id, $clean_linen_id, $cleaner_id, $laundry_id, $type, $note, $created, $changed): ObjectsChecksLogs
    {
        $objectsChecksLogs = new static();
                $objectsChecksLogs->id = $id;
                $objectsChecksLogs->user_id = $user_id;
                $objectsChecksLogs->object_id = $object_id;
                $objectsChecksLogs->worker_id = $worker_id;
                $objectsChecksLogs->check_id = $check_id;
                $objectsChecksLogs->clean_id = $clean_id;
                $objectsChecksLogs->clean_not_linen_id = $clean_not_linen_id;
                $objectsChecksLogs->clean_linen_id = $clean_linen_id;
                $objectsChecksLogs->cleaner_id = $cleaner_id;
                $objectsChecksLogs->laundry_id = $laundry_id;
                $objectsChecksLogs->type = $type;
                $objectsChecksLogs->note = $note;
                $objectsChecksLogs->created = $created;
                $objectsChecksLogs->changed = $changed;
        
        return $objectsChecksLogs;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $worker_id//
            * @param int $check_id//
            * @param int $clean_id// cleaner
            * @param int $clean_not_linen_id//
            * @param int $clean_linen_id//
            * @param int $cleaner_id// cleanier id
            * @param int $laundry_id// lundry_id who chanege
            * @param string $type//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsChecksLogs    */
    public function edit($id, $user_id, $object_id, $worker_id, $check_id, $clean_id, $clean_not_linen_id, $clean_linen_id, $cleaner_id, $laundry_id, $type, $note, $created, $changed): ObjectsChecksLogs
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->worker_id = $worker_id;
            $this->check_id = $check_id;
            $this->clean_id = $clean_id;
            $this->clean_not_linen_id = $clean_not_linen_id;
            $this->clean_linen_id = $clean_linen_id;
            $this->cleaner_id = $cleaner_id;
            $this->laundry_id = $laundry_id;
            $this->type = $type;
            $this->note = $note;
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
            'worker_id' => Yii::t('app', 'Worker ID'),
            'check_id' => Yii::t('app', 'Check ID'),
            'clean_id' => Yii::t('app', 'Clean ID'),
            'clean_not_linen_id' => Yii::t('app', 'Clean Not Linen ID'),
            'clean_linen_id' => Yii::t('app', 'Clean Linen ID'),
            'cleaner_id' => Yii::t('app', 'Cleaner ID'),
            'laundry_id' => Yii::t('app', 'Laundry ID'),
            'type' => Yii::t('app', 'Type'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClean()
    {
        return $this->hasOne(Cleaners::class, ['id' => 'clean_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaner()
    {
        return $this->hasOne(Cleaners::class, ['id' => 'cleaner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaundry()
    {
        return $this->hasOne(Laundries::class, ['id' => 'laundry_id']);
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
    public function getCleanNotLinen()
    {
        return $this->hasOne(ObjectsCleanNotLinens::class, ['id' => 'clean_not_linen_id']);
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
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsChecksLogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsChecksLogsQuery(get_called_class());
    }
}
