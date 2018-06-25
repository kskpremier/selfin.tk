<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;
use reception\entities\MyRent\FriendUser;
use reception\entities\MyRent\FriendsRents;

/**
 * This is the model class for table "friends".
 *
 * @property int $id
 * @property int $user_id usres see friends objects
 * @property int $friend_user_id friends is sharing with user
 * @property int $object_id friends is sharing wiht user objects
 * @property string $active
 * @property string $created
 *
 * @property Objects $object
 * @property Users $user
 * @property Users $friendUser
 * @property FriendsRents[] $friendsRents
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends';
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
        * @param int $user_id// usres see friends objects
        * @param int $friend_user_id// friends is sharing with user
        * @param int $object_id// friends is sharing wiht user objects
        * @param string $active//
        * @param string $created//
        * @return Friends    */
    public static function create($id, $user_id, $friend_user_id, $object_id, $active, $created): Friends
    {
        $friends = new static();
                $friends->id = $id;
                $friends->user_id = $user_id;
                $friends->friend_user_id = $friend_user_id;
                $friends->object_id = $object_id;
                $friends->active = $active;
                $friends->created = $created;
        
        return $friends;
    }

    /**
            * @param int $id//
            * @param int $user_id// usres see friends objects
            * @param int $friend_user_id// friends is sharing with user
            * @param int $object_id// friends is sharing wiht user objects
            * @param string $active//
            * @param string $created//
        * @return Friends    */
    public function edit($id, $user_id, $friend_user_id, $object_id, $active, $created): Friends
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->friend_user_id = $friend_user_id;
            $this->object_id = $object_id;
            $this->active = $active;
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
            'friend_user_id' => Yii::t('app', 'Friend User ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
    public function getFriendUser()
    {
        return $this->hasOne(Users::class, ['id' => 'friend_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriendsRents()
    {
        return $this->hasMany(FriendsRents::class, ['friend_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\FriendsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\FriendsQuery(get_called_class());
    }
}
