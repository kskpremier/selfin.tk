<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\EmailType;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "emails_timers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $email_type_id
 * @property string $who
 * @property string $when on what event
 * @property int $offset time offset
 * @property string $code
 * @property string $name
 * @property string $cc
 * @property string $bcc
 * @property string $created
 * @property string $changed
 *
 * @property EmailsTypes $emailType
 * @property Users $user
 */
class EmailsTimers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails_timers';
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
        * @param int $email_type_id//
        * @param string $who//
        * @param string $when// on what event
        * @param int $offset// time offset
        * @param string $code//
        * @param string $name//
        * @param string $cc//
        * @param string $bcc//
        * @param string $created//
        * @param string $changed//
        * @return EmailsTimers    */
    public static function create($id, $user_id, $email_type_id, $who, $when, $offset, $code, $name, $cc, $bcc, $created, $changed): EmailsTimers
    {
        $emailsTimers = new static();
                $emailsTimers->id = $id;
                $emailsTimers->user_id = $user_id;
                $emailsTimers->email_type_id = $email_type_id;
                $emailsTimers->who = $who;
                $emailsTimers->when = $when;
                $emailsTimers->offset = $offset;
                $emailsTimers->code = $code;
                $emailsTimers->name = $name;
                $emailsTimers->cc = $cc;
                $emailsTimers->bcc = $bcc;
                $emailsTimers->created = $created;
                $emailsTimers->changed = $changed;
        
        return $emailsTimers;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $email_type_id//
            * @param string $who//
            * @param string $when// on what event
            * @param int $offset// time offset
            * @param string $code//
            * @param string $name//
            * @param string $cc//
            * @param string $bcc//
            * @param string $created//
            * @param string $changed//
        * @return EmailsTimers    */
    public function edit($id, $user_id, $email_type_id, $who, $when, $offset, $code, $name, $cc, $bcc, $created, $changed): EmailsTimers
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->email_type_id = $email_type_id;
            $this->who = $who;
            $this->when = $when;
            $this->offset = $offset;
            $this->code = $code;
            $this->name = $name;
            $this->cc = $cc;
            $this->bcc = $bcc;
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
            'email_type_id' => Yii::t('app', 'Email Type ID'),
            'who' => Yii::t('app', 'Who'),
            'when' => Yii::t('app', 'When'),
            'offset' => Yii::t('app', 'Offset'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'cc' => Yii::t('app', 'Cc'),
            'bcc' => Yii::t('app', 'Bcc'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailType()
    {
        return $this->hasOne(EmailsTypes::class, ['id' => 'email_type_id']);
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
     * @return \reception\entities\MyRent\queries\EmailsTimersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\EmailsTimersQuery(get_called_class());
    }
}
