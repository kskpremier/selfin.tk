<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\CustomersObjects;
use reception\entities\MyRent\CustomersPrices;
use reception\entities\MyRent\Friends;
use reception\entities\MyRent\ItemsB2bs;
use reception\entities\MyRent\ItemsPeriods;
use reception\entities\MyRent\ItemsPrices;
use reception\entities\MyRent\LogB2bs;
use reception\entities\MyRent\LogIcals;
use reception\entities\MyRent\ObjectRealstateMailDescriptions;
use reception\entities\MyRent\Cleaner;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\Laundry;
use reception\entities\MyRent\ObjectType;
use reception\entities\MyRent\Profile;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;
use reception\entities\MyRent\ObjectsAdditionalCharges;
use reception\entities\MyRent\ObjectsAmenites;
use reception\entities\MyRent\ObjectsB2bs;
use reception\entities\MyRent\ObjectsCancellations;
use reception\entities\MyRent\ObjectsChecksLogs;
use reception\entities\MyRent\ObjectsDistances;
use reception\entities\MyRent\ObjectsDoorsLocks;
use reception\entities\MyRent\ObjectsEvisitors;
use reception\entities\MyRent\ObjectsFacilities;
use reception\entities\MyRent\ObjectsGroups;
use reception\entities\MyRent\ObjectsGroupsObjects;
use reception\entities\MyRent\ObjectsItems;
use reception\entities\MyRent\ObjectsLeisureActivities;
use reception\entities\MyRent\ObjectsMaintenances;
use reception\entities\MyRent\ObjectsPaymentMethods;
use reception\entities\MyRent\Methods;
use reception\entities\MyRent\ObjectsPaymentOptions;
use reception\entities\MyRent\ObjectsPricesCustomers;
use reception\entities\MyRent\ObjectsPricesDays;
use reception\entities\MyRent\ObjectsPricesDaysCustomers;
use reception\entities\MyRent\ObjectsPricesDaysNetos;
use reception\entities\MyRent\ObjectsPricesDiscounts;
use reception\entities\MyRent\ObjectsPricesNetos;
use reception\entities\MyRent\ObjectsPricesNotes;
use reception\entities\MyRent\ObjectsPricesStayings;
use reception\entities\MyRent\ObjectsRealestates;
use reception\entities\MyRent\ObjectsRealestatesDescriptions;
use reception\entities\MyRent\ObjectsRealestatesPictures;
use reception\entities\MyRent\ObjectsRentsSources;
use reception\entities\MyRent\ObjectsRooms;
use reception\entities\MyRent\ObjectsSeos;
use reception\entities\MyRent\ObjectsSurroundings;
use reception\entities\MyRent\ObjectsToObjects;
use reception\entities\MyRent\ObjectsToObjects0;
use reception\entities\MyRent\ObjectIdTos;
use reception\entities\MyRent\ObjectIdFroms;
use reception\entities\MyRent\ObjectsTravelTime;
use reception\entities\MyRent\OffersObjects;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsImports;
use reception\entities\MyRent\RentsItemsTemplates;
use reception\entities\MyRent\Reviews;

