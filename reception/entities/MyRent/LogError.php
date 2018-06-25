<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "log_error".
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $innerexception
 * @property string $user_agent
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $http_exception
 * @property string $http_code
 * @property string $file
 * @property string $file_version
 * @property string $created
 *
 * @property Users $user
 */
class LogError extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_error';
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
        * @param string $message//
        * @param string $innerexception//
        * @param string $user_agent//
        * @param string $module//
        * @param string $controller//
        * @param string $action//
        * @param string $http_exception//
        * @param string $http_code//
        * @param string $file//
        * @param string $file_version//
        * @param string $created//
        * @return LogError    */
    public static function create($id, $user_id, $message, $innerexception, $user_agent, $module, $controller, $action, $http_exception, $http_code, $file, $file_version, $created): LogError
    {
        $logError = new static();
                $logError->id = $id;
                $logError->user_id = $user_id;
                $logError->message = $message;
                $logError->innerexception = $innerexception;
                $logError->user_agent = $user_agent;
                $logError->module = $module;
                $logError->controller = $controller;
                $logError->action = $action;
                $logError->http_exception = $http_exception;
                $logError->http_code = $http_code;
                $logError->file = $file;
                $logError->file_version = $file_version;
                $logError->created = $created;
        
        return $logError;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $message//
            * @param string $innerexception//
            * @param string $user_agent//
            * @param string $module//
            * @param string $controller//
            * @param string $action//
            * @param string $http_exception//
            * @param string $http_code//
            * @param string $file//
            * @param string $file_version//
            * @param string $created//
        * @return LogError    */
    public function edit($id, $user_id, $message, $innerexception, $user_agent, $module, $controller, $action, $http_exception, $http_code, $file, $file_version, $created): LogError
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->message = $message;
            $this->innerexception = $innerexception;
            $this->user_agent = $user_agent;
            $this->module = $module;
            $this->controller = $controller;
            $this->action = $action;
            $this->http_exception = $http_exception;
            $this->http_code = $http_code;
            $this->file = $file;
            $this->file_version = $file_version;
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
            'message' => Yii::t('app', 'Message'),
            'innerexception' => Yii::t('app', 'Innerexception'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'module' => Yii::t('app', 'Module'),
            'controller' => Yii::t('app', 'Controller'),
            'action' => Yii::t('app', 'Action'),
            'http_exception' => Yii::t('app', 'Http Exception'),
            'http_code' => Yii::t('app', 'Http Code'),
            'file' => Yii::t('app', 'File'),
            'file_version' => Yii::t('app', 'File Version'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogErrorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogErrorQuery(get_called_class());
    }
}
