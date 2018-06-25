<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_email".
 *
 * @property int $id
 * @property int $user_id
 * @property string $active
 * @property string $from
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $smtp
 * @property int $port
 * @property string $ssl
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class UsersEmail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_email';
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
        * @param string $active//
        * @param string $from//
        * @param string $email//
        * @param string $username//
        * @param string $password//
        * @param string $smtp//
        * @param int $port//
        * @param string $ssl//
        * @param string $created//
        * @param string $changed//
        * @return UsersEmail    */
    public static function create($id, $user_id, $active, $from, $email, $username, $password, $smtp, $port, $ssl, $created, $changed): UsersEmail
    {
        $usersEmail = new static();
                $usersEmail->id = $id;
                $usersEmail->user_id = $user_id;
                $usersEmail->active = $active;
                $usersEmail->from = $from;
                $usersEmail->email = $email;
                $usersEmail->username = $username;
                $usersEmail->password = $password;
                $usersEmail->smtp = $smtp;
                $usersEmail->port = $port;
                $usersEmail->ssl = $ssl;
                $usersEmail->created = $created;
                $usersEmail->changed = $changed;
        
        return $usersEmail;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $active//
            * @param string $from//
            * @param string $email//
            * @param string $username//
            * @param string $password//
            * @param string $smtp//
            * @param int $port//
            * @param string $ssl//
            * @param string $created//
            * @param string $changed//
        * @return UsersEmail    */
    public function edit($id, $user_id, $active, $from, $email, $username, $password, $smtp, $port, $ssl, $created, $changed): UsersEmail
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->active = $active;
            $this->from = $from;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->smtp = $smtp;
            $this->port = $port;
            $this->ssl = $ssl;
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
            'active' => Yii::t('app', 'Active'),
            'from' => Yii::t('app', 'From'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'smtp' => Yii::t('app', 'Smtp'),
            'port' => Yii::t('app', 'Port'),
            'ssl' => Yii::t('app', 'Ssl'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
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
     * @return \reception\entities\MyRent\queries\UsersEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersEmailQuery(get_called_class());
    }
}
