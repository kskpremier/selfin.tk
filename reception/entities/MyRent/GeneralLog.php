<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "general_log".
 *
 * @property string $event_time
 * @property string $user_host
 * @property string $thread_id
 * @property int $server_id
 * @property string $command_type
 * @property string $argument
 */
class GeneralLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general_log';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param string $event_time//
        * @param string $user_host//
        * @param string $thread_id//
        * @param int $server_id//
        * @param string $command_type//
        * @param string $argument//
        * @return GeneralLog    */
    public static function create($event_time, $user_host, $thread_id, $server_id, $command_type, $argument): GeneralLog
    {
        $generalLog = new static();
                $generalLog->event_time = $event_time;
                $generalLog->user_host = $user_host;
                $generalLog->thread_id = $thread_id;
                $generalLog->server_id = $server_id;
                $generalLog->command_type = $command_type;
                $generalLog->argument = $argument;
        
        return $generalLog;
    }

    /**
            * @param string $event_time//
            * @param string $user_host//
            * @param string $thread_id//
            * @param int $server_id//
            * @param string $command_type//
            * @param string $argument//
        * @return GeneralLog    */
    public function edit($event_time, $user_host, $thread_id, $server_id, $command_type, $argument): GeneralLog
    {

            $this->event_time = $event_time;
            $this->user_host = $user_host;
            $this->thread_id = $thread_id;
            $this->server_id = $server_id;
            $this->command_type = $command_type;
            $this->argument = $argument;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'event_time' => Yii::t('app', 'Event Time'),
            'user_host' => Yii::t('app', 'User Host'),
            'thread_id' => Yii::t('app', 'Thread ID'),
            'server_id' => Yii::t('app', 'Server ID'),
            'command_type' => Yii::t('app', 'Command Type'),
            'argument' => Yii::t('app', 'Argument'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\GeneralLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\GeneralLogQuery(get_called_class());
    }
}
