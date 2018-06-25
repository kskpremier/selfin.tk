<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "units_tmp".
 *
 * @property int $id
 * @property int $user_id
 * @property int $owner_id
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
 * @property string $latitude
 * @property string $longitude
 * @property string $adress
 * @property string $adress_number
 * @property string $city_name
 * @property string $city_zip
 * @property int $country_id
 * @property string $hide_exact_position
 * @property string $created
 * @property string $changed
 */
class UnitsTmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_tmp';
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
        * @param string $latitude//
        * @param string $longitude//
        * @param string $adress//
        * @param string $adress_number//
        * @param string $city_name//
        * @param string $city_zip//
        * @param int $country_id//
        * @param string $hide_exact_position//
        * @param string $created//
        * @param string $changed//
        * @return UnitsTmp    */
    public static function create($id, $user_id, $owner_id, $unit, $erp_id, $name, $description, $note, $active, $contact_name, $contact_telephone, $contact_telephone_mobile, $contact_email, $contact_web, $contact_welcome, $latitude, $longitude, $adress, $adress_number, $city_name, $city_zip, $country_id, $hide_exact_position, $created, $changed): UnitsTmp
    {
        $unitsTmp = new static();
                $unitsTmp->id = $id;
                $unitsTmp->user_id = $user_id;
                $unitsTmp->owner_id = $owner_id;
                $unitsTmp->unit = $unit;
                $unitsTmp->erp_id = $erp_id;
                $unitsTmp->name = $name;
                $unitsTmp->description = $description;
                $unitsTmp->note = $note;
                $unitsTmp->active = $active;
                $unitsTmp->contact_name = $contact_name;
                $unitsTmp->contact_telephone = $contact_telephone;
                $unitsTmp->contact_telephone_mobile = $contact_telephone_mobile;
                $unitsTmp->contact_email = $contact_email;
                $unitsTmp->contact_web = $contact_web;
                $unitsTmp->contact_welcome = $contact_welcome;
                $unitsTmp->latitude = $latitude;
                $unitsTmp->longitude = $longitude;
                $unitsTmp->adress = $adress;
                $unitsTmp->adress_number = $adress_number;
                $unitsTmp->city_name = $city_name;
                $unitsTmp->city_zip = $city_zip;
                $unitsTmp->country_id = $country_id;
                $unitsTmp->hide_exact_position = $hide_exact_position;
                $unitsTmp->created = $created;
                $unitsTmp->changed = $changed;
        
        return $unitsTmp;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $owner_id//
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
            * @param string $latitude//
            * @param string $longitude//
            * @param string $adress//
            * @param string $adress_number//
            * @param string $city_name//
            * @param string $city_zip//
            * @param int $country_id//
            * @param string $hide_exact_position//
            * @param string $created//
            * @param string $changed//
        * @return UnitsTmp    */
    public function edit($id, $user_id, $owner_id, $unit, $erp_id, $name, $description, $note, $active, $contact_name, $contact_telephone, $contact_telephone_mobile, $contact_email, $contact_web, $contact_welcome, $latitude, $longitude, $adress, $adress_number, $city_name, $city_zip, $country_id, $hide_exact_position, $created, $changed): UnitsTmp
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->owner_id = $owner_id;
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
            $this->latitude = $latitude;
            $this->longitude = $longitude;
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
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitsTmpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsTmpQuery(get_called_class());
    }
}
