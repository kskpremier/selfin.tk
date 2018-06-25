<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\EmailType;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "emails_templates".
 *
 * @property int $id
 * @property int $user_id
 * @property int $language_id
 * @property int $email_type_id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $subject
 * @property string $cc
 * @property string $bcc
 * @property string $body
 * @property string $created
 * @property string $changed
 *
 * @property EmailsTypes $emailType
 * @property Languages $language
 * @property Users $user
 */
class EmailsTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails_templates';
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
        * @param int $language_id//
        * @param int $email_type_id//
        * @param string $type//
        * @param string $code//
        * @param string $name//
        * @param string $subject//
        * @param string $cc//
        * @param string $bcc//
        * @param string $body//
        * @param string $created//
        * @param string $changed//
        * @return EmailsTemplates    */
    public static function create($id, $user_id, $language_id, $email_type_id, $type, $code, $name, $subject, $cc, $bcc, $body, $created, $changed): EmailsTemplates
    {
        $emailsTemplates = new static();
                $emailsTemplates->id = $id;
                $emailsTemplates->user_id = $user_id;
                $emailsTemplates->language_id = $language_id;
                $emailsTemplates->email_type_id = $email_type_id;
                $emailsTemplates->type = $type;
                $emailsTemplates->code = $code;
                $emailsTemplates->name = $name;
                $emailsTemplates->subject = $subject;
                $emailsTemplates->cc = $cc;
                $emailsTemplates->bcc = $bcc;
                $emailsTemplates->body = $body;
                $emailsTemplates->created = $created;
                $emailsTemplates->changed = $changed;
        
        return $emailsTemplates;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $language_id//
            * @param int $email_type_id//
            * @param string $type//
            * @param string $code//
            * @param string $name//
            * @param string $subject//
            * @param string $cc//
            * @param string $bcc//
            * @param string $body//
            * @param string $created//
            * @param string $changed//
        * @return EmailsTemplates    */
    public function edit($id, $user_id, $language_id, $email_type_id, $type, $code, $name, $subject, $cc, $bcc, $body, $created, $changed): EmailsTemplates
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->language_id = $language_id;
            $this->email_type_id = $email_type_id;
            $this->type = $type;
            $this->code = $code;
            $this->name = $name;
            $this->subject = $subject;
            $this->cc = $cc;
            $this->bcc = $bcc;
            $this->body = $body;
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
            'language_id' => Yii::t('app', 'Language ID'),
            'email_type_id' => Yii::t('app', 'Email Type ID'),
            'type' => Yii::t('app', 'Type'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'subject' => Yii::t('app', 'Subject'),
            'cc' => Yii::t('app', 'Cc'),
            'bcc' => Yii::t('app', 'Bcc'),
            'body' => Yii::t('app', 'Body'),
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
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
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
     * @return \reception\entities\MyRent\queries\EmailsTemplatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\EmailsTemplatesQuery(get_called_class());
    }
}
