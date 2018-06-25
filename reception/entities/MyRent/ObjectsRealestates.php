<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\ObjectName;
use reception\entities\MyRent\PropertyType;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_realestates".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $object_type_id Property types in accordance to Open Travel Alliance standards
 * @property int $property_type_id how many badrooms (2,3,4)
 * @property int $object_name_id
 * @property string $name name for the web
 * @property string $motto
 * @property string $note
 * @property string $description
 * @property int $can_sleep_max Maximum number of guests
 * @property int $promotion_id
 * @property int $can_sleep_optimal
 * @property double $beds
 * @property double $beds_extra extra beds
 * @property double $bathrooms Number of bathrooms
 * @property double $bedrooms Number of bedrooms
 * @property double $toilets Number of toilets
 * @property double $baby_coat
 * @property double $high_chair
 * @property int $floor Apartment flor
 * @property int $min_stay
 * @property string $changeover
 * @property string $wifi_network
 * @property string $wifi_password
 * @property string $check_in time of check in
 * @property string $check_out time of check out
 * @property int $security_deposit_type set type of deposit
 * @property double $security_deposit Refundable security deposit
 * @property int $down_deposit_type set type of down payment / advance payment
 * @property double $down_deposit
 * @property string $smoking
 * @property string $luxurius
 * @property string $air_conditioning
 * @property string $internet
 * @property string $wheelchair_accessible
 * @property string $pets
 * @property string $swimming_pool
 * @property string $parking
 * @property string $loc_beach is it near beach
 * @property string $loc_country is it on country
 * @property string $loc_city is it in city
 * @property double $cleaning_price Property cleaning price
 * @property double $space Living space in square metars
 * @property double $space_yard space wiht a yaerd inclided
 * @property int $standard_guests Number of guest included in the base price
 * @property string $tripadvisor_review
 * @property int $classification_star
 * @property double $price_standard
 * @property double $guest_review
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property ObjectsNames $objectName
 * @property ObjectsRealstatesPropertyTypes $propertyType
 * @property Users $user
 */
