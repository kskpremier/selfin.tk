<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ContantCountry;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_ibans".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $contat_name
 * @property string $contat_address
 * @property string $contat_city
 * @property int $contant_country
 * @property string $bank_name
 * @property string $iban
 * @property string $swift
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Countries $contantCountry
 * @property Users $user
 */
class UsersIbans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_ibans';
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
        * @param string $contat_name//
        * @param string $contat_address//
        * @param string $contat_city//
        * @param int $contant_country//
        * @param string $bank_name//
        * @param string $iban//
        * @param string $swift//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return UsersIbans    */
    public static function create($id, $user_id, $type, $contat_name, $contat_address, $contat_city, $contant_country, $bank_name, $iban, $swift, $active, $created, $changed): UsersIbans
    {
        $usersIbans = new static();
                $usersIbans->id = $id;
                $usersIbans->user_id = $user_id;
                $usersIbans->type = $type;
                $usersIbans->contat_name = $contat_name;
                $usersIbans->contat_address = $contat_address;
                $usersIbans->contat_city = $contat_city;
                $usersIbans->contant_country = $contant_country;
                $usersIbans->bank_name = $bank_name;
                $usersIbans->iban = $iban;
                $usersIbans->swift = $swift;
                $usersIbans->active = $active;
                $usersIbans->created = $created;
                $usersIbans->changed = $changed;
        
        return $usersIbans;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $type//
            * @param string $contat_name//
            * @param string $contat_address//
            * @param string $contat_city//
            * @param int $contant_country//
            * @param string $bank_name//
            * @param string $iban//
            * @param string $swift//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return UsersIbans    */
    public function edit($id, $user_id, $type, $contat_name, $contat_address, $contat_city, $contant_country, $bank_name, $iban, $swift, $active, $created, $changed): UsersIbans
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->type = $type;
            $this->contat_name = $contat_name;
            $this->contat_address = $contat_address;
            $this->contat_city = $contat_city;
            $this->contant_country = $contant_country;
            $this->bank_name = $bank_name;
            $this->iban = $iban;
            $this->swift = $swift;
            $this->active = $active;
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
            'contat_name' => Yii::t('app', 'Contat Name'),
            'contat_address' => Yii::t('app', 'Contat Address'),
            'contat_city' => Yii::t('app', 'Contat City'),
            'contant_country' => Yii::t('app', 'Contant Country'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'iban' => Yii::t('app', 'Iban'),
            'swift' => Yii::t('app', 'Swift'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContantCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'contant_country']);
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
     * @return \reception\entities\MyRent\queries\UsersIbansQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersIbansQuery(get_called_class());
    }
}
