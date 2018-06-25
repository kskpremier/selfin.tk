<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\EmailsTemplates;
use reception\entities\MyRent\EmailsTimers;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "emails_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $who
 * @property string $code
 * @property string $name
 * @property string $cc
 * @property string $bcc
 * @property string $created
 * @property string $changed
 *
 * @property EmailsTemplates[] $emailsTemplates
 * @property EmailsTimers[] $emailsTimers
 * @property Users $user
 */
class EmailsTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails_types';
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
        * @param string $who//
        * @param string $code//
        * @param string $name//
        * @param string $cc//
        * @param string $bcc//
        * @param string $created//
        * @param string $changed//
        * @return EmailsTypes    */
    public static function create($id, $user_id, $who, $code, $name, $cc, $bcc, $created, $changed): EmailsTypes
    {
        $emailsTypes = new static();
                $emailsTypes->id = $id;
                $emailsTypes->user_id = $user_id;
                $emailsTypes->who = $who;
                $emailsTypes->code = $code;
                $emailsTypes->name = $name;
                $emailsTypes->cc = $cc;
                $emailsTypes->bcc = $bcc;
                $emailsTypes->created = $created;
                $emailsTypes->changed = $changed;
        
        return $emailsTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $who//
            * @param string $code//
            * @param string $name//
            * @param string $cc//
            * @param string $bcc//
            * @param string $created//
            * @param string $changed//
        * @return EmailsTypes    */
    public function edit($id, $user_id, $who, $code, $name, $cc, $bcc, $created, $changed): EmailsTypes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->who = $who;
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
            'who' => Yii::t('app', 'Who'),
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
    public function getEmailsTemplates()
    {
        return $this->hasMany(EmailsTemplates::class, ['email_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTimers()
    {
        return $this->hasMany(EmailsTimers::class, ['email_type_id' => 'id']);
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
     * @return \reception\entities\MyRent\queries\EmailsTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\EmailsTypesQuery(get_called_class());
    }
}
