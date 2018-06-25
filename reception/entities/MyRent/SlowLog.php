<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "slow_log".
 *
 * @property string $start_time
 * @property string $user_host
 * @property string $query_time
 * @property string $lock_time
 * @property int $rows_sent
 * @property int $rows_examined
 * @property string $db
 * @property int $last_insert_id
 * @property int $insert_id
 * @property int $server_id
 * @property string $sql_text
 * @property string $thread_id
 */
class SlowLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slow_log';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param string $start_time//
        * @param string $user_host//
        * @param string $query_time//
        * @param string $lock_time//
        * @param int $rows_sent//
        * @param int $rows_examined//
        * @param string $db//
        * @param int $last_insert_id//
        * @param int $insert_id//
        * @param int $server_id//
        * @param string $sql_text//
        * @param string $thread_id//
        * @return SlowLog    */
    public static function create($start_time, $user_host, $query_time, $lock_time, $rows_sent, $rows_examined, $db, $last_insert_id, $insert_id, $server_id, $sql_text, $thread_id): SlowLog
    {
        $slowLog = new static();
                $slowLog->start_time = $start_time;
                $slowLog->user_host = $user_host;
                $slowLog->query_time = $query_time;
                $slowLog->lock_time = $lock_time;
                $slowLog->rows_sent = $rows_sent;
                $slowLog->rows_examined = $rows_examined;
                $slowLog->db = $db;
                $slowLog->last_insert_id = $last_insert_id;
                $slowLog->insert_id = $insert_id;
                $slowLog->server_id = $server_id;
                $slowLog->sql_text = $sql_text;
                $slowLog->thread_id = $thread_id;
        
        return $slowLog;
    }

    /**
            * @param string $start_time//
            * @param string $user_host//
            * @param string $query_time//
            * @param string $lock_time//
            * @param int $rows_sent//
            * @param int $rows_examined//
            * @param string $db//
            * @param int $last_insert_id//
            * @param int $insert_id//
            * @param int $server_id//
            * @param string $sql_text//
            * @param string $thread_id//
        * @return SlowLog    */
    public function edit($start_time, $user_host, $query_time, $lock_time, $rows_sent, $rows_examined, $db, $last_insert_id, $insert_id, $server_id, $sql_text, $thread_id): SlowLog
    {

            $this->start_time = $start_time;
            $this->user_host = $user_host;
            $this->query_time = $query_time;
            $this->lock_time = $lock_time;
            $this->rows_sent = $rows_sent;
            $this->rows_examined = $rows_examined;
            $this->db = $db;
            $this->last_insert_id = $last_insert_id;
            $this->insert_id = $insert_id;
            $this->server_id = $server_id;
            $this->sql_text = $sql_text;
            $this->thread_id = $thread_id;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'start_time' => Yii::t('app', 'Start Time'),
            'user_host' => Yii::t('app', 'User Host'),
            'query_time' => Yii::t('app', 'Query Time'),
            'lock_time' => Yii::t('app', 'Lock Time'),
            'rows_sent' => Yii::t('app', 'Rows Sent'),
            'rows_examined' => Yii::t('app', 'Rows Examined'),
            'db' => Yii::t('app', 'Db'),
            'last_insert_id' => Yii::t('app', 'Last Insert ID'),
            'insert_id' => Yii::t('app', 'Insert ID'),
            'server_id' => Yii::t('app', 'Server ID'),
            'sql_text' => Yii::t('app', 'Sql Text'),
            'thread_id' => Yii::t('app', 'Thread ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\SlowLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\SlowLogQuery(get_called_class());
    }
}
