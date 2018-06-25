<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Users;

/**
 * This is the model class for table "users_super".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $adress
 * @property string $city_zip
 * @property string $city_name
 * @property string $vat_id
 * @property string $tax_id
 * @property string $email
 * @property string $tel
 * @property string $web
 * @property string $note
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Users[] $users
 */
class UsersSuper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_super';
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
        * @param string $code//
        * @param string $name//
        * @param string $adress//
        * @param string $city_zip//
        * @param string $city_name//
        * @param string $vat_id//
        * @param string $tax_id//
        * @param string $email//
        * @param string $tel//
        * @param string $web//
        * @param string $note//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return UsersSuper    */
    public static function create($id, $code, $name, $adress, $city_zip, $city_name, $vat_id, $tax_id, $email, $tel, $web, $note, $active, $created, $changed): UsersSuper
    {
        $usersSuper = new static();
                $usersSuper->id = $id;
                $usersSuper->code = $code;
                $usersSuper->name = $name;
                $usersSuper->adress = $adress;
                $usersSuper->city_zip = $city_zip;
                $usersSuper->city_name = $city_name;
                $usersSuper->vat_id = $vat_id;
                $usersSuper->tax_id = $tax_id;
                $usersSuper->email = $email;
                $usersSuper->tel = $tel;
                $usersSuper->web = $web;
                $usersSuper->note = $note;
                $usersSuper->active = $active;
                $usersSuper->created = $created;
                $usersSuper->changed = $changed;
        
        return $usersSuper;
    }

    /**
            * @param int $id//
            * @param string $code//
            * @param string $name//
            * @param string $adress//
            * @param string $city_zip//
            * @param string $city_name//
            * @param string $vat_id//
            * @param string $tax_id//
            * @param string $email//
            * @param string $tel//
            * @param string $web//
            * @param string $note//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return UsersSuper    */
    public function edit($id, $code, $name, $adress, $city_zip, $city_name, $vat_id, $tax_id, $email, $tel, $web, $note, $active, $created, $changed): UsersSuper
    {

            $this->id = $id;
            $this->code = $code;
            $this->name = $name;
            $this->adress = $adress;
            $this->city_zip = $city_zip;
            $this->city_name = $city_name;
            $this->vat_id = $vat_id;
            $this->tax_id = $tax_id;
            $this->email = $email;
            $this->tel = $tel;
            $this->web = $web;
            $this->note = $note;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'adress' => Yii::t('app', 'Adress'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'city_name' => Yii::t('app', 'City Name'),
            'vat_id' => Yii::t('app', 'Vat ID'),
            'tax_id' => Yii::t('app', 'Tax ID'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'web' => Yii::t('app', 'Web'),
            'note' => Yii::t('app', 'Note'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['super_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersSuperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersSuperQuery(get_called_class());
    }
}
