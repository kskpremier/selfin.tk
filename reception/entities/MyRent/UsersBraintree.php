<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_braintree".
 *
 * @property int $id
 * @property int $user_id
 * @property string $environment
 * @property string $merchant_id
 * @property string $public_key
 * @property string $private_key
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class UsersBraintree extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_braintree';
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
        * @param string $environment//
        * @param string $merchant_id//
        * @param string $public_key//
        * @param string $private_key//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return UsersBraintree    */
    public static function create($id, $user_id, $environment, $merchant_id, $public_key, $private_key, $enable, $created, $changed): UsersBraintree
    {
        $usersBraintree = new static();
                $usersBraintree->id = $id;
                $usersBraintree->user_id = $user_id;
                $usersBraintree->environment = $environment;
                $usersBraintree->merchant_id = $merchant_id;
                $usersBraintree->public_key = $public_key;
                $usersBraintree->private_key = $private_key;
                $usersBraintree->enable = $enable;
                $usersBraintree->created = $created;
                $usersBraintree->changed = $changed;
        
        return $usersBraintree;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $environment//
            * @param string $merchant_id//
            * @param string $public_key//
            * @param string $private_key//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return UsersBraintree    */
    public function edit($id, $user_id, $environment, $merchant_id, $public_key, $private_key, $enable, $created, $changed): UsersBraintree
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->environment = $environment;
            $this->merchant_id = $merchant_id;
            $this->public_key = $public_key;
            $this->private_key = $private_key;
            $this->enable = $enable;
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
            'environment' => Yii::t('app', 'Environment'),
            'merchant_id' => Yii::t('app', 'Merchant ID'),
            'public_key' => Yii::t('app', 'Public Key'),
            'private_key' => Yii::t('app', 'Private Key'),
            'enable' => Yii::t('app', 'Enable'),
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
     * @return \reception\entities\MyRent\queries\UsersBraintreeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersBraintreeQuery(get_called_class());
    }
}
