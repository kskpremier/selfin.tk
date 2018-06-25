<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "log_rents_cards".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property int $rent_id
 * @property string $status
 * @property string $request
 * @property string $agent
 * @property string $ip_adress
 * @property string $hostname
 * @property string $browser
 * @property string $browser_version
 * @property string $system_pin
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class LogRentsCards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_rents_cards';
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
        * @param string $status//
        * @param string $request//
        * @param string $agent//
        * @param string $ip_adress//
        * @param string $hostname//
        * @param string $browser//
        * @param string $browser_version//
        * @param string $system_pin//
        * @param string $created//
        * @param string $changed//
        * @return LogRentsCards    */
    public static function create($id, $user_id, $worker_id, $rent_id, $status, $request, $agent, $ip_adress, $hostname, $browser, $browser_version, $system_pin, $created, $changed): LogRentsCards
    {
        $logRentsCards = new static();
                $logRentsCards->id = $id;
                $logRentsCards->user_id = $user_id;
                $logRentsCards->worker_id = $worker_id;
                $logRentsCards->rent_id = $rent_id;
                $logRentsCards->status = $status;
                $logRentsCards->request = $request;
                $logRentsCards->agent = $agent;
                $logRentsCards->ip_adress = $ip_adress;
                $logRentsCards->hostname = $hostname;
                $logRentsCards->browser = $browser;
                $logRentsCards->browser_version = $browser_version;
                $logRentsCards->system_pin = $system_pin;
                $logRentsCards->created = $created;
                $logRentsCards->changed = $changed;
        
        return $logRentsCards;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param int $rent_id//
            * @param string $status//
            * @param string $request//
            * @param string $agent//
            * @param string $ip_adress//
            * @param string $hostname//
            * @param string $browser//
            * @param string $browser_version//
            * @param string $system_pin//
            * @param string $created//
            * @param string $changed//
        * @return LogRentsCards    */
    public function edit($id, $user_id, $worker_id, $rent_id, $status, $request, $agent, $ip_adress, $hostname, $browser, $browser_version, $system_pin, $created, $changed): LogRentsCards
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->rent_id = $rent_id;
            $this->status = $status;
            $this->request = $request;
            $this->agent = $agent;
            $this->ip_adress = $ip_adress;
            $this->hostname = $hostname;
            $this->browser = $browser;
            $this->browser_version = $browser_version;
            $this->system_pin = $system_pin;
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
            'status' => Yii::t('app', 'Status'),
            'request' => Yii::t('app', 'Request'),
            'agent' => Yii::t('app', 'Agent'),
            'ip_adress' => Yii::t('app', 'Ip Adress'),
            'hostname' => Yii::t('app', 'Hostname'),
            'browser' => Yii::t('app', 'Browser'),
            'browser_version' => Yii::t('app', 'Browser Version'),
            'system_pin' => Yii::t('app', 'System Pin'),
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
     * @return \reception\entities\MyRent\queries\LogRentsCardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogRentsCardsQuery(get_called_class());
    }
}
