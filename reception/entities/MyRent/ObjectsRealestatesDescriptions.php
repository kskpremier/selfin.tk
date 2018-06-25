<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsRealestatesDescriptionsB2bs;

/**
 * This is the model class for table "objects_realestates_descriptions".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $language_id
 * @property string $title name for the web
 * @property string $short
 * @property string $description
 * @property string $arrival
 * @property string $free_time_activities
 * @property string $landlord
 * @property string $environment
 * @property string $vacation_area
 * @property string $service_availability
 * @property string $cancellation_policies
 * @property string $facilities
 * @property string $equipment
 * @property string $created
 * @property string $changed
 *
 * @property Languages $language
 * @property Objects $object
 * @property Users $user
 * @property ObjectsRealestatesDescriptionsB2b[] $objectsRealestatesDescriptionsB2bs
 */
class ObjectsRealestatesDescriptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realestates_descriptions';
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
        * @param int $language_id//
        * @param string $title// name for the web
        * @param string $short//
        * @param string $description//
        * @param string $arrival//
        * @param string $free_time_activities//
        * @param string $landlord//
        * @param string $environment//
        * @param string $vacation_area//
        * @param string $service_availability//
        * @param string $cancellation_policies//
        * @param string $facilities//
        * @param string $equipment//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealestatesDescriptions    */
    public static function create($id, $user_id, $object_id, $language_id, $title, $short, $description, $arrival, $free_time_activities, $landlord, $environment, $vacation_area, $service_availability, $cancellation_policies, $facilities, $equipment, $created, $changed): ObjectsRealestatesDescriptions
    {
        $objectsRealestatesDescriptions = new static();
                $objectsRealestatesDescriptions->id = $id;
                $objectsRealestatesDescriptions->user_id = $user_id;
                $objectsRealestatesDescriptions->object_id = $object_id;
                $objectsRealestatesDescriptions->language_id = $language_id;
                $objectsRealestatesDescriptions->title = $title;
                $objectsRealestatesDescriptions->short = $short;
                $objectsRealestatesDescriptions->description = $description;
                $objectsRealestatesDescriptions->arrival = $arrival;
                $objectsRealestatesDescriptions->free_time_activities = $free_time_activities;
                $objectsRealestatesDescriptions->landlord = $landlord;
                $objectsRealestatesDescriptions->environment = $environment;
                $objectsRealestatesDescriptions->vacation_area = $vacation_area;
                $objectsRealestatesDescriptions->service_availability = $service_availability;
                $objectsRealestatesDescriptions->cancellation_policies = $cancellation_policies;
                $objectsRealestatesDescriptions->facilities = $facilities;
                $objectsRealestatesDescriptions->equipment = $equipment;
                $objectsRealestatesDescriptions->created = $created;
                $objectsRealestatesDescriptions->changed = $changed;
        
        return $objectsRealestatesDescriptions;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $language_id//
            * @param string $title// name for the web
            * @param string $short//
            * @param string $description//
            * @param string $arrival//
            * @param string $free_time_activities//
            * @param string $landlord//
            * @param string $environment//
            * @param string $vacation_area//
            * @param string $service_availability//
            * @param string $cancellation_policies//
            * @param string $facilities//
            * @param string $equipment//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealestatesDescriptions    */
    public function edit($id, $user_id, $object_id, $language_id, $title, $short, $description, $arrival, $free_time_activities, $landlord, $environment, $vacation_area, $service_availability, $cancellation_policies, $facilities, $equipment, $created, $changed): ObjectsRealestatesDescriptions
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->language_id = $language_id;
            $this->title = $title;
            $this->short = $short;
            $this->description = $description;
            $this->arrival = $arrival;
            $this->free_time_activities = $free_time_activities;
            $this->landlord = $landlord;
            $this->environment = $environment;
            $this->vacation_area = $vacation_area;
            $this->service_availability = $service_availability;
            $this->cancellation_policies = $cancellation_policies;
            $this->facilities = $facilities;
            $this->equipment = $equipment;
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
            'language_id' => Yii::t('app', 'Language ID'),
            'title' => Yii::t('app', 'Title'),
            'short' => Yii::t('app', 'Short'),
            'description' => Yii::t('app', 'Description'),
            'arrival' => Yii::t('app', 'Arrival'),
            'free_time_activities' => Yii::t('app', 'Free Time Activities'),
            'landlord' => Yii::t('app', 'Landlord'),
            'environment' => Yii::t('app', 'Environment'),
            'vacation_area' => Yii::t('app', 'Vacation Area'),
            'service_availability' => Yii::t('app', 'Service Availability'),
            'cancellation_policies' => Yii::t('app', 'Cancellation Policies'),
            'facilities' => Yii::t('app', 'Facilities'),
            'equipment' => Yii::t('app', 'Equipment'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptionsB2bs()
    {
        return $this->hasMany(ObjectsRealestatesDescriptionsB2b::class, ['description_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRealestatesDescriptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealestatesDescriptionsQuery(get_called_class());
    }
}