/**
 * This is the model class for table "objects".
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property int $object_type_id
 * @property int $worker_id
 * @property int $cleaner_id
 * @property int $laundry_id
 * @property int $profile_id link ti profile for otas
 * @property string $type single property or group property
 * @property string $erp_id
 * @property string $object_type_extra
 * @property int $item_id
 * @property string $guid
 * @property string $price_calculation E  per extra people, Q - qountity, R - room, P - person
 * @property string $calculation_type P percent, F fiks
 * @property string $object
 * @property string $name
 * @property string $color
 * @property string $picture name of main picture
 * @property double $price
 * @property double $exchange
 * @property int $currency_id
 * @property int $vat VAT in %
 * @property int $vat_advance VAT for advance in %
 * @property int $balance_payment how many days before arrivl to pay full amont
 * @property int $sort how to sort objects
 * @property int $sort_front_page how to sort on front page
 * @property string $web_page
 * @property string $online_folder save online folder for sync
 * @property string $note
 * @property string $note_long for general notes, log
 * @property string $description
 * @property double $advance_percent
 * @property double $review
 * @property double $owner_provision owner provision
 * @property string $web is it for web
 * @property string $instant is enable instant book
 * @property string $active active globaly in myRent
 * @property string $details show details in offer, mail, guest portal
 * @property string $pay_casche if apartment is reciving casche
 * @property string $pay_iban iban transaction
 * @property string $pay_paypal paypal payments
 * @property string $pay_card if apartment is reciving credit cards
 * @property string $city_tax if we need to charge extra for city tax
 * @property string $guest_portal_details show property details on guest portal
 * @property string $own is this property your own
 * @property string $front_page display on web, fron page
 * @property string $price_with_vat rent price
 * @property string $price_with_city_tax rent price
 * @property string $door_id ID of door for self check in
 * @property string $created
 * @property string $changed
 *
 * @property CustomersObjects[] $customersObjects
 * @property CustomersPrices[] $customersPrices
 * @property Friends[] $friends
 * @property ItemsB2b[] $itemsB2bs
 * @property ItemsPeriod[] $itemsPeriods
 * @property ItemsPrices[] $itemsPrices
 * @property LogB2b[] $logB2bs
 * @property LogIcal[] $logIcals
 * @property ObjectRealstateMailDescription[] $objectRealstateMailDescriptions
 * @property Cleaners $cleaner
 * @property Currency $currency
 * @property Laundries $laundry
 * @property ObjectsTypes $objectType
 * @property Profiles $profile
 * @property Units $unit
 * @property Users $user
 * @property Workers $worker
 * @property ObjectsAdditionalCharges[] $objectsAdditionalCharges
 * @property ObjectsAmenites[] $objectsAmenites
 * @property ObjectsB2b[] $objectsB2bs
 * @property ObjectsCancellations[] $objectsCancellations
 * @property ObjectsChecksLogs[] $objectsChecksLogs
 * @property ObjectsDistances[] $objectsDistances
 * @property ObjectsDoorsLocks[] $objectsDoorsLocks
 * @property ObjectsEvisitor[] $objectsEvisitors
 * @property ObjectsFacilities[] $objectsFacilities
 * @property ObjectsGroups[] $objectsGroups
 * @property ObjectsGroupsObjects[] $objectsGroupsObjects
 * @property ObjectsItems[] $objectsItems
 * @property ObjectsLeisureActivity[] $objectsLeisureActivities
 * @property ObjectsMaintenance[] $objectsMaintenances
 * @property ObjectsPaymentMethods[] $objectsPaymentMethods
 * @property ObjectsPaymentMethodsList[] $methods
 * @property ObjectsPaymentOptions[] $objectsPaymentOptions
 * @property ObjectsPricesCustomers[] $objectsPricesCustomers
 * @property ObjectsPricesDays[] $objectsPricesDays
 * @property ObjectsPricesDaysCustomers[] $objectsPricesDaysCustomers
 * @property ObjectsPricesDaysNeto[] $objectsPricesDaysNetos
 * @property ObjectsPricesDiscounts[] $objectsPricesDiscounts
 * @property ObjectsPricesNeto[] $objectsPricesNetos
 * @property ObjectsPricesNotes[] $objectsPricesNotes
 * @property ObjectsPricesStaying[] $objectsPricesStayings
 * @property ObjectsRealestates[] $objectsRealestates
 * @property ObjectsRealestatesDescriptions[] $objectsRealestatesDescriptions
 * @property ObjectsRealestatesPictures[] $objectsRealestatesPictures
 * @property ObjectsRentsSources[] $objectsRentsSources
 * @property ObjectsRooms[] $objectsRooms
 * @property ObjectsSeo[] $objectsSeos
 * @property ObjectsSurroundings[] $objectsSurroundings
 * @property ObjectsToObjects[] $objectsToObjects
 * @property ObjectsToObjects[] $objectsToObjects0
 * @property Objects[] $objectIdTos
 * @property Objects[] $objectIdFroms
 * @property ObjectsTravelTime $objectsTravelTime
 * @property OffersObjects[] $offersObjects
 * @property Rents[] $rents
 * @property RentsImports[] $rentsImports
 * @property RentsItemsTemplates[] $rentsItemsTemplates
 * @property Reviews[] $reviews
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects';
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
        * @param int $unit_id//
        * @param int $object_type_id//
        * @param int $worker_id//
        * @param int $cleaner_id//
        * @param int $laundry_id//
        * @param int $profile_id// link ti profile for otas
        * @param string $type// single property or group property
        * @param string $erp_id//
        * @param string $object_type_extra//
        * @param int $item_id//
        * @param string $guid//
        * @param string $price_calculation// E  per extra people, Q - qountity, R - room, P - person
        * @param string $calculation_type// P percent, F fiks
        * @param string $object//
        * @param string $name//
        * @param string $color//
        * @param string $picture// name of main picture
        * @param double $price//
        * @param double $exchange//
        * @param int $currency_id//
        * @param int $vat// VAT in %
        * @param int $vat_advance// VAT for advance in %
        * @param int $balance_payment// how many days before arrivl to pay full amont
        * @param int $sort// how to sort objects
        * @param int $sort_front_page// how to sort on front page
        * @param string $web_page//
        * @param string $online_folder// save online folder for sync
        * @param string $note//
        * @param string $note_long// for general notes, log
        * @param string $description//
        * @param double $advance_percent//
        * @param double $review//
        * @param double $owner_provision// owner provision
        * @param string $web// is it for web
        * @param string $instant// is enable instant book
        * @param string $active// active globaly in myRent
        * @param string $details// show details in offer, mail, guest portal
        * @param string $pay_casche// if apartment is reciving casche
        * @param string $pay_iban// iban transaction
        * @param string $pay_paypal// paypal payments
        * @param string $pay_card// if apartment is reciving credit cards
        * @param string $city_tax// if we need to charge extra for city tax
        * @param string $guest_portal_details// show property details on guest portal
        * @param string $own// is this property your own
        * @param string $front_page// display on web, fron page
        * @param string $price_with_vat// rent price
        * @param string $price_with_city_tax// rent price
        * @param string $door_id// ID of door for self check in
        * @param string $created//
        * @param string $changed//
        * @return Objects    */
    public static function create($id, $user_id, $unit_id, $object_type_id, $worker_id, $cleaner_id, $laundry_id, $profile_id, $type, $erp_id, $object_type_extra, $item_id, $guid, $price_calculation, $calculation_type, $object, $name, $color, $picture, $price, $exchange, $currency_id, $vat, $vat_advance, $balance_payment, $sort, $sort_front_page, $web_page, $online_folder, $note, $note_long, $description, $advance_percent, $review, $owner_provision, $web, $instant, $active, $details, $pay_casche, $pay_iban, $pay_paypal, $pay_card, $city_tax, $guest_portal_details, $own, $front_page, $price_with_vat, $price_with_city_tax, $door_id, $created, $changed): Objects
    {
        $objects = new static();
                $objects->id = $id;
                $objects->user_id = $user_id;
                $objects->unit_id = $unit_id;
                $objects->object_type_id = $object_type_id;
                $objects->worker_id = $worker_id;
                $objects->cleaner_id = $cleaner_id;
                $objects->laundry_id = $laundry_id;
                $objects->profile_id = $profile_id;
                $objects->type = $type;
                $objects->erp_id = $erp_id;
                $objects->object_type_extra = $object_type_extra;
                $objects->item_id = $item_id;
                $objects->guid = $guid;
                $objects->price_calculation = $price_calculation;
                $objects->calculation_type = $calculation_type;
                $objects->object = $object;
                $objects->name = $name;
                $objects->color = $color;
                $objects->picture = $picture;
                $objects->price = $price;
                $objects->exchange = $exchange;
                $objects->currency_id = $currency_id;
                $objects->vat = $vat;
                $objects->vat_advance = $vat_advance;
                $objects->balance_payment = $balance_payment;
                $objects->sort = $sort;
                $objects->sort_front_page = $sort_front_page;
                $objects->web_page = $web_page;
                $objects->online_folder = $online_folder;
                $objects->note = $note;
                $objects->note_long = $note_long;
                $objects->description = $description;
                $objects->advance_percent = $advance_percent;
                $objects->review = $review;
                $objects->owner_provision = $owner_provision;
                $objects->web = $web;
                $objects->instant = $instant;
                $objects->active = $active;
                $objects->details = $details;
                $objects->pay_casche = $pay_casche;
                $objects->pay_iban = $pay_iban;
                $objects->pay_paypal = $pay_paypal;
                $objects->pay_card = $pay_card;
                $objects->city_tax = $city_tax;
                $objects->guest_portal_details = $guest_portal_details;
                $objects->own = $own;
                $objects->front_page = $front_page;
                $objects->price_with_vat = $price_with_vat;
                $objects->price_with_city_tax = $price_with_city_tax;
                $objects->door_id = $door_id;
                $objects->created = $created;
                $objects->changed = $changed;
        
        return $objects;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $unit_id//
            * @param int $object_type_id//
            * @param int $worker_id//
            * @param int $cleaner_id//
            * @param int $laundry_id//
            * @param int $profile_id// link ti profile for otas
            * @param string $type// single property or group property
            * @param string $erp_id//
            * @param string $object_type_extra//
            * @param int $item_id//
            * @param string $guid//
            * @param string $price_calculation// E  per extra people, Q - qountity, R - room, P - person
            * @param string $calculation_type// P percent, F fiks
            * @param string $object//
            * @param string $name//
            * @param string $color//
            * @param string $picture// name of main picture
            * @param double $price//
            * @param double $exchange//
            * @param int $currency_id//
            * @param int $vat// VAT in %
            * @param int $vat_advance// VAT for advance in %
            * @param int $balance_payment// how many days before arrivl to pay full amont
            * @param int $sort// how to sort objects
            * @param int $sort_front_page// how to sort on front page
            * @param string $web_page//
            * @param string $online_folder// save online folder for sync
            * @param string $note//
            * @param string $note_long// for general notes, log
            * @param string $description//
            * @param double $advance_percent//
            * @param double $review//
            * @param double $owner_provision// owner provision
            * @param string $web// is it for web
            * @param string $instant// is enable instant book
            * @param string $active// active globaly in myRent
            * @param string $details// show details in offer, mail, guest portal
            * @param string $pay_casche// if apartment is reciving casche
            * @param string $pay_iban// iban transaction
            * @param string $pay_paypal// paypal payments
            * @param string $pay_card// if apartment is reciving credit cards
            * @param string $city_tax// if we need to charge extra for city tax
            * @param string $guest_portal_details// show property details on guest portal
            * @param string $own// is this property your own
            * @param string $front_page// display on web, fron page
            * @param string $price_with_vat// rent price
            * @param string $price_with_city_tax// rent price
            * @param string $door_id// ID of door for self check in
            * @param string $created//
            * @param string $changed//
        * @return Objects    */
    public function edit($id, $user_id, $unit_id, $object_type_id, $worker_id, $cleaner_id, $laundry_id, $profile_id, $type, $erp_id, $object_type_extra, $item_id, $guid, $price_calculation, $calculation_type, $object, $name, $color, $picture, $price, $exchange, $currency_id, $vat, $vat_advance, $balance_payment, $sort, $sort_front_page, $web_page, $online_folder, $note, $note_long, $description, $advance_percent, $review, $owner_provision, $web, $instant, $active, $details, $pay_casche, $pay_iban, $pay_paypal, $pay_card, $city_tax, $guest_portal_details, $own, $front_page, $price_with_vat, $price_with_city_tax, $door_id, $created, $changed): Objects
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->unit_id = $unit_id;
            $this->object_type_id = $object_type_id;
            $this->worker_id = $worker_id;
            $this->cleaner_id = $cleaner_id;
            $this->laundry_id = $laundry_id;
            $this->profile_id = $profile_id;
            $this->type = $type;
            $this->erp_id = $erp_id;
            $this->object_type_extra = $object_type_extra;
            $this->item_id = $item_id;
            $this->guid = $guid;
            $this->price_calculation = $price_calculation;
            $this->calculation_type = $calculation_type;
            $this->object = $object;
            $this->name = $name;
            $this->color = $color;
            $this->picture = $picture;
            $this->price = $price;
            $this->exchange = $exchange;
            $this->currency_id = $currency_id;
            $this->vat = $vat;
            $this->vat_advance = $vat_advance;
            $this->balance_payment = $balance_payment;
            $this->sort = $sort;
            $this->sort_front_page = $sort_front_page;
            $this->web_page = $web_page;
            $this->online_folder = $online_folder;
            $this->note = $note;
            $this->note_long = $note_long;
            $this->description = $description;
            $this->advance_percent = $advance_percent;
            $this->review = $review;
            $this->owner_provision = $owner_provision;
            $this->web = $web;
            $this->instant = $instant;
            $this->active = $active;
            $this->details = $details;
            $this->pay_casche = $pay_casche;
            $this->pay_iban = $pay_iban;
            $this->pay_paypal = $pay_paypal;
            $this->pay_card = $pay_card;
            $this->city_tax = $city_tax;
            $this->guest_portal_details = $guest_portal_details;
            $this->own = $own;
            $this->front_page = $front_page;
            $this->price_with_vat = $price_with_vat;
            $this->price_with_city_tax = $price_with_city_tax;
            $this->door_id = $door_id;
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'cleaner_id' => Yii::t('app', 'Cleaner ID'),
            'laundry_id' => Yii::t('app', 'Laundry ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'type' => Yii::t('app', 'Type'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'object_type_extra' => Yii::t('app', 'Object Type Extra'),
            'item_id' => Yii::t('app', 'Item ID'),
            'guid' => Yii::t('app', 'Guid'),
            'price_calculation' => Yii::t('app', 'Price Calculation'),
            'calculation_type' => Yii::t('app', 'Calculation Type'),
            'object' => Yii::t('app', 'Object'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
            'picture' => Yii::t('app', 'Picture'),
            'price' => Yii::t('app', 'Price'),
            'exchange' => Yii::t('app', 'Exchange'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'vat' => Yii::t('app', 'Vat'),
            'vat_advance' => Yii::t('app', 'Vat Advance'),
            'balance_payment' => Yii::t('app', 'Balance Payment'),
            'sort' => Yii::t('app', 'Sort'),
            'sort_front_page' => Yii::t('app', 'Sort Front Page'),
            'web_page' => Yii::t('app', 'Web Page'),
            'online_folder' => Yii::t('app', 'Online Folder'),
            'note' => Yii::t('app', 'Note'),
            'note_long' => Yii::t('app', 'Note Long'),
            'description' => Yii::t('app', 'Description'),
            'advance_percent' => Yii::t('app', 'Advance Percent'),
            'review' => Yii::t('app', 'Review'),
            'owner_provision' => Yii::t('app', 'Owner Provision'),
            'web' => Yii::t('app', 'Web'),
            'instant' => Yii::t('app', 'Instant'),
            'active' => Yii::t('app', 'Active'),
            'details' => Yii::t('app', 'Details'),
            'pay_casche' => Yii::t('app', 'Pay Casche'),
            'pay_iban' => Yii::t('app', 'Pay Iban'),
            'pay_paypal' => Yii::t('app', 'Pay Paypal'),
            'pay_card' => Yii::t('app', 'Pay Card'),
            'city_tax' => Yii::t('app', 'City Tax'),
            'guest_portal_details' => Yii::t('app', 'Guest Portal Details'),
            'own' => Yii::t('app', 'Own'),
            'front_page' => Yii::t('app', 'Front Page'),
            'price_with_vat' => Yii::t('app', 'Price With Vat'),
            'price_with_city_tax' => Yii::t('app', 'Price With City Tax'),
            'door_id' => Yii::t('app', 'Door ID'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersObjects()
    {
        return $this->hasMany(CustomersObjects::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriends()
    {
        return $this->hasMany(Friends::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsB2bs()
    {
        return $this->hasMany(ItemsB2b::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPeriods()
    {
        return $this->hasMany(ItemsPeriod::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPrices()
    {
        return $this->hasMany(ItemsPrices::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogB2bs()
    {
        return $this->hasMany(LogB2b::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogIcals()
    {
        return $this->hasMany(LogIcal::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectRealstateMailDescriptions()
    {
        return $this->hasMany(ObjectRealstateMailDescription::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaner()
    {
        return $this->hasOne(Cleaners::class, ['id' => 'cleaner_id']);
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
    public function getLaundry()
    {
        return $this->hasOne(Laundries::class, ['id' => 'laundry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(ObjectsTypes::class, ['id' => 'object_type_id']);
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
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
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
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAdditionalCharges()
    {
        return $this->hasMany(ObjectsAdditionalCharges::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAmenites()
    {
        return $this->hasMany(ObjectsAmenites::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsB2bs()
    {
        return $this->hasMany(ObjectsB2b::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsCancellations()
    {
        return $this->hasMany(ObjectsCancellations::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistances()
    {
        return $this->hasMany(ObjectsDistances::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDoorsLocks()
    {
        return $this->hasMany(ObjectsDoorsLocks::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsEvisitors()
    {
        return $this->hasMany(ObjectsEvisitor::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsFacilities()
    {
        return $this->hasMany(ObjectsFacilities::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroups()
    {
        return $this->hasMany(ObjectsGroups::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsObjects()
    {
        return $this->hasMany(ObjectsGroupsObjects::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsItems()
    {
        return $this->hasMany(ObjectsItems::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsLeisureActivities()
    {
        return $this->hasMany(ObjectsLeisureActivity::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsMaintenances()
    {
        return $this->hasMany(ObjectsMaintenance::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPaymentMethods()
    {
        return $this->hasMany(ObjectsPaymentMethods::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMethods()
    {
        return $this->hasMany(ObjectsPaymentMethodsList::class, ['id' => 'method_id'])->viaTable('objects_payment_methods', ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPaymentOptions()
    {
        return $this->hasMany(ObjectsPaymentOptions::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesCustomers()
    {
        return $this->hasMany(ObjectsPricesCustomers::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDays()
    {
        return $this->hasMany(ObjectsPricesDays::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysCustomers()
    {
        return $this->hasMany(ObjectsPricesDaysCustomers::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysNetos()
    {
        return $this->hasMany(ObjectsPricesDaysNeto::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDiscounts()
    {
        return $this->hasMany(ObjectsPricesDiscounts::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesNetos()
    {
        return $this->hasMany(ObjectsPricesNeto::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesNotes()
    {
        return $this->hasMany(ObjectsPricesNotes::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesStayings()
    {
        return $this->hasMany(ObjectsPricesStaying::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestates()
    {
        return $this->hasMany(ObjectsRealestates::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptions()
    {
        return $this->hasMany(ObjectsRealestatesDescriptions::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesPictures()
    {
        return $this->hasMany(ObjectsRealestatesPictures::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(ObjectsRealestatesPictures::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRentsSources()
    {
        return $this->hasMany(ObjectsRentsSources::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRooms()
    {
        return $this->hasMany(ObjectsRooms::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsSeos()
    {
        return $this->hasMany(ObjectsSeo::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsSurroundings()
    {
        return $this->hasMany(ObjectsSurroundings::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsToObjects()
    {
        return $this->hasMany(ObjectsToObjects::class, ['object_id_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsToObjects0()
    {
        return $this->hasMany(ObjectsToObjects::class, ['object_id_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIdTos()
    {
        return $this->hasMany(Objects::class, ['id' => 'object_id_to'])->viaTable('objects_to_objects', ['object_id_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIdFroms()
    {
        return $this->hasMany(Objects::class, ['id' => 'object_id_from'])->viaTable('objects_to_objects', ['object_id_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTravelTime()
    {
        return $this->hasOne(ObjectsTravelTime::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffersObjects()
    {
        return $this->hasMany(OffersObjects::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(ObjectsPricesDays::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsImports()
    {
        return $this->hasMany(RentsImports::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItemsTemplates()
    {
        return $this->hasMany(RentsItemsTemplates::class, ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['object_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsQuery(get_called_class());
    }
}
