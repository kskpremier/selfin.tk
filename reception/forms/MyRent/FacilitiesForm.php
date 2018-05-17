<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:53
 */

namespace reception\forms\MyRent;

use yii\base\Model;
use backend\models\Objects;
/**
 * This is the form class for table "objects_facilities".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property string $seaview
 * @property string $babycot
 * @property string $breakfast
 * @property string $halfboard
 * @property string $fullboard
 * @property string $berth
 * @property string $jacuzzi
 * @property string $terrace
 * @property string $tv_satelite
 * @property string $wifi
 * @property string $internet_fast
 * @property string $internet
 * @property string $smoking
 * @property string $luxurious
 * @property string $air_conditioning
 * @property string $tv_lcd
 * @property string $wheelchair_accessible
 * @property string $near_beach
 * @property string $pets
 * @property string $near_country
 * @property string $near_city
 * @property string $in_city
 * @property string $in_country
 * @property string $swimming_pool
 * @property string $swimming_pool_indoor
 * @property string $swimming_pool_indoor_heated
 * @property string $swimming_pool_outdoor
 * @property string $swimming_pool_outdoor_heated
 * @property string $parking
 * @property string $sauna
 * @property string $gym
 * @property string $separate_kitchen
 * @property string $elevator
 * @property string $heating
 * @property string $towels
 * @property string $linen
 * @property string $for_couples
 * @property string $for_family
 * @property string $for_friends
 * @property string $for_large_groups
 * @property string $for_wedings
 * @property string $total_privacy
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 */
/**
 * @property LockVersionForm $lockVersion
 */
class FacilitiesForm extends Model
{
    public $user_id;
    public $object_id;
    public $seaview;
    public $babycot;
    public $breakfast;
    public $halfboard;
    public $fullboard;
    public $berth;
    public $jacuzzi;
    public $terrace;
    public $tv_satelite;
    public $wifi;
    public $internet_fast;
    public $internet;
    public $smoking;
    public $luxurious;
    public $air_conditioning;
    public $tv_lcd;
    public $wheelchair_accessible;
    public $near_beach;
    public $pets;
    public $near_country;
    public $near_city;
    public $in_city;
    public $in_country;
    public $swimming_pool;
    public $swimming_pool_indoor;
    public $swimming_pool_indoor_heated;
    public $swimming_pool_outdoor;
    public $swimming_pool_outdoor_heated;
    public $parking;
    public $sauna;
    public $gym;
    public $separate_kitchen;
    public $elevator;
    public $heating;
    public $towels;
    public $linen;
    public $for_couples;
    public $for_family;
    public $for_friends;
    public $for_large_groups;
    public $for_wedings;
    public $total_privacy;
    public $created;
    public $changed;

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
            [['user_id', 'object_id'], 'integer'],
            [['seaview', 'babycot', 'breakfast', 'halfboard', 'fullboard',
                'berth', 'jacuzzi', 'terrace', 'tv_satelite', 'wifi', 'internet_fast',
                'internet', 'smoking', 'luxurious', 'air_conditioning', 'tv_lcd', 'wheelchair_accessible',
                'near_beach', 'pets', 'near_country', 'near_city', 'in_city', 'in_country', 'swimming_pool',
                'swimming_pool_indoor', 'swimming_pool_indoor_heated', 'swimming_pool_outdoor', 'swimming_pool_outdoor_heated',
                'parking', 'sauna', 'gym', 'separate_kitchen', 'elevator', 'heating', 'towels', 'linen', 'for_couples', 'for_family',
                'for_friends', 'for_large_groups',
                'for_wedings', 'total_privacy'], 'in','range'=>['Y','N']],
            [['created', 'changed'], 'safe'],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['object_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
//            'user_id' => 'User ID',
            'object_id' => 'Object ID',
            'seaview' => 'Seaview',
            'babycot' => 'Babycot',
            'breakfast' => 'Breakfast',
            'halfboard' => 'Halfboard',
            'fullboard' => 'Fullboard',
            'berth' => 'Berth',
            'jacuzzi' => 'Jacuzzi',
            'terrace' => 'Terrace',
            'tv_satelite' => 'Tv Satelite',
            'wifi' => 'Wifi',
            'internet_fast' => 'Internet Fast',
            'internet' => 'Internet',
            'smoking' => 'Smoking',
            'luxurious' => 'Luxurious',
            'air_conditioning' => 'Air Conditioning',
            'tv_lcd' => 'Tv Lcd',
            'wheelchair_accessible' => 'Wheelchair Accessible',
            'near_beach' => 'Near Beach',
            'pets' => 'Pets',
            'near_country' => 'Near Country',
            'near_city' => 'Near City',
            'in_city' => 'In City',
            'in_country' => 'In Country',
            'swimming_pool' => 'Swimming Pool',
            'swimming_pool_indoor' => 'Swimming Pool Indoor',
            'swimming_pool_indoor_heated' => 'Swimming Pool Indoor Heated',
            'swimming_pool_outdoor' => 'Swimming Pool Outdoor',
            'swimming_pool_outdoor_heated' => 'Swimming Pool Outdoor Heated',
            'parking' => 'Parking',
            'sauna' => 'Sauna',
            'gym' => 'Gym',
            'separate_kitchen' => 'Separate Kitchen',
            'elevator' => 'Elevator',
            'heating' => 'Heating',
            'towels' => 'Towels',
            'linen' => 'Linen',
            'for_couples' => 'For Couples',
            'for_family' => 'For Family',
            'for_friends' => 'For Friends',
            'for_large_groups' => 'For Large Groups',
            'for_wedings' => 'For Wedings',
            'total_privacy' => 'Total Privacy',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }



}