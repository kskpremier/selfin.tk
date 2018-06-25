<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\CustomerGroup;
use reception\entities\MyRent\User;
use reception\entities\MyRent\CustomersB2bs;
use reception\entities\MyRent\CustomersObjects;
use reception\entities\MyRent\CustomersPrices;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\ObjectsPricesDaysCustomers;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsGroups;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_group_id
 * @property string $type
 * @property string $code
 * @property double $partner_discount partner discount for selling 
 * @property string $username
 * @property string $password
 * @property string $guid
 * @property string $color
 * @property string $name
 * @property string $address
 * @property string $city_name
 * @property string $city_zip
 * @property string $vat_id id of customer
 * @property string $mb
 * @property string $oib
 * @property string $note
 * @property string $note_invoice
 * @property string $contact_name
 * @property string $facebook
 * @property string $skype
 * @property string $contact_tel
 * @property string $contact_email
 * @property int $country_id
 * @property string $favourite
 * @property string $partner
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Countries $country
 * @property CustomersGroups $customerGroup
 * @property Users $user
 * @property CustomersB2b[] $customersB2bs
 * @property CustomersObjects[] $customersObjects
 * @property CustomersPrices[] $customersPrices
 * @property InvoicesHeader[] $invoicesHeaders
 * @property ObjectsPricesDaysCustomers[] $objectsPricesDaysCustomers
 * @property Rents[] $rents
 * @property RentsGroups[] $rentsGroups
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
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
        * @param int $customer_group_id//
        * @param string $type//
        * @param string $code//
        * @param double $partner_discount// partner discount for selling 
        * @param string $username//
        * @param string $password//
        * @param string $guid//
        * @param string $color//
        * @param string $name//
        * @param string $address//
        * @param string $city_name//
        * @param string $city_zip//
        * @param string $vat_id// id of customer
        * @param string $mb//
        * @param string $oib//
        * @param string $note//
        * @param string $note_invoice//
        * @param string $contact_name//
        * @param string $facebook//
        * @param string $skype//
        * @param string $contact_tel//
        * @param string $contact_email//
        * @param int $country_id//
        * @param string $favourite//
        * @param string $partner//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return Customers    */
    public static function create($id, $user_id, $customer_group_id, $type, $code, $partner_discount, $username, $password, $guid, $color, $name, $address, $city_name, $city_zip, $vat_id, $mb, $oib, $note, $note_invoice, $contact_name, $facebook, $skype, $contact_tel, $contact_email, $country_id, $favourite, $partner, $active, $created, $changed): Customers
    {
        $customers = new static();
                $customers->id = $id;
                $customers->user_id = $user_id;
                $customers->customer_group_id = $customer_group_id;
                $customers->type = $type;
                $customers->code = $code;
                $customers->partner_discount = $partner_discount;
                $customers->username = $username;
                $customers->password = $password;
                $customers->guid = $guid;
                $customers->color = $color;
                $customers->name = $name;
                $customers->address = $address;
                $customers->city_name = $city_name;
                $customers->city_zip = $city_zip;
                $customers->vat_id = $vat_id;
                $customers->mb = $mb;
                $customers->oib = $oib;
                $customers->note = $note;
                $customers->note_invoice = $note_invoice;
                $customers->contact_name = $contact_name;
                $customers->facebook = $facebook;
                $customers->skype = $skype;
                $customers->contact_tel = $contact_tel;
                $customers->contact_email = $contact_email;
                $customers->country_id = $country_id;
                $customers->favourite = $favourite;
                $customers->partner = $partner;
                $customers->active = $active;
                $customers->created = $created;
                $customers->changed = $changed;
        
        return $customers;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $customer_group_id//
            * @param string $type//
            * @param string $code//
            * @param double $partner_discount// partner discount for selling 
            * @param string $username//
            * @param string $password//
            * @param string $guid//
            * @param string $color//
            * @param string $name//
            * @param string $address//
            * @param string $city_name//
            * @param string $city_zip//
            * @param string $vat_id// id of customer
            * @param string $mb//
            * @param string $oib//
            * @param string $note//
            * @param string $note_invoice//
            * @param string $contact_name//
            * @param string $facebook//
            * @param string $skype//
            * @param string $contact_tel//
            * @param string $contact_email//
            * @param int $country_id//
            * @param string $favourite//
            * @param string $partner//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return Customers    */
    public function edit($id, $user_id, $customer_group_id, $type, $code, $partner_discount, $username, $password, $guid, $color, $name, $address, $city_name, $city_zip, $vat_id, $mb, $oib, $note, $note_invoice, $contact_name, $facebook, $skype, $contact_tel, $contact_email, $country_id, $favourite, $partner, $active, $created, $changed): Customers
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->customer_group_id = $customer_group_id;
            $this->type = $type;
            $this->code = $code;
            $this->partner_discount = $partner_discount;
            $this->username = $username;
            $this->password = $password;
            $this->guid = $guid;
            $this->color = $color;
            $this->name = $name;
            $this->address = $address;
            $this->city_name = $city_name;
            $this->city_zip = $city_zip;
            $this->vat_id = $vat_id;
            $this->mb = $mb;
            $this->oib = $oib;
            $this->note = $note;
            $this->note_invoice = $note_invoice;
            $this->contact_name = $contact_name;
            $this->facebook = $facebook;
            $this->skype = $skype;
            $this->contact_tel = $contact_tel;
            $this->contact_email = $contact_email;
            $this->country_id = $country_id;
            $this->favourite = $favourite;
            $this->partner = $partner;
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
            'customer_group_id' => Yii::t('app', 'Customer Group ID'),
            'type' => Yii::t('app', 'Type'),
            'code' => Yii::t('app', 'Code'),
            'partner_discount' => Yii::t('app', 'Partner Discount'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'guid' => Yii::t('app', 'Guid'),
            'color' => Yii::t('app', 'Color'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'city_name' => Yii::t('app', 'City Name'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'vat_id' => Yii::t('app', 'Vat ID'),
            'mb' => Yii::t('app', 'Mb'),
            'oib' => Yii::t('app', 'Oib'),
            'note' => Yii::t('app', 'Note'),
            'note_invoice' => Yii::t('app', 'Note Invoice'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'facebook' => Yii::t('app', 'Facebook'),
            'skype' => Yii::t('app', 'Skype'),
            'contact_tel' => Yii::t('app', 'Contact Tel'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'country_id' => Yii::t('app', 'Country ID'),
            'favourite' => Yii::t('app', 'Favourite'),
            'partner' => Yii::t('app', 'Partner'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomersGroups::class, ['id' => 'customer_group_id']);
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
    public function getCustomersB2bs()
    {
        return $this->hasMany(CustomersB2b::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersObjects()
    {
        return $this->hasMany(CustomersObjects::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysCustomers()
    {
        return $this->hasMany(ObjectsPricesDaysCustomers::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsGroups()
    {
        return $this->hasMany(RentsGroups::class, ['customer_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CustomersQuery(get_called_class());
    }
}