class ObjectsRealestates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realestates';
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
        * @param int $object_id//
        * @param int $object_type_id// Property types in accordance to Open Travel Alliance standards
        * @param int $property_type_id// how many badrooms (2,3,4)
        * @param int $object_name_id//
        * @param string $name// name for the web
        * @param string $motto//
        * @param string $note//
        * @param string $description//
        * @param int $can_sleep_max// Maximum number of guests
        * @param int $promotion_id//
        * @param int $can_sleep_optimal//
        * @param double $beds//
        * @param double $beds_extra// extra beds
        * @param double $bathrooms// Number of bathrooms
        * @param double $bedrooms// Number of bedrooms
        * @param double $toilets// Number of toilets
        * @param double $baby_coat//
        * @param double $high_chair//
        * @param int $floor// Apartment flor
        * @param int $min_stay//
        * @param string $changeover//
        * @param string $wifi_network//
        * @param string $wifi_password//
        * @param string $check_in// time of check in
        * @param string $check_out// time of check out
        * @param int $security_deposit_type// set type of deposit
        * @param double $security_deposit// Refundable security deposit
        * @param int $down_deposit_type// set type of down payment / advance payment
        * @param double $down_deposit//
        * @param string $smoking//
        * @param string $luxurius//
        * @param string $air_conditioning//
        * @param string $internet//
        * @param string $wheelchair_accessible//
        * @param string $pets//
        * @param string $swimming_pool//
        * @param string $parking//
        * @param string $loc_beach// is it near beach
        * @param string $loc_country// is it on country
        * @param string $loc_city// is it in city
        * @param double $cleaning_price// Property cleaning price
        * @param double $space// Living space in square metars
        * @param double $space_yard// space wiht a yaerd inclided
        * @param int $standard_guests// Number of guest included in the base price
        * @param string $tripadvisor_review//
        * @param int $classification_star//
        * @param double $price_standard//
        * @param double $guest_review//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealestates    */
    public static function create($id, $user_id, $object_id, $object_type_id, $property_type_id, $object_name_id, $name, $motto, $note, $description, $can_sleep_max, $promotion_id, $can_sleep_optimal, $beds, $beds_extra, $bathrooms, $bedrooms, $toilets, $baby_coat, $high_chair, $floor, $min_stay, $changeover, $wifi_network, $wifi_password, $check_in, $check_out, $security_deposit_type, $security_deposit, $down_deposit_type, $down_deposit, $smoking, $luxurius, $air_conditioning, $internet, $wheelchair_accessible, $pets, $swimming_pool, $parking, $loc_beach, $loc_country, $loc_city, $cleaning_price, $space, $space_yard, $standard_guests, $tripadvisor_review, $classification_star, $price_standard, $guest_review, $created, $changed): ObjectsRealestates
    {
        $objectsRealestates = new static();
                $objectsRealestates->id = $id;
                $objectsRealestates->user_id = $user_id;
                $objectsRealestates->object_id = $object_id;
                $objectsRealestates->object_type_id = $object_type_id;
                $objectsRealestates->property_type_id = $property_type_id;
                $objectsRealestates->object_name_id = $object_name_id;
                $objectsRealestates->name = $name;
                $objectsRealestates->motto = $motto;
                $objectsRealestates->note = $note;
                $objectsRealestates->description = $description;
                $objectsRealestates->can_sleep_max = $can_sleep_max;
                $objectsRealestates->promotion_id = $promotion_id;
                $objectsRealestates->can_sleep_optimal = $can_sleep_optimal;
                $objectsRealestates->beds = $beds;
                $objectsRealestates->beds_extra = $beds_extra;
                $objectsRealestates->bathrooms = $bathrooms;
                $objectsRealestates->bedrooms = $bedrooms;
                $objectsRealestates->toilets = $toilets;
                $objectsRealestates->baby_coat = $baby_coat;
                $objectsRealestates->high_chair = $high_chair;
                $objectsRealestates->floor = $floor;
                $objectsRealestates->min_stay = $min_stay;
                $objectsRealestates->changeover = $changeover;
                $objectsRealestates->wifi_network = $wifi_network;
                $objectsRealestates->wifi_password = $wifi_password;
                $objectsRealestates->check_in = $check_in;
                $objectsRealestates->check_out = $check_out;
                $objectsRealestates->security_deposit_type = $security_deposit_type;
                $objectsRealestates->security_deposit = $security_deposit;
                $objectsRealestates->down_deposit_type = $down_deposit_type;
                $objectsRealestates->down_deposit = $down_deposit;
                $objectsRealestates->smoking = $smoking;
                $objectsRealestates->luxurius = $luxurius;
                $objectsRealestates->air_conditioning = $air_conditioning;
                $objectsRealestates->internet = $internet;
                $objectsRealestates->wheelchair_accessible = $wheelchair_accessible;
                $objectsRealestates->pets = $pets;
                $objectsRealestates->swimming_pool = $swimming_pool;
                $objectsRealestates->parking = $parking;
                $objectsRealestates->loc_beach = $loc_beach;
                $objectsRealestates->loc_country = $loc_country;
                $objectsRealestates->loc_city = $loc_city;
                $objectsRealestates->cleaning_price = $cleaning_price;
                $objectsRealestates->space = $space;
                $objectsRealestates->space_yard = $space_yard;
                $objectsRealestates->standard_guests = $standard_guests;
                $objectsRealestates->tripadvisor_review = $tripadvisor_review;
                $objectsRealestates->classification_star = $classification_star;
                $objectsRealestates->price_standard = $price_standard;
                $objectsRealestates->guest_review = $guest_review;
                $objectsRealestates->created = $created;
                $objectsRealestates->changed = $changed;
        
        return $objectsRealestates;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $object_type_id// Property types in accordance to Open Travel Alliance standards
            * @param int $property_type_id// how many badrooms (2,3,4)
            * @param int $object_name_id//
            * @param string $name// name for the web
            * @param string $motto//
            * @param string $note//
            * @param string $description//
            * @param int $can_sleep_max// Maximum number of guests
            * @param int $promotion_id//
            * @param int $can_sleep_optimal//
            * @param double $beds//
            * @param double $beds_extra// extra beds
            * @param double $bathrooms// Number of bathrooms
            * @param double $bedrooms// Number of bedrooms
            * @param double $toilets// Number of toilets
            * @param double $baby_coat//
            * @param double $high_chair//
            * @param int $floor// Apartment flor
            * @param int $min_stay//
            * @param string $changeover//
            * @param string $wifi_network//
            * @param string $wifi_password//
            * @param string $check_in// time of check in
            * @param string $check_out// time of check out
            * @param int $security_deposit_type// set type of deposit
            * @param double $security_deposit// Refundable security deposit
            * @param int $down_deposit_type// set type of down payment / advance payment
            * @param double $down_deposit//
            * @param string $smoking//
            * @param string $luxurius//
            * @param string $air_conditioning//
            * @param string $internet//
            * @param string $wheelchair_accessible//
            * @param string $pets//
            * @param string $swimming_pool//
            * @param string $parking//
            * @param string $loc_beach// is it near beach
            * @param string $loc_country// is it on country
            * @param string $loc_city// is it in city
            * @param double $cleaning_price// Property cleaning price
            * @param double $space// Living space in square metars
            * @param double $space_yard// space wiht a yaerd inclided
            * @param int $standard_guests// Number of guest included in the base price
            * @param string $tripadvisor_review//
            * @param int $classification_star//
            * @param double $price_standard//
            * @param double $guest_review//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealestates    */
    public function edit($id, $user_id, $object_id, $object_type_id, $property_type_id, $object_name_id, $name, $motto, $note, $description, $can_sleep_max, $promotion_id, $can_sleep_optimal, $beds, $beds_extra, $bathrooms, $bedrooms, $toilets, $baby_coat, $high_chair, $floor, $min_stay, $changeover, $wifi_network, $wifi_password, $check_in, $check_out, $security_deposit_type, $security_deposit, $down_deposit_type, $down_deposit, $smoking, $luxurius, $air_conditioning, $internet, $wheelchair_accessible, $pets, $swimming_pool, $parking, $loc_beach, $loc_country, $loc_city, $cleaning_price, $space, $space_yard, $standard_guests, $tripadvisor_review, $classification_star, $price_standard, $guest_review, $created, $changed): ObjectsRealestates
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->object_type_id = $object_type_id;
            $this->property_type_id = $property_type_id;
            $this->object_name_id = $object_name_id;
            $this->name = $name;
            $this->motto = $motto;
            $this->note = $note;
            $this->description = $description;
            $this->can_sleep_max = $can_sleep_max;
            $this->promotion_id = $promotion_id;
            $this->can_sleep_optimal = $can_sleep_optimal;
            $this->beds = $beds;
            $this->beds_extra = $beds_extra;
            $this->bathrooms = $bathrooms;
            $this->bedrooms = $bedrooms;
            $this->toilets = $toilets;
            $this->baby_coat = $baby_coat;
            $this->high_chair = $high_chair;
            $this->floor = $floor;
            $this->min_stay = $min_stay;
            $this->changeover = $changeover;
            $this->wifi_network = $wifi_network;
            $this->wifi_password = $wifi_password;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->security_deposit_type = $security_deposit_type;
            $this->security_deposit = $security_deposit;
            $this->down_deposit_type = $down_deposit_type;
            $this->down_deposit = $down_deposit;
            $this->smoking = $smoking;
            $this->luxurius = $luxurius;
            $this->air_conditioning = $air_conditioning;
            $this->internet = $internet;
            $this->wheelchair_accessible = $wheelchair_accessible;
            $this->pets = $pets;
            $this->swimming_pool = $swimming_pool;
            $this->parking = $parking;
            $this->loc_beach = $loc_beach;
            $this->loc_country = $loc_country;
            $this->loc_city = $loc_city;
            $this->cleaning_price = $cleaning_price;
            $this->space = $space;
            $this->space_yard = $space_yard;
            $this->standard_guests = $standard_guests;
            $this->tripadvisor_review = $tripadvisor_review;
            $this->classification_star = $classification_star;
            $this->price_standard = $price_standard;
            $this->guest_review = $guest_review;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'property_type_id' => Yii::t('app', 'Property Type ID'),
            'object_name_id' => Yii::t('app', 'Object Name ID'),
            'name' => Yii::t('app', 'Name'),
            'motto' => Yii::t('app', 'Motto'),
            'note' => Yii::t('app', 'Note'),
            'description' => Yii::t('app', 'Description'),
            'can_sleep_max' => Yii::t('app', 'Can Sleep Max'),
            'promotion_id' => Yii::t('app', 'Promotion ID'),
            'can_sleep_optimal' => Yii::t('app', 'Can Sleep Optimal'),
            'beds' => Yii::t('app', 'Beds'),
            'beds_extra' => Yii::t('app', 'Beds Extra'),
            'bathrooms' => Yii::t('app', 'Bathrooms'),
            'bedrooms' => Yii::t('app', 'Bedrooms'),
            'toilets' => Yii::t('app', 'Toilets'),
            'baby_coat' => Yii::t('app', 'Baby Coat'),
            'high_chair' => Yii::t('app', 'High Chair'),
            'floor' => Yii::t('app', 'Floor'),
            'min_stay' => Yii::t('app', 'Min Stay'),
            'changeover' => Yii::t('app', 'Changeover'),
            'wifi_network' => Yii::t('app', 'Wifi Network'),
            'wifi_password' => Yii::t('app', 'Wifi Password'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'security_deposit_type' => Yii::t('app', 'Security Deposit Type'),
            'security_deposit' => Yii::t('app', 'Security Deposit'),
            'down_deposit_type' => Yii::t('app', 'Down Deposit Type'),
            'down_deposit' => Yii::t('app', 'Down Deposit'),
            'smoking' => Yii::t('app', 'Smoking'),
            'luxurius' => Yii::t('app', 'Luxurius'),
            'air_conditioning' => Yii::t('app', 'Air Conditioning'),
            'internet' => Yii::t('app', 'Internet'),
            'wheelchair_accessible' => Yii::t('app', 'Wheelchair Accessible'),
            'pets' => Yii::t('app', 'Pets'),
            'swimming_pool' => Yii::t('app', 'Swimming Pool'),
            'parking' => Yii::t('app', 'Parking'),
            'loc_beach' => Yii::t('app', 'Loc Beach'),
            'loc_country' => Yii::t('app', 'Loc Country'),
            'loc_city' => Yii::t('app', 'Loc City'),
            'cleaning_price' => Yii::t('app', 'Cleaning Price'),
            'space' => Yii::t('app', 'Space'),
            'space_yard' => Yii::t('app', 'Space Yard'),
            'standard_guests' => Yii::t('app', 'Standard Guests'),
            'tripadvisor_review' => Yii::t('app', 'Tripadvisor Review'),
            'classification_star' => Yii::t('app', 'Classification Star'),
            'price_standard' => Yii::t('app', 'Price Standard'),
            'guest_review' => Yii::t('app', 'Guest Review'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectName()
    {
        return $this->hasOne(ObjectsNames::class, ['id' => 'object_name_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyType()
    {
        return $this->hasOne(ObjectsRealstatesPropertyTypes::class, ['id' => 'property_type_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRealestatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealestatesQuery(get_called_class());
    }
}
