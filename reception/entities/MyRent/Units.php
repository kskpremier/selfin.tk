<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ItemsPeriods;
use reception\entities\MyRent\ItemsPrices;
use reception\entities\MyRent\LogUnitsFis;
use reception\entities\MyRent\ObjectRealstateMailDescriptions;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsItems;
use reception\entities\MyRent\UnitWelcomeDescriptions;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\Settlment;
use reception\entities\MyRent\Area;
use reception\entities\MyRent\Office;
use reception\entities\MyRent\Owner;
use reception\entities\MyRent\User;
use reception\entities\MyRent\UnitsContacts;
use reception\entities\MyRent\UnitsFiles;
use reception\entities\MyRent\UnitsFis;
use reception\entities\MyRent\UnitsIbans;

/**
 * This is the model class for table "units".
 *
 * @property int $id
 * @property int $user_id
 * @property int $owner_id
 * @property int $settlment_id
 * @property int $office_id what office belongs
 * @property int $area_id link to area from locations
 * @property string $unit
 * @property string $erp_id
 * @property string $name
 * @property string $description
 * @property string $note
 * @property string $active
 * @property string $contact_name
 * @property string $contact_telephone
 * @property string $contact_telephone_mobile
 * @property string $contact_email
 * @property string $contact_web
 * @property string $contact_welcome
 * @property string $contact_confirmation
 * @property string $url url of location
 * @property string $latitude
 * @property string $longitude
 * @property string $position_geo
 * @property string $adress
 * @property string $adress_number
 * @property string $city_name
 * @property string $city_zip
 * @property int $country_id
 * @property string $hide_exact_position
 * @property string $created
 * @property string $changed
 *
 * @property ItemsPeriod[] $itemsPeriods
 * @property ItemsPrices[] $itemsPrices
 * @property LogUnitsFis[] $logUnitsFis
 * @property ObjectRealstateMailDescription[] $objectRealstateMailDescriptions
 * @property Objects[] $objects
 * @property ObjectsItems[] $objectsItems
 * @property UnitWelcomeDescription[] $unitWelcomeDescriptions
 * @property Countries $country
 * @property CountriesSettlments $settlment
 * @property LocationsAreas $area
 * @property Offices $office
 * @property Owners $owner
 * @property Users $user
 * @property UnitsContacts[] $unitsContacts
 * @property UnitsFiles[] $unitsFiles
 * @property UnitsFis[] $unitsFis
 * @property UnitsIban[] $unitsIbans
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units';
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
        * @param int $owner_id//
        * @param int $settlment_id//
        * @param int $office_id// what office belongs
        * @param int $area_id// link to area from locations
        * @param string $unit//
        * @param string $erp_id//
        * @param string $name//
        * @param string $description//
        * @param string $note//
        * @param string $active//
        * @param string $contact_name//
        * @param string $contact_telephone//
        * @param string $contact_telephone_mobile//
        * @param string $contact_email//
        * @param string $contact_web//
        * @param string $contact_welcome//
        * @param string $contact_confirmation//
        * @param string $url// url of location
        * @param string $latitude//
        * @param string $longitude//
        * @param string $position_geo//
        * @param string $adress//
        * @param string $adress_number//
        * @param string $city_name//
        * @param string $city_zip//
        * @param int $country_id//
        * @param string $hide_exact_position//
        * @param string $created//
        * @param string $changed//
        * @return Units    */
    public static function create($id, $user_id, $owner_id, $settlment_id, $office_id, $area_id, $unit, $erp_id, $name, $description, $note, $active, $contact_name, $contact_telephone, $contact_telephone_mobile, $contact_email, $contact_web, $contact_welcome, $contact_confirmation, $url, $latitude, $longitude, $position_geo, $adress, $adress_number, $city_name, $city_zip, $country_id, $hide_exact_position, $created, $changed): Units
    {
        $units = new static();
                $units->id = $id;
                $units->user_id = $user_id;
                $units->owner_id = $owner_id;
                $units->settlment_id = $settlment_id;
                $units->office_id = $office_id;
                $units->area_id = $area_id;
                $units->unit = $unit;
                $units->erp_id = $erp_id;
                $units->name = $name;
                $units->description = $description;
                $units->note = $note;
                $units->active = $active;
                $units->contact_name = $contact_name;
                $units->contact_telephone = $contact_telephone;
                $units->contact_telephone_mobile = $contact_telephone_mobile;
                $units->contact_email = $contact_email;
                $units->contact_web = $contact_web;
                $units->contact_welcome = $contact_welcome;
                $units->contact_confirmation = $contact_confirmation;
                $units->url = $url;
                $units->latitude = $latitude;
                $units->longitude = $longitude;
                $units->position_geo = $position_geo;
                $units->adress = $adress;
                $units->adress_number = $adress_number;
                $units->city_name = $city_name;
                $units->city_zip = $city_zip;
                $units->country_id = $country_id;
                $units->hide_exact_position = $hide_exact_position;
                $units->created = $created;
                $units->changed = $changed;
        
        return $units;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $owner_id//
            * @param int $settlment_id//
            * @param int $office_id// what office belongs
            * @param int $area_id// link to area from locations
            * @param string $unit//
            * @param string $erp_id//
            * @param string $name//
            * @param string $description//
            * @param string $note//
            * @param string $active//
            * @param string $contact_name//
            * @param string $contact_telephone//
            * @param string $contact_telephone_mobile//
            * @param string $contact_email//
            * @param string $contact_web//
            * @param string $contact_welcome//
            * @param string $contact_confirmation//
            * @param string $url// url of location
            * @param string $latitude//
            * @param string $longitude//
            * @param string $position_geo//
            * @param string $adress//
            * @param string $adress_number//
            * @param string $city_name//
            * @param string $city_zip//
            * @param int $country_id//
            * @param string $hide_exact_position//
            * @param string $created//
            * @param string $changed//
        * @return Units    */
    public function edit($id, $user_id, $owner_id, $settlment_id, $office_id, $area_id, $unit, $erp_id, $name, $description, $note, $active, $contact_name, $contact_telephone, $contact_telephone_mobile, $contact_email, $contact_web, $contact_welcome, $contact_confirmation, $url, $latitude, $longitude, $position_geo, $adress, $adress_number, $city_name, $city_zip, $country_id, $hide_exact_position, $created, $changed): Units
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->owner_id = $owner_id;
            $this->settlment_id = $settlment_id;
            $this->office_id = $office_id;
            $this->area_id = $area_id;
            $this->unit = $unit;
            $this->erp_id = $erp_id;
            $this->name = $name;
            $this->description = $description;
            $this->note = $note;
            $this->active = $active;
            $this->contact_name = $contact_name;
            $this->contact_telephone = $contact_telephone;
            $this->contact_telephone_mobile = $contact_telephone_mobile;
            $this->contact_email = $contact_email;
            $this->contact_web = $contact_web;
            $this->contact_welcome = $contact_welcome;
            $this->contact_confirmation = $contact_confirmation;
            $this->url = $url;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->position_geo = $position_geo;
            $this->adress = $adress;
            $this->adress_number = $adress_number;
            $this->city_name = $city_name;
            $this->city_zip = $city_zip;
            $this->country_id = $country_id;
            $this->hide_exact_position = $hide_exact_position;
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
            'owner_id' => Yii::t('app', 'Owner ID'),
            'settlment_id' => Yii::t('app', 'Settlment ID'),
            'office_id' => Yii::t('app', 'Office ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'unit' => Yii::t('app', 'Unit'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'note' => Yii::t('app', 'Note'),
            'active' => Yii::t('app', 'Active'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'contact_telephone' => Yii::t('app', 'Contact Telephone'),
            'contact_telephone_mobile' => Yii::t('app', 'Contact Telephone Mobile'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_web' => Yii::t('app', 'Contact Web'),
            'contact_welcome' => Yii::t('app', 'Contact Welcome'),
            'contact_confirmation' => Yii::t('app', 'Contact Confirmation'),
            'url' => Yii::t('app', 'Url'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'position_geo' => Yii::t('app', 'Position Geo'),
            'adress' => Yii::t('app', 'Adress'),
            'adress_number' => Yii::t('app', 'Adress Number'),
            'city_name' => Yii::t('app', 'City Name'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'country_id' => Yii::t('app', 'Country ID'),
            'hide_exact_position' => Yii::t('app', 'Hide Exact Position'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPeriods()
    {
        return $this->hasMany(ItemsPeriod::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPrices()
    {
        return $this->hasMany(ItemsPrices::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogUnitsFis()
    {
        return $this->hasMany(LogUnitsFis::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectRealstateMailDescriptions()
    {
        return $this->hasMany(ObjectRealstateMailDescription::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsItems()
    {
        return $this->hasMany(ObjectsItems::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitWelcomeDescriptions()
    {
        return $this->hasMany(UnitWelcomeDescription::class, ['unit_id' => 'id']);
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
    public function getSettlment()
    {
        return $this->hasOne(CountriesSettlments::class, ['id' => 'settlment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(LocationsAreas::class, ['id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Offices::class, ['id' => 'office_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owners::class, ['id' => 'owner_id']);
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
    public function getUnitsContacts()
    {
        return $this->hasMany(UnitsContacts::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsFiles()
    {
        return $this->hasMany(UnitsFiles::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsFis()
    {
        return $this->hasMany(UnitsFis::class, ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsIbans()
    {
        return $this->hasMany(UnitsIban::class, ['unit_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsQuery(get_called_class());
    }
}
