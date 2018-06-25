<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_settings".
 *
 * @property int $id
 * @property int $user_id
 * @property string $guid
 * @property string $pin
 * @property string $pin_secure
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class UsersSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_settings';
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
        * @param string $guid//
        * @param string $pin//
        * @param string $pin_secure//
        * @param string $created//
        * @param string $changed//
        * @return UsersSettings    */
    public static function create($id, $user_id, $guid, $pin, $pin_secure, $created, $changed): UsersSettings
    {
        $usersSettings = new static();
                $usersSettings->id = $id;
                $usersSettings->user_id = $user_id;
                $usersSettings->guid = $guid;
                $usersSettings->pin = $pin;
                $usersSettings->pin_secure = $pin_secure;
                $usersSettings->created = $created;
                $usersSettings->changed = $changed;
        
        return $usersSettings;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $guid//
            * @param string $pin//
            * @param string $pin_secure//
            * @param string $created//
            * @param string $changed//
        * @return UsersSettings    */
    public function edit($id, $user_id, $guid, $pin, $pin_secure, $created, $changed): UsersSettings
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guid = $guid;
            $this->pin = $pin;
            $this->pin_secure = $pin_secure;
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
            'guid' => Yii::t('app', 'Guid'),
            'pin' => Yii::t('app', 'Pin'),
            'pin_secure' => Yii::t('app', 'Pin Secure'),
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
     * @return \reception\entities\MyRent\queries\UsersSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersSettingsQuery(get_called_class());
    }
}
