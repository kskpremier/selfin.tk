<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\CompanyCountry;
use reception\entities\MyRent\Users;

/**
 * This is the model class for table "resellers".
 *
 * @property int $id
 * @property int $reseller_type_id
 * @property string $name
 * @property string $guid
 * @property string $company_name
 * @property string $company_adress
 * @property string $company_city
 * @property int $company_country_id
 * @property string $tel
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $notes
 * @property string $notes_contract
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Countries $companyCountry
 * @property Users[] $users
 */
class Resellers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resellers';
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
        * @param int $reseller_type_id//
        * @param string $name//
        * @param string $guid//
        * @param string $company_name//
        * @param string $company_adress//
        * @param string $company_city//
        * @param int $company_country_id//
        * @param string $tel//
        * @param string $email//
        * @param string $username//
        * @param string $password//
        * @param string $notes//
        * @param string $notes_contract//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return Resellers    */
    public static function create($id, $reseller_type_id, $name, $guid, $company_name, $company_adress, $company_city, $company_country_id, $tel, $email, $username, $password, $notes, $notes_contract, $active, $created, $changed): Resellers
    {
        $resellers = new static();
                $resellers->id = $id;
                $resellers->reseller_type_id = $reseller_type_id;
                $resellers->name = $name;
                $resellers->guid = $guid;
                $resellers->company_name = $company_name;
                $resellers->company_adress = $company_adress;
                $resellers->company_city = $company_city;
                $resellers->company_country_id = $company_country_id;
                $resellers->tel = $tel;
                $resellers->email = $email;
                $resellers->username = $username;
                $resellers->password = $password;
                $resellers->notes = $notes;
                $resellers->notes_contract = $notes_contract;
                $resellers->active = $active;
                $resellers->created = $created;
                $resellers->changed = $changed;
        
        return $resellers;
    }

    /**
            * @param int $id//
            * @param int $reseller_type_id//
            * @param string $name//
            * @param string $guid//
            * @param string $company_name//
            * @param string $company_adress//
            * @param string $company_city//
            * @param int $company_country_id//
            * @param string $tel//
            * @param string $email//
            * @param string $username//
            * @param string $password//
            * @param string $notes//
            * @param string $notes_contract//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return Resellers    */
    public function edit($id, $reseller_type_id, $name, $guid, $company_name, $company_adress, $company_city, $company_country_id, $tel, $email, $username, $password, $notes, $notes_contract, $active, $created, $changed): Resellers
    {

            $this->id = $id;
            $this->reseller_type_id = $reseller_type_id;
            $this->name = $name;
            $this->guid = $guid;
            $this->company_name = $company_name;
            $this->company_adress = $company_adress;
            $this->company_city = $company_city;
            $this->company_country_id = $company_country_id;
            $this->tel = $tel;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->notes = $notes;
            $this->notes_contract = $notes_contract;
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
            'reseller_type_id' => Yii::t('app', 'Reseller Type ID'),
            'name' => Yii::t('app', 'Name'),
            'guid' => Yii::t('app', 'Guid'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_adress' => Yii::t('app', 'Company Adress'),
            'company_city' => Yii::t('app', 'Company City'),
            'company_country_id' => Yii::t('app', 'Company Country ID'),
            'tel' => Yii::t('app', 'Tel'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'notes' => Yii::t('app', 'Notes'),
            'notes_contract' => Yii::t('app', 'Notes Contract'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'company_country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['reseller_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ResellersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ResellersQuery(get_called_class());
    }
}
