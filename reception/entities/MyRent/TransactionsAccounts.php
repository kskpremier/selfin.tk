<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "transactions_accounts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name_short
 * @property string $code
 * @property string $name
 * @property string $iban
 * @property string $swift
 * @property string $address
 * @property string $city
 * @property string $city_zip
 * @property int $country_id
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader[] $invoicesHeaders
 * @property Countries $country
 * @property Users $user
 */
class TransactionsAccounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions_accounts';
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
        * @param string $name_short//
        * @param string $code//
        * @param string $name//
        * @param string $iban//
        * @param string $swift//
        * @param string $address//
        * @param string $city//
        * @param string $city_zip//
        * @param int $country_id//
        * @param string $created//
        * @param string $changed//
        * @return TransactionsAccounts    */
    public static function create($id, $user_id, $name_short, $code, $name, $iban, $swift, $address, $city, $city_zip, $country_id, $created, $changed): TransactionsAccounts
    {
        $transactionsAccounts = new static();
                $transactionsAccounts->id = $id;
                $transactionsAccounts->user_id = $user_id;
                $transactionsAccounts->name_short = $name_short;
                $transactionsAccounts->code = $code;
                $transactionsAccounts->name = $name;
                $transactionsAccounts->iban = $iban;
                $transactionsAccounts->swift = $swift;
                $transactionsAccounts->address = $address;
                $transactionsAccounts->city = $city;
                $transactionsAccounts->city_zip = $city_zip;
                $transactionsAccounts->country_id = $country_id;
                $transactionsAccounts->created = $created;
                $transactionsAccounts->changed = $changed;
        
        return $transactionsAccounts;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $name_short//
            * @param string $code//
            * @param string $name//
            * @param string $iban//
            * @param string $swift//
            * @param string $address//
            * @param string $city//
            * @param string $city_zip//
            * @param int $country_id//
            * @param string $created//
            * @param string $changed//
        * @return TransactionsAccounts    */
    public function edit($id, $user_id, $name_short, $code, $name, $iban, $swift, $address, $city, $city_zip, $country_id, $created, $changed): TransactionsAccounts
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->name_short = $name_short;
            $this->code = $code;
            $this->name = $name;
            $this->iban = $iban;
            $this->swift = $swift;
            $this->address = $address;
            $this->city = $city;
            $this->city_zip = $city_zip;
            $this->country_id = $country_id;
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
            'name_short' => Yii::t('app', 'Name Short'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'iban' => Yii::t('app', 'Iban'),
            'swift' => Yii::t('app', 'Swift'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'country_id' => Yii::t('app', 'Country ID'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['transaction_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'country_id']);
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
     * @return \reception\entities\MyRent\queries\TransactionsAccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\TransactionsAccountsQuery(get_called_class());
    }
}
