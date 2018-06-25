<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Profile;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "profiles_otas".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property int $profile_id
 * @property string $account_id
 * @property string $account_email
 * @property double $percent_price
 * @property string $active
 * @property string $price_sync if price is sync
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Profiles $profile
 * @property Users $user
 */
class ProfilesOtas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles_otas';
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
        * @param int $b2b_id//
        * @param int $profile_id//
        * @param string $account_id//
        * @param string $account_email//
        * @param double $percent_price//
        * @param string $active//
        * @param string $price_sync// if price is sync
        * @param string $created//
        * @param string $changed//
        * @return ProfilesOtas    */
    public static function create($id, $user_id, $b2b_id, $profile_id, $account_id, $account_email, $percent_price, $active, $price_sync, $created, $changed): ProfilesOtas
    {
        $profilesOtas = new static();
                $profilesOtas->id = $id;
                $profilesOtas->user_id = $user_id;
                $profilesOtas->b2b_id = $b2b_id;
                $profilesOtas->profile_id = $profile_id;
                $profilesOtas->account_id = $account_id;
                $profilesOtas->account_email = $account_email;
                $profilesOtas->percent_price = $percent_price;
                $profilesOtas->active = $active;
                $profilesOtas->price_sync = $price_sync;
                $profilesOtas->created = $created;
                $profilesOtas->changed = $changed;
        
        return $profilesOtas;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param int $profile_id//
            * @param string $account_id//
            * @param string $account_email//
            * @param double $percent_price//
            * @param string $active//
            * @param string $price_sync// if price is sync
            * @param string $created//
            * @param string $changed//
        * @return ProfilesOtas    */
    public function edit($id, $user_id, $b2b_id, $profile_id, $account_id, $account_email, $percent_price, $active, $price_sync, $created, $changed): ProfilesOtas
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->profile_id = $profile_id;
            $this->account_id = $account_id;
            $this->account_email = $account_email;
            $this->percent_price = $percent_price;
            $this->active = $active;
            $this->price_sync = $price_sync;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'account_email' => Yii::t('app', 'Account Email'),
            'percent_price' => Yii::t('app', 'Percent Price'),
            'active' => Yii::t('app', 'Active'),
            'price_sync' => Yii::t('app', 'Price Sync'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profiles::class, ['id' => 'profile_id']);
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
     * @return \reception\entities\MyRent\queries\ProfilesOtasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ProfilesOtasQuery(get_called_class());
    }
}
