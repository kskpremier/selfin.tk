<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "rents_workers_log".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property int $rent_id
 * @property string $action
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class RentsWorkersLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_workers_log';
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
        * @param int $worker_id//
        * @param int $rent_id//
        * @param string $action//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return RentsWorkersLog    */
    public static function create($id, $user_id, $worker_id, $rent_id, $action, $note, $created, $changed): RentsWorkersLog
    {
        $rentsWorkersLog = new static();
                $rentsWorkersLog->id = $id;
                $rentsWorkersLog->user_id = $user_id;
                $rentsWorkersLog->worker_id = $worker_id;
                $rentsWorkersLog->rent_id = $rent_id;
                $rentsWorkersLog->action = $action;
                $rentsWorkersLog->note = $note;
                $rentsWorkersLog->created = $created;
                $rentsWorkersLog->changed = $changed;
        
        return $rentsWorkersLog;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param int $rent_id//
            * @param string $action//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return RentsWorkersLog    */
    public function edit($id, $user_id, $worker_id, $rent_id, $action, $note, $created, $changed): RentsWorkersLog
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->rent_id = $rent_id;
            $this->action = $action;
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
            'worker_id' => Yii::t('app', 'Worker ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'action' => Yii::t('app', 'Action'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
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
     * @return \reception\entities\MyRent\queries\RentsWorkersLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsWorkersLogQuery(get_called_class());
    }
}
