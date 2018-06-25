<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "log_email_recive".
 *
 * @property int $id
 * @property string $sender
 * @property string $receiver
 * @property string $body
 * @property string $subject
 * @property string $cc
 * @property string $bcc
 * @property string $is_html
 * @property string $created
 * @property string $changed
 */
class LogEmailRecive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_email_recive';
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
        * @param string $sender//
        * @param string $receiver//
        * @param string $body//
        * @param string $subject//
        * @param string $cc//
        * @param string $bcc//
        * @param string $is_html//
        * @param string $created//
        * @param string $changed//
        * @return LogEmailRecive    */
    public static function create($id, $sender, $receiver, $body, $subject, $cc, $bcc, $is_html, $created, $changed): LogEmailRecive
    {
        $logEmailRecive = new static();
                $logEmailRecive->id = $id;
                $logEmailRecive->sender = $sender;
                $logEmailRecive->receiver = $receiver;
                $logEmailRecive->body = $body;
                $logEmailRecive->subject = $subject;
                $logEmailRecive->cc = $cc;
                $logEmailRecive->bcc = $bcc;
                $logEmailRecive->is_html = $is_html;
                $logEmailRecive->created = $created;
                $logEmailRecive->changed = $changed;
        
        return $logEmailRecive;
    }

    /**
            * @param int $id//
            * @param string $sender//
            * @param string $receiver//
            * @param string $body//
            * @param string $subject//
            * @param string $cc//
            * @param string $bcc//
            * @param string $is_html//
            * @param string $created//
            * @param string $changed//
        * @return LogEmailRecive    */
    public function edit($id, $sender, $receiver, $body, $subject, $cc, $bcc, $is_html, $created, $changed): LogEmailRecive
    {

            $this->id = $id;
            $this->sender = $sender;
            $this->receiver = $receiver;
            $this->body = $body;
            $this->subject = $subject;
            $this->cc = $cc;
            $this->bcc = $bcc;
            $this->is_html = $is_html;
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
            'sender' => Yii::t('app', 'Sender'),
            'receiver' => Yii::t('app', 'Receiver'),
            'body' => Yii::t('app', 'Body'),
            'subject' => Yii::t('app', 'Subject'),
            'cc' => Yii::t('app', 'Cc'),
            'bcc' => Yii::t('app', 'Bcc'),
            'is_html' => Yii::t('app', 'Is Html'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogEmailReciveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogEmailReciveQuery(get_called_class());
    }
}
