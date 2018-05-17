<?php

namespace backend\models;

use Yii;

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
     * @inheritdoc
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
        return Yii::$app->get('dbMyRentLocal');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'owner_id', 'settlment_id', 'office_id', 'area_id', 'country_id'], 'integer'],
            [['note', 'active', 'contact_welcome', 'contact_confirmation', 'position_geo', 'hide_exact_position'], 'string'],
            [['created', 'changed'], 'safe'],
            [['unit', 'erp_id', 'contact_name', 'contact_telephone', 'contact_telephone_mobile', 'contact_email', 'contact_web', 'latitude', 'longitude', 'adress', 'adress_number', 'city_name', 'city_zip'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 150],
            [['url'], 'string', 'max' => 200],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['settlment_id'], 'exist', 'skipOnError' => true, 'targetClass' => CountriesSettlments::className(), 'targetAttribute' => ['settlment_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationsAreas::className(), 'targetAttribute' => ['area_id' => 'id']],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offices::className(), 'targetAttribute' => ['office_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Owners::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'owner_id' => 'Owner ID',
            'settlment_id' => 'Settlment ID',
            'office_id' => 'Office ID',
            'area_id' => 'Area ID',
            'unit' => 'Unit',
            'erp_id' => 'Erp ID',
            'name' => 'Name',
            'description' => 'Description',
            'note' => 'Note',
            'active' => 'Active',
            'contact_name' => 'Contact Name',
            'contact_telephone' => 'Contact Telephone',
            'contact_telephone_mobile' => 'Contact Telephone Mobile',
            'contact_email' => 'Contact Email',
            'contact_web' => 'Contact Web',
            'contact_welcome' => 'Contact Welcome',
            'contact_confirmation' => 'Contact Confirmation',
            'url' => 'Url',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'position_geo' => 'Position Geo',
            'adress' => 'Adress',
            'adress_number' => 'Adress Number',
            'city_name' => 'City Name',
            'city_zip' => 'City Zip',
            'country_id' => 'Country ID',
            'hide_exact_position' => 'Hide Exact Position',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPeriods()
    {
        return $this->hasMany(ItemsPeriod::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPrices()
    {
        return $this->hasMany(ItemsPrices::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogUnitsFis()
    {
        return $this->hasMany(LogUnitsFis::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectRealstateMailDescriptions()
    {
        return $this->hasMany(ObjectRealstateMailDescription::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsItems()
    {
        return $this->hasMany(ObjectsItems::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitWelcomeDescriptions()
    {
        return $this->hasMany(UnitWelcomeDescription::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettlment()
    {
        return $this->hasOne(CountriesSettlments::className(), ['id' => 'settlment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(LocationsAreas::className(), ['id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Offices::className(), ['id' => 'office_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owners::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsContacts()
    {
        return $this->hasMany(UnitsContacts::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsFiles()
    {
        return $this->hasMany(UnitsFiles::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsFis()
    {
        return $this->hasMany(UnitsFis::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsIbans()
    {
        return $this->hasMany(UnitsIban::className(), ['unit_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UnitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitsQuery(get_called_class());
    }
}
