<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "log_sys_jobs".
 *
 * @property int $id
 * @property int $sys_job_id
 * @property string $description
 * @property string $status
 * @property string $start time of start
 * @property string $end time end
 * @property int $elapsed in miliseconds
 * @property string $created
 * @property string $changed
 * @property string $adress
 * @property string $adress_number
 */
class LogSysJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_sys_jobs';
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
        * @param int $sys_job_id//
        * @param string $description//
        * @param string $status//
        * @param string $start// time of start
        * @param string $end// time end
        * @param int $elapsed// in miliseconds
        * @param string $created//
        * @param string $changed//
        * @param string $adress//
        * @param string $adress_number//
        * @return LogSysJobs    */
    public static function create($id, $sys_job_id, $description, $status, $start, $end, $elapsed, $created, $changed, $adress, $adress_number): LogSysJobs
    {
        $logSysJobs = new static();
                $logSysJobs->id = $id;
                $logSysJobs->sys_job_id = $sys_job_id;
                $logSysJobs->description = $description;
                $logSysJobs->status = $status;
                $logSysJobs->start = $start;
                $logSysJobs->end = $end;
                $logSysJobs->elapsed = $elapsed;
                $logSysJobs->created = $created;
                $logSysJobs->changed = $changed;
                $logSysJobs->adress = $adress;
                $logSysJobs->adress_number = $adress_number;
        
        return $logSysJobs;
    }

    /**
            * @param int $id//
            * @param int $sys_job_id//
            * @param string $description//
            * @param string $status//
            * @param string $start// time of start
            * @param string $end// time end
            * @param int $elapsed// in miliseconds
            * @param string $created//
            * @param string $changed//
            * @param string $adress//
            * @param string $adress_number//
        * @return LogSysJobs    */
    public function edit($id, $sys_job_id, $description, $status, $start, $end, $elapsed, $created, $changed, $adress, $adress_number): LogSysJobs
    {

            $this->id = $id;
            $this->sys_job_id = $sys_job_id;
            $this->description = $description;
            $this->status = $status;
            $this->start = $start;
            $this->end = $end;
            $this->elapsed = $elapsed;
            $this->created = $created;
            $this->changed = $changed;
            $this->adress = $adress;
            $this->adress_number = $adress_number;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_job_id' => Yii::t('app', 'Sys Job ID'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'elapsed' => Yii::t('app', 'Elapsed'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
            'adress' => Yii::t('app', 'Adress'),
            'adress_number' => Yii::t('app', 'Adress Number'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogSysJobsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogSysJobsQuery(get_called_class());
    }
}
