<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_wspay".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $url
 * @property string $shop_id
 * @property string $secret_key
 * @property string $shopping_cart_id
 * @property string $web_app
 * @property string $web_app_admin
 * @property string $web_app_user
 * @property string $web_app_pass
 * @property string $web_tran
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class UsersWspay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_wspay';
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
        * @param string $type//
        * @param string $url//
        * @param string $shop_id//
        * @param string $secret_key//
        * @param string $shopping_cart_id//
        * @param string $web_app//
        * @param string $web_app_admin//
        * @param string $web_app_user//
        * @param string $web_app_pass//
        * @param string $web_tran//
        * @param string $created//
        * @param string $changed//
        * @return UsersWspay    */
    public static function create($id, $user_id, $type, $url, $shop_id, $secret_key, $shopping_cart_id, $web_app, $web_app_admin, $web_app_user, $web_app_pass, $web_tran, $created, $changed): UsersWspay
    {
        $usersWspay = new static();
                $usersWspay->id = $id;
                $usersWspay->user_id = $user_id;
                $usersWspay->type = $type;
                $usersWspay->url = $url;
                $usersWspay->shop_id = $shop_id;
                $usersWspay->secret_key = $secret_key;
                $usersWspay->shopping_cart_id = $shopping_cart_id;
                $usersWspay->web_app = $web_app;
                $usersWspay->web_app_admin = $web_app_admin;
                $usersWspay->web_app_user = $web_app_user;
                $usersWspay->web_app_pass = $web_app_pass;
                $usersWspay->web_tran = $web_tran;
                $usersWspay->created = $created;
                $usersWspay->changed = $changed;
        
        return $usersWspay;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $type//
            * @param string $url//
            * @param string $shop_id//
            * @param string $secret_key//
            * @param string $shopping_cart_id//
            * @param string $web_app//
            * @param string $web_app_admin//
            * @param string $web_app_user//
            * @param string $web_app_pass//
            * @param string $web_tran//
            * @param string $created//
            * @param string $changed//
        * @return UsersWspay    */
    public function edit($id, $user_id, $type, $url, $shop_id, $secret_key, $shopping_cart_id, $web_app, $web_app_admin, $web_app_user, $web_app_pass, $web_tran, $created, $changed): UsersWspay
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->type = $type;
            $this->url = $url;
            $this->shop_id = $shop_id;
            $this->secret_key = $secret_key;
            $this->shopping_cart_id = $shopping_cart_id;
            $this->web_app = $web_app;
            $this->web_app_admin = $web_app_admin;
            $this->web_app_user = $web_app_user;
            $this->web_app_pass = $web_app_pass;
            $this->web_tran = $web_tran;
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
            'type' => Yii::t('app', 'Type'),
            'url' => Yii::t('app', 'Url'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'secret_key' => Yii::t('app', 'Secret Key'),
            'shopping_cart_id' => Yii::t('app', 'Shopping Cart ID'),
            'web_app' => Yii::t('app', 'Web App'),
            'web_app_admin' => Yii::t('app', 'Web App Admin'),
            'web_app_user' => Yii::t('app', 'Web App User'),
            'web_app_pass' => Yii::t('app', 'Web App Pass'),
            'web_tran' => Yii::t('app', 'Web Tran'),
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
     * @return \reception\entities\MyRent\queries\UsersWspayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersWspayQuery(get_called_class());
    }
}
