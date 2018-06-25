<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "rents_log".
 *
 * @property int $id
 * @property int $rent_id
 * @property int $user_id
 * @property int $worker_id
 * @property string $change_by
 * @property string $type
 * @property string $sql_data
 * @property string $note_short
 * @property string $created
 *
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class RentsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_log';
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
        * @param int $rent_id//
        * @param int $user_id//
        * @param int $worker_id//
        * @param string $change_by//
        * @param string $type//
        * @param string $sql_data//
        * @param string $note_short//
        * @param string $created//
        * @return RentsLog    */
    public static function create($id, $rent_id, $user_id, $worker_id, $change_by, $type, $sql_data, $note_short, $created): RentsLog
    {
        $rentsLog = new static();
                $rentsLog->id = $id;
                $rentsLog->rent_id = $rent_id;
                $rentsLog->user_id = $user_id;
                $rentsLog->worker_id = $worker_id;
                $rentsLog->change_by = $change_by;
                $rentsLog->type = $type;
                $rentsLog->sql_data = $sql_data;
                $rentsLog->note_short = $note_short;
                $rentsLog->created = $created;
        
        return $rentsLog;
    }

    /**
            * @param int $id//
            * @param int $rent_id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param string $change_by//
            * @param string $type//
            * @param string $sql_data//
            * @param string $note_short//
            * @param string $created//
        * @return RentsLog    */
    public function edit($id, $rent_id, $user_id, $worker_id, $change_by, $type, $sql_data, $note_short, $created): RentsLog
    {

            $this->id = $id;
            $this->rent_id = $rent_id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->change_by = $change_by;
            $this->type = $type;
            $this->sql_data = $sql_data;
            $this->note_short = $note_short;
            $this->created = $created;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'change_by' => Yii::t('app', 'Change By'),
            'type' => Yii::t('app', 'Type'),
            'sql_data' => Yii::t('app', 'Sql Data'),
            'note_short' => Yii::t('app', 'Note Short'),
            'created' => Yii::t('app', 'Created'),
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
     * @return \reception\entities\MyRent\queries\RentsLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsLogQuery(get_called_class());
    }
}
