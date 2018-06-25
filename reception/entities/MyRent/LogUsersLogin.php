<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "log_users_login".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property string $action
 * @property string $login_type
 * @property string $http_method
 * @property string $browser
 * @property string $browser_version
 * @property string $browser_type
 * @property string $local is computer local
 * @property string $name local user name
 * @property string $user_agent
 * @property string $mobile_device
 * @property string $mobile_device_model
 * @property string $mobile_device_manufacturer
 * @property string $screen_witdh
 * @property string $screen_height
 * @property string $platform
 * @property string $ip_adress
 * @property string $hostname
 * @property string $created
 *
 * @property Users $user
 * @property Workers $worker
 */
class LogUsersLogin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_users_login';
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
        * @param string $action//
        * @param string $login_type//
        * @param string $http_method//
        * @param string $browser//
        * @param string $browser_version//
        * @param string $browser_type//
        * @param string $local// is computer local
        * @param string $name// local user name
        * @param string $user_agent//
        * @param string $mobile_device//
        * @param string $mobile_device_model//
        * @param string $mobile_device_manufacturer//
        * @param string $screen_witdh//
        * @param string $screen_height//
        * @param string $platform//
        * @param string $ip_adress//
        * @param string $hostname//
        * @param string $created//
        * @return LogUsersLogin    */
    public static function create($id, $user_id, $worker_id, $action, $login_type, $http_method, $browser, $browser_version, $browser_type, $local, $name, $user_agent, $mobile_device, $mobile_device_model, $mobile_device_manufacturer, $screen_witdh, $screen_height, $platform, $ip_adress, $hostname, $created): LogUsersLogin
    {
        $logUsersLogin = new static();
                $logUsersLogin->id = $id;
                $logUsersLogin->user_id = $user_id;
                $logUsersLogin->worker_id = $worker_id;
                $logUsersLogin->action = $action;
                $logUsersLogin->login_type = $login_type;
                $logUsersLogin->http_method = $http_method;
                $logUsersLogin->browser = $browser;
                $logUsersLogin->browser_version = $browser_version;
                $logUsersLogin->browser_type = $browser_type;
                $logUsersLogin->local = $local;
                $logUsersLogin->name = $name;
                $logUsersLogin->user_agent = $user_agent;
                $logUsersLogin->mobile_device = $mobile_device;
                $logUsersLogin->mobile_device_model = $mobile_device_model;
                $logUsersLogin->mobile_device_manufacturer = $mobile_device_manufacturer;
                $logUsersLogin->screen_witdh = $screen_witdh;
                $logUsersLogin->screen_height = $screen_height;
                $logUsersLogin->platform = $platform;
                $logUsersLogin->ip_adress = $ip_adress;
                $logUsersLogin->hostname = $hostname;
                $logUsersLogin->created = $created;
        
        return $logUsersLogin;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param string $action//
            * @param string $login_type//
            * @param string $http_method//
            * @param string $browser//
            * @param string $browser_version//
            * @param string $browser_type//
            * @param string $local// is computer local
            * @param string $name// local user name
            * @param string $user_agent//
            * @param string $mobile_device//
            * @param string $mobile_device_model//
            * @param string $mobile_device_manufacturer//
            * @param string $screen_witdh//
            * @param string $screen_height//
            * @param string $platform//
            * @param string $ip_adress//
            * @param string $hostname//
            * @param string $created//
        * @return LogUsersLogin    */
    public function edit($id, $user_id, $worker_id, $action, $login_type, $http_method, $browser, $browser_version, $browser_type, $local, $name, $user_agent, $mobile_device, $mobile_device_model, $mobile_device_manufacturer, $screen_witdh, $screen_height, $platform, $ip_adress, $hostname, $created): LogUsersLogin
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->action = $action;
            $this->login_type = $login_type;
            $this->http_method = $http_method;
            $this->browser = $browser;
            $this->browser_version = $browser_version;
            $this->browser_type = $browser_type;
            $this->local = $local;
            $this->name = $name;
            $this->user_agent = $user_agent;
            $this->mobile_device = $mobile_device;
            $this->mobile_device_model = $mobile_device_model;
            $this->mobile_device_manufacturer = $mobile_device_manufacturer;
            $this->screen_witdh = $screen_witdh;
            $this->screen_height = $screen_height;
            $this->platform = $platform;
            $this->ip_adress = $ip_adress;
            $this->hostname = $hostname;
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
            'user_id' => Yii::t('app', 'User ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'action' => Yii::t('app', 'Action'),
            'login_type' => Yii::t('app', 'Login Type'),
            'http_method' => Yii::t('app', 'Http Method'),
            'browser' => Yii::t('app', 'Browser'),
            'browser_version' => Yii::t('app', 'Browser Version'),
            'browser_type' => Yii::t('app', 'Browser Type'),
            'local' => Yii::t('app', 'Local'),
            'name' => Yii::t('app', 'Name'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'mobile_device' => Yii::t('app', 'Mobile Device'),
            'mobile_device_model' => Yii::t('app', 'Mobile Device Model'),
            'mobile_device_manufacturer' => Yii::t('app', 'Mobile Device Manufacturer'),
            'screen_witdh' => Yii::t('app', 'Screen Witdh'),
            'screen_height' => Yii::t('app', 'Screen Height'),
            'platform' => Yii::t('app', 'Platform'),
            'ip_adress' => Yii::t('app', 'Ip Adress'),
            'hostname' => Yii::t('app', 'Hostname'),
            'created' => Yii::t('app', 'Created'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogUsersLoginQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogUsersLoginQuery(get_called_class());
    }
}
