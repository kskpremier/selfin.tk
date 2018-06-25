<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\CustomersPrices;
use reception\entities\MyRent\InvoicesItems;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ItemsB2bs;
use reception\entities\MyRent\ItemsPrices;
use reception\entities\MyRent\ObjectsGroupsPricesDays;
use reception\entities\MyRent\ObjectsPricesCustomers;
use reception\entities\MyRent\ObjectsPricesDays;
use reception\entities\MyRent\ObjectsPricesDaysCustomers;
use reception\entities\MyRent\ObjectsPricesDaysNetos;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsItems;
use reception\entities\MyRent\RentsItemsTemplates;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property string $color
 * @property string $charge_type type of charge
 * @property string $code
 * @property string $name
 * @property string $note
 * @property string $price_include
 * @property string $description
 * @property string $cancellation_policy
 * @property double $price seling price
 * @property double $price_neto neto price
 * @property double $exchange
 * @property int $vat vat in %
 * @property int $vat_extra vat in %
 * @property string $price_rent get price from rent
 * @property string $auto add item autmaticly with new reservation
 * @property string $price_rent_advance item for advance payment
 * @property string $price_rent_owner item for invoce from owner to agency
 * @property string $price_rent_provision item for rent provision
 * @property string $default use for system to auto generate
 * @property string $default_import default item for import
 * @property string $advance_payment item for advance payment on final invoice (-1)
 * @property string $pay_on_checkin if this item is payed on check in
 * @property string $refundable
 * @property string $city_tax calculate city tax, by guests
 * @property string $percent calculate price by percent on rent prices
 * @property string $web_active is price active for web
 * @property string $calculate_margin for this item we will calucalte margin > using price_neto
 * @property string $calculation
 * @property string $created
 * @property string $changed
 *
 * @property CustomersPrices[] $customersPrices
 * @property InvoicesItems[] $invoicesItems
 * @property Currency $currency
 * @property Users $user
 * @property ItemsB2b[] $itemsB2bs
 * @property ItemsPrices[] $itemsPrices
 * @property ObjectsGroupsPricesDays[] $objectsGroupsPricesDays
 * @property ObjectsPricesCustomers[] $objectsPricesCustomers
 * @property ObjectsPricesDays[] $objectsPricesDays
 * @property ObjectsPricesDaysCustomers[] $objectsPricesDaysCustomers
 * @property ObjectsPricesDaysNeto[] $objectsPricesDaysNetos
 * @property Rents[] $rents
 * @property RentsItems[] $rentsItems
 * @property RentsItemsTemplates[] $rentsItemsTemplates
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
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
        * @param int $currency_id//
        * @param string $color//
        * @param string $charge_type// type of charge
        * @param string $code//
        * @param string $name//
        * @param string $note//
        * @param string $price_include//
        * @param string $description//
        * @param string $cancellation_policy//
        * @param double $price// seling price
        * @param double $price_neto// neto price
        * @param double $exchange//
        * @param int $vat// vat in %
        * @param int $vat_extra// vat in %
        * @param string $price_rent// get price from rent
        * @param string $auto// add item autmaticly with new reservation
        * @param string $price_rent_advance// item for advance payment
        * @param string $price_rent_owner// item for invoce from owner to agency
        * @param string $price_rent_provision// item for rent provision
        * @param string $default// use for system to auto generate
        * @param string $default_import// default item for import
        * @param string $advance_payment// item for advance payment on final invoice (-1)
        * @param string $pay_on_checkin// if this item is payed on check in
        * @param string $refundable//
        * @param string $city_tax// calculate city tax, by guests
        * @param string $percent// calculate price by percent on rent prices
        * @param string $web_active// is price active for web
        * @param string $calculate_margin// for this item we will calucalte margin > using price_neto
        * @param string $calculation//
        * @param string $created//
        * @param string $changed//
        * @return Items    */
    public static function create($id, $user_id, $currency_id, $color, $charge_type, $code, $name, $note, $price_include, $description, $cancellation_policy, $price, $price_neto, $exchange, $vat, $vat_extra, $price_rent, $auto, $price_rent_advance, $price_rent_owner, $price_rent_provision, $default, $default_import, $advance_payment, $pay_on_checkin, $refundable, $city_tax, $percent, $web_active, $calculate_margin, $calculation, $created, $changed): Items
    {
        $items = new static();
                $items->id = $id;
                $items->user_id = $user_id;
                $items->currency_id = $currency_id;
                $items->color = $color;
                $items->charge_type = $charge_type;
                $items->code = $code;
                $items->name = $name;
                $items->note = $note;
                $items->price_include = $price_include;
                $items->description = $description;
                $items->cancellation_policy = $cancellation_policy;
                $items->price = $price;
                $items->price_neto = $price_neto;
                $items->exchange = $exchange;
                $items->vat = $vat;
                $items->vat_extra = $vat_extra;
                $items->price_rent = $price_rent;
                $items->auto = $auto;
                $items->price_rent_advance = $price_rent_advance;
                $items->price_rent_owner = $price_rent_owner;
                $items->price_rent_provision = $price_rent_provision;
                $items->default = $default;
                $items->default_import = $default_import;
                $items->advance_payment = $advance_payment;
                $items->pay_on_checkin = $pay_on_checkin;
                $items->refundable = $refundable;
                $items->city_tax = $city_tax;
                $items->percent = $percent;
                $items->web_active = $web_active;
                $items->calculate_margin = $calculate_margin;
                $items->calculation = $calculation;
                $items->created = $created;
                $items->changed = $changed;
        
        return $items;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $currency_id//
            * @param string $color//
            * @param string $charge_type// type of charge
            * @param string $code//
            * @param string $name//
            * @param string $note//
            * @param string $price_include//
            * @param string $description//
            * @param string $cancellation_policy//
            * @param double $price// seling price
            * @param double $price_neto// neto price
            * @param double $exchange//
            * @param int $vat// vat in %
            * @param int $vat_extra// vat in %
            * @param string $price_rent// get price from rent
            * @param string $auto// add item autmaticly with new reservation
            * @param string $price_rent_advance// item for advance payment
            * @param string $price_rent_owner// item for invoce from owner to agency
            * @param string $price_rent_provision// item for rent provision
            * @param string $default// use for system to auto generate
            * @param string $default_import// default item for import
            * @param string $advance_payment// item for advance payment on final invoice (-1)
            * @param string $pay_on_checkin// if this item is payed on check in
            * @param string $refundable//
            * @param string $city_tax// calculate city tax, by guests
            * @param string $percent// calculate price by percent on rent prices
            * @param string $web_active// is price active for web
            * @param string $calculate_margin// for this item we will calucalte margin > using price_neto
            * @param string $calculation//
            * @param string $created//
            * @param string $changed//
        * @return Items    */
    public function edit($id, $user_id, $currency_id, $color, $charge_type, $code, $name, $note, $price_include, $description, $cancellation_policy, $price, $price_neto, $exchange, $vat, $vat_extra, $price_rent, $auto, $price_rent_advance, $price_rent_owner, $price_rent_provision, $default, $default_import, $advance_payment, $pay_on_checkin, $refundable, $city_tax, $percent, $web_active, $calculate_margin, $calculation, $created, $changed): Items
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->currency_id = $currency_id;
            $this->color = $color;
            $this->charge_type = $charge_type;
            $this->code = $code;
            $this->name = $name;
            $this->note = $note;
            $this->price_include = $price_include;
            $this->description = $description;
            $this->cancellation_policy = $cancellation_policy;
            $this->price = $price;
            $this->price_neto = $price_neto;
            $this->exchange = $exchange;
            $this->vat = $vat;
            $this->vat_extra = $vat_extra;
            $this->price_rent = $price_rent;
            $this->auto = $auto;
            $this->price_rent_advance = $price_rent_advance;
            $this->price_rent_owner = $price_rent_owner;
            $this->price_rent_provision = $price_rent_provision;
            $this->default = $default;
            $this->default_import = $default_import;
            $this->advance_payment = $advance_payment;
            $this->pay_on_checkin = $pay_on_checkin;
            $this->refundable = $refundable;
            $this->city_tax = $city_tax;
            $this->percent = $percent;
            $this->web_active = $web_active;
            $this->calculate_margin = $calculate_margin;
            $this->calculation = $calculation;
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
            'currency_id' => Yii::t('app', 'Currency ID'),
            'color' => Yii::t('app', 'Color'),
            'charge_type' => Yii::t('app', 'Charge Type'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'price_include' => Yii::t('app', 'Price Include'),
            'description' => Yii::t('app', 'Description'),
            'cancellation_policy' => Yii::t('app', 'Cancellation Policy'),
            'price' => Yii::t('app', 'Price'),
            'price_neto' => Yii::t('app', 'Price Neto'),
            'exchange' => Yii::t('app', 'Exchange'),
            'vat' => Yii::t('app', 'Vat'),
            'vat_extra' => Yii::t('app', 'Vat Extra'),
            'price_rent' => Yii::t('app', 'Price Rent'),
            'auto' => Yii::t('app', 'Auto'),
            'price_rent_advance' => Yii::t('app', 'Price Rent Advance'),
            'price_rent_owner' => Yii::t('app', 'Price Rent Owner'),
            'price_rent_provision' => Yii::t('app', 'Price Rent Provision'),
            'default' => Yii::t('app', 'Default'),
            'default_import' => Yii::t('app', 'Default Import'),
            'advance_payment' => Yii::t('app', 'Advance Payment'),
            'pay_on_checkin' => Yii::t('app', 'Pay On Checkin'),
            'refundable' => Yii::t('app', 'Refundable'),
            'city_tax' => Yii::t('app', 'City Tax'),
            'percent' => Yii::t('app', 'Percent'),
            'web_active' => Yii::t('app', 'Web Active'),
            'calculate_margin' => Yii::t('app', 'Calculate Margin'),
            'calculation' => Yii::t('app', 'Calculation'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems()
    {
        return $this->hasMany(InvoicesItems::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
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
    public function getItemsB2bs()
    {
        return $this->hasMany(ItemsB2b::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPrices()
    {
        return $this->hasMany(ItemsPrices::class, ['invoice_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsPricesDays()
    {
        return $this->hasMany(ObjectsGroupsPricesDays::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesCustomers()
    {
        return $this->hasMany(ObjectsPricesCustomers::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDays()
    {
        return $this->hasMany(ObjectsPricesDays::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysCustomers()
    {
        return $this->hasMany(ObjectsPricesDaysCustomers::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysNetos()
    {
        return $this->hasMany(ObjectsPricesDaysNeto::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItems()
    {
        return $this->hasMany(RentsItems::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItemsTemplates()
    {
        return $this->hasMany(RentsItemsTemplates::class, ['item_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ItemsQuery(get_called_class());
    }
}
