<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_facilities".
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
class ObjectsFacilities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_facilities';
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
        * @param string $seaview//
        * @param string $babycot//
        * @param string $breakfast//
        * @param string $halfboard//
        * @param string $fullboard//
        * @param string $berth//
        * @param string $jacuzzi//
        * @param string $terrace//
        * @param string $tv_satelite//
        * @param string $wifi//
        * @param string $internet_fast//
        * @param string $internet//
        * @param string $smoking//
        * @param string $luxurious//
        * @param string $air_conditioning//
        * @param string $tv_lcd//
        * @param string $wheelchair_accessible//
        * @param string $near_beach//
        * @param string $pets//
        * @param string $near_country//
        * @param string $near_city//
        * @param string $in_city//
        * @param string $in_country//
        * @param string $swimming_pool//
        * @param string $swimming_pool_indoor//
        * @param string $swimming_pool_indoor_heated//
        * @param string $swimming_pool_outdoor//
        * @param string $swimming_pool_outdoor_heated//
        * @param string $parking//
        * @param string $sauna//
        * @param string $gym//
        * @param string $separate_kitchen//
        * @param string $elevator//
        * @param string $heating//
        * @param string $towels//
        * @param string $linen//
        * @param string $for_couples//
        * @param string $for_family//
        * @param string $for_friends//
        * @param string $for_large_groups//
        * @param string $for_wedings//
        * @param string $total_privacy//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsFacilities    */
    public static function create($id, $user_id, $object_id, $seaview, $babycot, $breakfast, $halfboard, $fullboard, $berth, $jacuzzi, $terrace, $tv_satelite, $wifi, $internet_fast, $internet, $smoking, $luxurious, $air_conditioning, $tv_lcd, $wheelchair_accessible, $near_beach, $pets, $near_country, $near_city, $in_city, $in_country, $swimming_pool, $swimming_pool_indoor, $swimming_pool_indoor_heated, $swimming_pool_outdoor, $swimming_pool_outdoor_heated, $parking, $sauna, $gym, $separate_kitchen, $elevator, $heating, $towels, $linen, $for_couples, $for_family, $for_friends, $for_large_groups, $for_wedings, $total_privacy, $created, $changed): ObjectsFacilities
    {
        $objectsFacilities = new static();
                $objectsFacilities->id = $id;
                $objectsFacilities->user_id = $user_id;
                $objectsFacilities->object_id = $object_id;
                $objectsFacilities->seaview = $seaview;
                $objectsFacilities->babycot = $babycot;
                $objectsFacilities->breakfast = $breakfast;
                $objectsFacilities->halfboard = $halfboard;
                $objectsFacilities->fullboard = $fullboard;
                $objectsFacilities->berth = $berth;
                $objectsFacilities->jacuzzi = $jacuzzi;
                $objectsFacilities->terrace = $terrace;
                $objectsFacilities->tv_satelite = $tv_satelite;
                $objectsFacilities->wifi = $wifi;
                $objectsFacilities->internet_fast = $internet_fast;
                $objectsFacilities->internet = $internet;
                $objectsFacilities->smoking = $smoking;
                $objectsFacilities->luxurious = $luxurious;
                $objectsFacilities->air_conditioning = $air_conditioning;
                $objectsFacilities->tv_lcd = $tv_lcd;
                $objectsFacilities->wheelchair_accessible = $wheelchair_accessible;
                $objectsFacilities->near_beach = $near_beach;
                $objectsFacilities->pets = $pets;
                $objectsFacilities->near_country = $near_country;
                $objectsFacilities->near_city = $near_city;
                $objectsFacilities->in_city = $in_city;
                $objectsFacilities->in_country = $in_country;
                $objectsFacilities->swimming_pool = $swimming_pool;
                $objectsFacilities->swimming_pool_indoor = $swimming_pool_indoor;
                $objectsFacilities->swimming_pool_indoor_heated = $swimming_pool_indoor_heated;
                $objectsFacilities->swimming_pool_outdoor = $swimming_pool_outdoor;
                $objectsFacilities->swimming_pool_outdoor_heated = $swimming_pool_outdoor_heated;
                $objectsFacilities->parking = $parking;
                $objectsFacilities->sauna = $sauna;
                $objectsFacilities->gym = $gym;
                $objectsFacilities->separate_kitchen = $separate_kitchen;
                $objectsFacilities->elevator = $elevator;
                $objectsFacilities->heating = $heating;
                $objectsFacilities->towels = $towels;
                $objectsFacilities->linen = $linen;
                $objectsFacilities->for_couples = $for_couples;
                $objectsFacilities->for_family = $for_family;
                $objectsFacilities->for_friends = $for_friends;
                $objectsFacilities->for_large_groups = $for_large_groups;
                $objectsFacilities->for_wedings = $for_wedings;
                $objectsFacilities->total_privacy = $total_privacy;
                $objectsFacilities->created = $created;
                $objectsFacilities->changed = $changed;
        
        return $objectsFacilities;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param string $seaview//
            * @param string $babycot//
            * @param string $breakfast//
            * @param string $halfboard//
            * @param string $fullboard//
            * @param string $berth//
            * @param string $jacuzzi//
            * @param string $terrace//
            * @param string $tv_satelite//
            * @param string $wifi//
            * @param string $internet_fast//
            * @param string $internet//
            * @param string $smoking//
            * @param string $luxurious//
            * @param string $air_conditioning//
            * @param string $tv_lcd//
            * @param string $wheelchair_accessible//
            * @param string $near_beach//
            * @param string $pets//
            * @param string $near_country//
            * @param string $near_city//
            * @param string $in_city//
            * @param string $in_country//
            * @param string $swimming_pool//
            * @param string $swimming_pool_indoor//
            * @param string $swimming_pool_indoor_heated//
            * @param string $swimming_pool_outdoor//
            * @param string $swimming_pool_outdoor_heated//
            * @param string $parking//
            * @param string $sauna//
            * @param string $gym//
            * @param string $separate_kitchen//
            * @param string $elevator//
            * @param string $heating//
            * @param string $towels//
            * @param string $linen//
            * @param string $for_couples//
            * @param string $for_family//
            * @param string $for_friends//
            * @param string $for_large_groups//
            * @param string $for_wedings//
            * @param string $total_privacy//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsFacilities    */
    public function edit($id, $user_id, $object_id, $seaview, $babycot, $breakfast, $halfboard, $fullboard, $berth, $jacuzzi, $terrace, $tv_satelite, $wifi, $internet_fast, $internet, $smoking, $luxurious, $air_conditioning, $tv_lcd, $wheelchair_accessible, $near_beach, $pets, $near_country, $near_city, $in_city, $in_country, $swimming_pool, $swimming_pool_indoor, $swimming_pool_indoor_heated, $swimming_pool_outdoor, $swimming_pool_outdoor_heated, $parking, $sauna, $gym, $separate_kitchen, $elevator, $heating, $towels, $linen, $for_couples, $for_family, $for_friends, $for_large_groups, $for_wedings, $total_privacy, $created, $changed): ObjectsFacilities
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->seaview = $seaview;
            $this->babycot = $babycot;
            $this->breakfast = $breakfast;
            $this->halfboard = $halfboard;
            $this->fullboard = $fullboard;
            $this->berth = $berth;
            $this->jacuzzi = $jacuzzi;
            $this->terrace = $terrace;
            $this->tv_satelite = $tv_satelite;
            $this->wifi = $wifi;
            $this->internet_fast = $internet_fast;
            $this->internet = $internet;
            $this->smoking = $smoking;
            $this->luxurious = $luxurious;
            $this->air_conditioning = $air_conditioning;
            $this->tv_lcd = $tv_lcd;
            $this->wheelchair_accessible = $wheelchair_accessible;
            $this->near_beach = $near_beach;
            $this->pets = $pets;
            $this->near_country = $near_country;
            $this->near_city = $near_city;
            $this->in_city = $in_city;
            $this->in_country = $in_country;
            $this->swimming_pool = $swimming_pool;
            $this->swimming_pool_indoor = $swimming_pool_indoor;
            $this->swimming_pool_indoor_heated = $swimming_pool_indoor_heated;
            $this->swimming_pool_outdoor = $swimming_pool_outdoor;
            $this->swimming_pool_outdoor_heated = $swimming_pool_outdoor_heated;
            $this->parking = $parking;
            $this->sauna = $sauna;
            $this->gym = $gym;
            $this->separate_kitchen = $separate_kitchen;
            $this->elevator = $elevator;
            $this->heating = $heating;
            $this->towels = $towels;
            $this->linen = $linen;
            $this->for_couples = $for_couples;
            $this->for_family = $for_family;
            $this->for_friends = $for_friends;
            $this->for_large_groups = $for_large_groups;
            $this->for_wedings = $for_wedings;
            $this->total_privacy = $total_privacy;
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
            'seaview' => Yii::t('app', 'Seaview'),
            'babycot' => Yii::t('app', 'Babycot'),
            'breakfast' => Yii::t('app', 'Breakfast'),
            'halfboard' => Yii::t('app', 'Halfboard'),
            'fullboard' => Yii::t('app', 'Fullboard'),
            'berth' => Yii::t('app', 'Berth'),
            'jacuzzi' => Yii::t('app', 'Jacuzzi'),
            'terrace' => Yii::t('app', 'Terrace'),
            'tv_satelite' => Yii::t('app', 'Tv Satelite'),
            'wifi' => Yii::t('app', 'Wifi'),
            'internet_fast' => Yii::t('app', 'Internet Fast'),
            'internet' => Yii::t('app', 'Internet'),
            'smoking' => Yii::t('app', 'Smoking'),
            'luxurious' => Yii::t('app', 'Luxurious'),
            'air_conditioning' => Yii::t('app', 'Air Conditioning'),
            'tv_lcd' => Yii::t('app', 'Tv Lcd'),
            'wheelchair_accessible' => Yii::t('app', 'Wheelchair Accessible'),
            'near_beach' => Yii::t('app', 'Near Beach'),
            'pets' => Yii::t('app', 'Pets'),
            'near_country' => Yii::t('app', 'Near Country'),
            'near_city' => Yii::t('app', 'Near City'),
            'in_city' => Yii::t('app', 'In City'),
            'in_country' => Yii::t('app', 'In Country'),
            'swimming_pool' => Yii::t('app', 'Swimming Pool'),
            'swimming_pool_indoor' => Yii::t('app', 'Swimming Pool Indoor'),
            'swimming_pool_indoor_heated' => Yii::t('app', 'Swimming Pool Indoor Heated'),
            'swimming_pool_outdoor' => Yii::t('app', 'Swimming Pool Outdoor'),
            'swimming_pool_outdoor_heated' => Yii::t('app', 'Swimming Pool Outdoor Heated'),
            'parking' => Yii::t('app', 'Parking'),
            'sauna' => Yii::t('app', 'Sauna'),
            'gym' => Yii::t('app', 'Gym'),
            'separate_kitchen' => Yii::t('app', 'Separate Kitchen'),
            'elevator' => Yii::t('app', 'Elevator'),
            'heating' => Yii::t('app', 'Heating'),
            'towels' => Yii::t('app', 'Towels'),
            'linen' => Yii::t('app', 'Linen'),
            'for_couples' => Yii::t('app', 'For Couples'),
            'for_family' => Yii::t('app', 'For Family'),
            'for_friends' => Yii::t('app', 'For Friends'),
            'for_large_groups' => Yii::t('app', 'For Large Groups'),
            'for_wedings' => Yii::t('app', 'For Wedings'),
            'total_privacy' => Yii::t('app', 'Total Privacy'),
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsFacilitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsFacilitiesQuery(get_called_class());
    }
}
