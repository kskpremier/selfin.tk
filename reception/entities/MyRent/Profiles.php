<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ProfilesOtas;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $beerent
 * @property string $beerent_sync
 * @property string $created
 * @property string $changed
 *
 * @property Objects[] $objects
 * @property Users $user
 * @property ProfilesOtas[] $profilesOtas
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
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
        * @param string $name//
        * @param string $description//
        * @param string $phone//
        * @param string $mobile//
        * @param string $email//
        * @param string $beerent//
        * @param string $beerent_sync//
        * @param string $created//
        * @param string $changed//
        * @return Profiles    */
    public static function create($id, $user_id, $name, $description, $phone, $mobile, $email, $beerent, $beerent_sync, $created, $changed): Profiles
    {
        $profiles = new static();
                $profiles->id = $id;
                $profiles->user_id = $user_id;
                $profiles->name = $name;
                $profiles->description = $description;
                $profiles->phone = $phone;
                $profiles->mobile = $mobile;
                $profiles->email = $email;
                $profiles->beerent = $beerent;
                $profiles->beerent_sync = $beerent_sync;
                $profiles->created = $created;
                $profiles->changed = $changed;
        
        return $profiles;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $name//
            * @param string $description//
            * @param string $phone//
            * @param string $mobile//
            * @param string $email//
            * @param string $beerent//
            * @param string $beerent_sync//
            * @param string $created//
            * @param string $changed//
        * @return Profiles    */
    public function edit($id, $user_id, $name, $description, $phone, $mobile, $email, $beerent, $beerent_sync, $created, $changed): Profiles
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->name = $name;
            $this->description = $description;
            $this->phone = $phone;
            $this->mobile = $mobile;
            $this->email = $email;
            $this->beerent = $beerent;
            $this->beerent_sync = $beerent_sync;
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'beerent' => Yii::t('app', 'Beerent'),
            'beerent_sync' => Yii::t('app', 'Beerent Sync'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['profile_id' => 'id']);
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
    public function getProfilesOtas()
    {
        return $this->hasMany(ProfilesOtas::class, ['profile_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ProfilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ProfilesQuery(get_called_class());
    }
}
