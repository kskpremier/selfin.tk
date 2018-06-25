<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\RentSource;
use reception\entities\MyRent\RentStatus;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_rents_sources".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $rent_status_id
 * @property int $rent_source_id
 * @property int $b2b_id
 * @property string $link link from where we pull data
 * @property string $active
 * @property string $searchable is new reservation searchable or not
 * @property int $error_number number of errors
 * @property string $error_message
 * @property double $sync_time sync time in ms
 * @property string $sync_datetime whene was last succes sync
 * @property string $source_name name of object in that source
 * @property string $source_link_preview html link for preview of that object
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Objects $object
 * @property RentsSources $rentSource
 * @property RentsStatus $rentStatus
 * @property Users $user
 */
class ObjectsRentsSources extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_rents_sources';
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
        * @param int $rent_status_id//
        * @param int $rent_source_id//
        * @param int $b2b_id//
        * @param string $link// link from where we pull data
        * @param string $active//
        * @param string $searchable// is new reservation searchable or not
        * @param int $error_number// number of errors
        * @param string $error_message//
        * @param double $sync_time// sync time in ms
        * @param string $sync_datetime// whene was last succes sync
        * @param string $source_name// name of object in that source
        * @param string $source_link_preview// html link for preview of that object
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRentsSources    */
    public static function create($id, $user_id, $object_id, $rent_status_id, $rent_source_id, $b2b_id, $link, $active, $searchable, $error_number, $error_message, $sync_time, $sync_datetime, $source_name, $source_link_preview, $created, $changed): ObjectsRentsSources
    {
        $objectsRentsSources = new static();
                $objectsRentsSources->id = $id;
                $objectsRentsSources->user_id = $user_id;
                $objectsRentsSources->object_id = $object_id;
                $objectsRentsSources->rent_status_id = $rent_status_id;
                $objectsRentsSources->rent_source_id = $rent_source_id;
                $objectsRentsSources->b2b_id = $b2b_id;
                $objectsRentsSources->link = $link;
                $objectsRentsSources->active = $active;
                $objectsRentsSources->searchable = $searchable;
                $objectsRentsSources->error_number = $error_number;
                $objectsRentsSources->error_message = $error_message;
                $objectsRentsSources->sync_time = $sync_time;
                $objectsRentsSources->sync_datetime = $sync_datetime;
                $objectsRentsSources->source_name = $source_name;
                $objectsRentsSources->source_link_preview = $source_link_preview;
                $objectsRentsSources->created = $created;
                $objectsRentsSources->changed = $changed;
        
        return $objectsRentsSources;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $rent_status_id//
            * @param int $rent_source_id//
            * @param int $b2b_id//
            * @param string $link// link from where we pull data
            * @param string $active//
            * @param string $searchable// is new reservation searchable or not
            * @param int $error_number// number of errors
            * @param string $error_message//
            * @param double $sync_time// sync time in ms
            * @param string $sync_datetime// whene was last succes sync
            * @param string $source_name// name of object in that source
            * @param string $source_link_preview// html link for preview of that object
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRentsSources    */
    public function edit($id, $user_id, $object_id, $rent_status_id, $rent_source_id, $b2b_id, $link, $active, $searchable, $error_number, $error_message, $sync_time, $sync_datetime, $source_name, $source_link_preview, $created, $changed): ObjectsRentsSources
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->rent_status_id = $rent_status_id;
            $this->rent_source_id = $rent_source_id;
            $this->b2b_id = $b2b_id;
            $this->link = $link;
            $this->active = $active;
            $this->searchable = $searchable;
            $this->error_number = $error_number;
            $this->error_message = $error_message;
            $this->sync_time = $sync_time;
            $this->sync_datetime = $sync_datetime;
            $this->source_name = $source_name;
            $this->source_link_preview = $source_link_preview;
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
            'rent_status_id' => Yii::t('app', 'Rent Status ID'),
            'rent_source_id' => Yii::t('app', 'Rent Source ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'link' => Yii::t('app', 'Link'),
            'active' => Yii::t('app', 'Active'),
            'searchable' => Yii::t('app', 'Searchable'),
            'error_number' => Yii::t('app', 'Error Number'),
            'error_message' => Yii::t('app', 'Error Message'),
            'sync_time' => Yii::t('app', 'Sync Time'),
            'sync_datetime' => Yii::t('app', 'Sync Datetime'),
            'source_name' => Yii::t('app', 'Source Name'),
            'source_link_preview' => Yii::t('app', 'Source Link Preview'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
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
    public function getRentSource()
    {
        return $this->hasOne(RentsSources::class, ['id' => 'rent_source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentStatus()
    {
        return $this->hasOne(RentsStatus::class, ['id' => 'rent_status_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRentsSourcesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRentsSourcesQuery(get_called_class());
    }
}
