<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "log_sms".
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $number
 * @property string $message
 * @property string $url
 * @property string $response
 * @property string $created
 *
 * @property Users $user
 */
class LogSms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_sms';
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
        * @param string $provider//
        * @param string $number//
        * @param string $message//
        * @param string $url//
        * @param string $response//
        * @param string $created//
        * @return LogSms    */
    public static function create($id, $user_id, $provider, $number, $message, $url, $response, $created): LogSms
    {
        $logSms = new static();
                $logSms->id = $id;
                $logSms->user_id = $user_id;
                $logSms->provider = $provider;
                $logSms->number = $number;
                $logSms->message = $message;
                $logSms->url = $url;
                $logSms->response = $response;
                $logSms->created = $created;
        
        return $logSms;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $provider//
            * @param string $number//
            * @param string $message//
            * @param string $url//
            * @param string $response//
            * @param string $created//
        * @return LogSms    */
    public function edit($id, $user_id, $provider, $number, $message, $url, $response, $created): LogSms
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->provider = $provider;
            $this->number = $number;
            $this->message = $message;
            $this->url = $url;
            $this->response = $response;
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
            'provider' => Yii::t('app', 'Provider'),
            'number' => Yii::t('app', 'Number'),
            'message' => Yii::t('app', 'Message'),
            'url' => Yii::t('app', 'Url'),
            'response' => Yii::t('app', 'Response'),
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
     * @return \reception\entities\MyRent\queries\LogSmsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogSmsQuery(get_called_class());
    }
}
