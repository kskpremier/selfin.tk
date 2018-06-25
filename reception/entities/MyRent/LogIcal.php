<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;

/**
 * This is the model class for table "log_ical".
 *
 * @property int $id
 * @property int $object_id
 * @property string $ip_adress
 * @property string $hostname
 * @property string $user_agent
 * @property double $s_runtime
 * @property string $created
 *
 * @property Objects $object
 */
class LogIcal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_ical';
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
        * @param int $object_id//
        * @param string $ip_adress//
        * @param string $hostname//
        * @param string $user_agent//
        * @param double $s_runtime//
        * @param string $created//
        * @return LogIcal    */
    public static function create($id, $object_id, $ip_adress, $hostname, $user_agent, $s_runtime, $created): LogIcal
    {
        $logIcal = new static();
                $logIcal->id = $id;
                $logIcal->object_id = $object_id;
                $logIcal->ip_adress = $ip_adress;
                $logIcal->hostname = $hostname;
                $logIcal->user_agent = $user_agent;
                $logIcal->s_runtime = $s_runtime;
                $logIcal->created = $created;
        
        return $logIcal;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param string $ip_adress//
            * @param string $hostname//
            * @param string $user_agent//
            * @param double $s_runtime//
            * @param string $created//
        * @return LogIcal    */
    public function edit($id, $object_id, $ip_adress, $hostname, $user_agent, $s_runtime, $created): LogIcal
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->ip_adress = $ip_adress;
            $this->hostname = $hostname;
            $this->user_agent = $user_agent;
            $this->s_runtime = $s_runtime;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'ip_adress' => Yii::t('app', 'Ip Adress'),
            'hostname' => Yii::t('app', 'Hostname'),
            'user_agent' => Yii::t('app', 'User Agent'),
            's_runtime' => Yii::t('app', 'S Runtime'),
            'created' => Yii::t('app', 'Created'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogIcalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogIcalQuery(get_called_class());
    }
}
