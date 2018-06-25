<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesEmailsLogs;
use reception\entities\MyRent\User;
use reception\entities\MyRent\RentsEmailsLogs;

/**
 * This is the model class for table "log_email".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property string $email_from
 * @property string $email_to
 * @property string $cc
 * @property string $bcc
 * @property string $subject
 * @property string $email_status
 * @property string $status_note
 * @property string $body
 * @property resource $atachment
 * @property double $runtime
 * @property string $processed
 * @property string $created
 *
 * @property InvoicesEmailsLog[] $invoicesEmailsLogs
 * @property Users $user
 * @property RentsEmailsLog[] $rentsEmailsLogs
 */
class LogEmail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_email';
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
        * @param string $email_from//
        * @param string $email_to//
        * @param string $cc//
        * @param string $bcc//
        * @param string $subject//
        * @param string $email_status//
        * @param string $status_note//
        * @param string $body//
        * @param resource $atachment//
        * @param double $runtime//
        * @param string $processed//
        * @param string $created//
        * @return LogEmail    */
    public static function create($id, $user_id, $worker_id, $email_from, $email_to, $cc, $bcc, $subject, $email_status, $status_note, $body, $atachment, $runtime, $processed, $created): LogEmail
    {
        $logEmail = new static();
                $logEmail->id = $id;
                $logEmail->user_id = $user_id;
                $logEmail->worker_id = $worker_id;
                $logEmail->email_from = $email_from;
                $logEmail->email_to = $email_to;
                $logEmail->cc = $cc;
                $logEmail->bcc = $bcc;
                $logEmail->subject = $subject;
                $logEmail->email_status = $email_status;
                $logEmail->status_note = $status_note;
                $logEmail->body = $body;
                $logEmail->atachment = $atachment;
                $logEmail->runtime = $runtime;
                $logEmail->processed = $processed;
                $logEmail->created = $created;
        
        return $logEmail;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param string $email_from//
            * @param string $email_to//
            * @param string $cc//
            * @param string $bcc//
            * @param string $subject//
            * @param string $email_status//
            * @param string $status_note//
            * @param string $body//
            * @param resource $atachment//
            * @param double $runtime//
            * @param string $processed//
            * @param string $created//
        * @return LogEmail    */
    public function edit($id, $user_id, $worker_id, $email_from, $email_to, $cc, $bcc, $subject, $email_status, $status_note, $body, $atachment, $runtime, $processed, $created): LogEmail
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->email_from = $email_from;
            $this->email_to = $email_to;
            $this->cc = $cc;
            $this->bcc = $bcc;
            $this->subject = $subject;
            $this->email_status = $email_status;
            $this->status_note = $status_note;
            $this->body = $body;
            $this->atachment = $atachment;
            $this->runtime = $runtime;
            $this->processed = $processed;
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
            'email_from' => Yii::t('app', 'Email From'),
            'email_to' => Yii::t('app', 'Email To'),
            'cc' => Yii::t('app', 'Cc'),
            'bcc' => Yii::t('app', 'Bcc'),
            'subject' => Yii::t('app', 'Subject'),
            'email_status' => Yii::t('app', 'Email Status'),
            'status_note' => Yii::t('app', 'Status Note'),
            'body' => Yii::t('app', 'Body'),
            'atachment' => Yii::t('app', 'Atachment'),
            'runtime' => Yii::t('app', 'Runtime'),
            'processed' => Yii::t('app', 'Processed'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesEmailsLogs()
    {
        return $this->hasMany(InvoicesEmailsLog::class, ['log_email_id' => 'id']);
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
    public function getRentsEmailsLogs()
    {
        return $this->hasMany(RentsEmailsLog::class, ['log_email_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogEmailQuery(get_called_class());
    }
}
