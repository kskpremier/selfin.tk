<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_guests".
 *
 * @property int $id
 * @property int $user_id
 * @property int $guest_type_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class UsersGuests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_guests';
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
        * @param int $guest_type_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return UsersGuests    */
    public static function create($id, $user_id, $guest_type_id, $code, $name, $created, $changed): UsersGuests
    {
        $usersGuests = new static();
                $usersGuests->id = $id;
                $usersGuests->user_id = $user_id;
                $usersGuests->guest_type_id = $guest_type_id;
                $usersGuests->code = $code;
                $usersGuests->name = $name;
                $usersGuests->created = $created;
                $usersGuests->changed = $changed;
        
        return $usersGuests;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $guest_type_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return UsersGuests    */
    public function edit($id, $user_id, $guest_type_id, $code, $name, $created, $changed): UsersGuests
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guest_type_id = $guest_type_id;
            $this->code = $code;
            $this->name = $name;
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
            'guest_type_id' => Yii::t('app', 'Guest Type ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
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
     * @return \reception\entities\MyRent\queries\UsersGuestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersGuestsQuery(get_called_class());
    }
}
