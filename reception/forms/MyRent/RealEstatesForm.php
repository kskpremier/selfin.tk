<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:53
 */

namespace reception\forms\MyRent;

use backend\models\Objects;
use backend\models\ObjectsNames;
use backend\models\ObjectsRealstatesPropertyTypes;
use yii\base\Model;
/**

/**
 * This is the form class for table "objects_realestates".
 *
 * @property int $id
 * @property int $object_id
 * @property int $object_type_id Property types in accordance to Open Travel Alliance standards
 * @property int $property_type_id how many badrooms (2,3,4)
 * @property int $object_name_id
 * @property string $name
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
 */
/**
 * @property LockVersionForm $lockVersion
 */
class RealEstatesForm extends Model
{
        public $object_id;
        public $object_type_id;
        public $property_type_id;
        public $object_name_id;
        public $can_sleep_max;
        public $promotion_id;
        public $can_sleep_optimal;
        public $floor;
        public $min_stay;
        public $security_deposit_type;
        public $down_deposit_type;
        public $standard_guests;
        public $classification_star;
        public $note;
        public $description;
        public $smoking;
        public $luxurius;
        public $air_conditioning;
        public $internet;
        public $wheelchair_accessible;
        public $pets;
        public $swimming_pool;
        public $parking;
        public $loc_beach;
        public $loc_country;
        public $loc_city;
        public $beds;
        public $beds_extra;
        public $bathrooms;
        public $bedrooms;
        public $toilets;
        public $baby_coat;
        public $high_chair;
        public $security_deposit;
        public $down_deposit;
        public $cleaning_price;
        public $space;
        public $space_yard;
        public $price_standard;
        public $guest_review;
        public $created;
        public $changed;
        public $name;
        public $motto;
        public $changeover;
        public $wifi_network;
        public $wifi_password;
        public $check_in;
        public $check_out;
        public $tripadvisor_review;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'object_type_id', 'property_type_id', 'object_name_id', 'can_sleep_max', 'promotion_id', 'can_sleep_optimal', 'floor', 'min_stay', 'security_deposit_type', 'down_deposit_type', 'standard_guests', 'classification_star'], 'integer'],
            [['note', 'description', 'smoking', 'luxurius',
                'air_conditioning', 'internet', 'wheelchair_accessible',
                'pets', 'swimming_pool', 'parking', 'loc_beach', 'loc_country', 'loc_city'] , 'in','range'=>['Y','N']],
            [['beds', 'beds_extra', 'bathrooms', 'bedrooms',
                'toilets', 'baby_coat', 'high_chair', 'security_deposit',
                'down_deposit', 'cleaning_price', 'space', 'space_yard', 'price_standard',
                'guest_review'], 'number'],
            [['created', 'changed'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['motto'], 'string', 'max' => 150],
            [['changeover', 'wifi_network', 'wifi_password', 'check_in', 'check_out'], 'string', 'max' => 50],
            [['tripadvisor_review'], 'string', 'max' => 250],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['object_id' => 'id']],
            [['object_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectsNames::className(), 'targetAttribute' => ['object_name_id' => 'id']],
            [['property_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectsRealstatesPropertyTypes::className(), 'targetAttribute' => ['property_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => 'Object ID',
            'object_type_id' => 'Object Type ID',
            'property_type_id' => 'Property Type ID',
            'object_name_id' => 'Object Name ID',
            'name' => 'Name',
            'motto' => 'Motto',
            'note' => 'Note',
            'description' => 'Description',
            'can_sleep_max' => 'Can Sleep Max',
            'promotion_id' => 'Promotion ID',
            'can_sleep_optimal' => 'Can Sleep Optimal',
            'beds' => 'Beds',
            'beds_extra' => 'Beds Extra',
            'bathrooms' => 'Bathrooms',
            'bedrooms' => 'Bedrooms',
            'toilets' => 'Toilets',
            'baby_coat' => 'Baby Coat',
            'high_chair' => 'High Chair',
            'floor' => 'Floor',
            'min_stay' => 'Min Stay',
            'changeover' => 'Changeover',
            'wifi_network' => 'Wifi Network',
            'wifi_password' => 'Wifi Password',
            'check_in' => 'Check In',
            'check_out' => 'Check Out',
            'security_deposit_type' => 'Security Deposit Type',
            'security_deposit' => 'Security Deposit',
            'down_deposit_type' => 'Down Deposit Type',
            'down_deposit' => 'Down Deposit',
            'smoking' => 'Smoking',
            'luxurius' => 'Luxurius',
            'air_conditioning' => 'Air Conditioning',
            'internet' => 'Internet',
            'wheelchair_accessible' => 'Wheelchair Accessible',
            'pets' => 'Pets',
            'swimming_pool' => 'Swimming Pool',
            'parking' => 'Parking',
            'loc_beach' => 'Loc Beach',
            'loc_country' => 'Loc Country',
            'loc_city' => 'Loc City',
            'cleaning_price' => 'Cleaning Price',
            'space' => 'Space',
            'space_yard' => 'Space Yard',
            'standard_guests' => 'Standard Guests',
            'tripadvisor_review' => 'Tripadvisor Review',
            'classification_star' => 'Classification Star',
            'price_standard' => 'Price Standard',
            'guest_review' => 'Guest Review',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }



}