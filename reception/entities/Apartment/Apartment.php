<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 16:18
 */

namespace reception\entities\Apartment;

use reception\entities\Booking\Booking;
use reception\entities\DoorLock\DoorLock;
use reception\entities\Apartment\Owner;
use reception\forms\MyRent\ApartmentForm;
use reception\services\MyRent\MyRent;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property String $location
 * @property Integer $id
 * @property String $name
 * @property String $external_id
 * @property Integer $owner_id
 * @property Integer $user_id
 * @property Integer $worker_id
 * @property float  $latitude 
 * @property float  $longitude 
 * @property String $city_name 
 * @property String $country
 * @property String $adress
 * @property string $guid
 * @property String $object_color
 * @property integer $myrent_update
 * 
 */
class Apartment extends ActiveRecord
{
    public static function create($location=null, $name, $externalId, $owner = null,
                                  $latitude = null,$longitude = null, $city_name = null, $adress = null, $object_color= null, $guid = null,
                                    $user_id = null, $worker_id = null, $country = null, $doorlocks)
    {
        $apartment = new static();
        $apartment->location = $location;
        $apartment->name = $name;
        
        $apartment->latitude = $latitude;
        $apartment->longitude = $longitude;
        $apartment->city_name = $city_name;
        $apartment->adress = $adress;
        $apartment->country = $country;

        $apartment->object_color = $object_color;
        $apartment->guid = $guid;
        
        $apartment->external_id = $externalId;
        $apartment->owner_id = ($owner)? $owner->id : null;
        $apartment->user_id = ($user_id)? $user_id : null;
        $apartment->worker_id = ($worker_id)? $worker_id : null;

        $apartment->doorloks = $doorlocks;

        return $apartment;
    }

    public static function createProperty(ApartmentForm $form, $user_id = null, $updateTime = null, $owner_id=null)
    {
        $apartment = new static(); //$doorlocks=[];
        
        $apartment->name = ($form->name)?$form->name:$form->object_name;
        $apartment->latitude = $form->latitude;
        $apartment->longitude = $form->longitude;
        $apartment->city_name = $form->city_name;
        $apartment->adress = $form->adress;
        $apartment->country = $form->country;
        $apartment->object_color = $form->object_color;
        $apartment->guid = $form->guid;
        $apartment->external_id = $form->object_id;
        $apartment->user_id = $user_id;
        $apartment->owner_id = $owner_id;
        $apartment->myrent_update = ($updateTime)? $updateTime : time();
////надо делать функцию по удалению старых и назначению новых замков по идеее
//        foreach($form->doorlocks as $form){
//            $doorLock = $this->doorLock->findByID($form->id);
//            if ($doorLock)
//                $doorlocks[]= DoorLock::create($form);
//        }
//        $apartment->doorLocks = $doorlocks;

        return $apartment;
    }

    public function edit(ApartmentForm $form, $user_id = null, $updateTime = null, $owner_id=null)
    {
//        if ((($updateTime - $this->myrent_update) < MyRent::MyRent_UPDATE_INTERVAL) || $this->myrent_update===null){
            $this->name = ($form->name)?$form->name:$form->object_name;
            $this->latitude = $form->latitude;
            $this->longitude = $form->longitude;
            $this->city_name = $form->city_name;
            $this->adress = $form->adress;
            $this->country = $form->country;
            $this->object_color = $form->object_color;
            $this->guid = $form->guid;
            $this->external_id = $form->object_id;
            $this->user_id = $user_id;
            $this->owner_id = $owner_id;
            $this->myrent_update = ($updateTime)? $updateTime : time();
//надо делать функцию по удалению старых и назначению новых замков по идеее
//            $this->doorLocks = $form->doorlocks;
//        }
        return $this;
    }


    public static function addProperty(ApartmentForm $form, $user_id = null, $updateTime)
    {
        $apartment = new static();
        
        $apartment->name = $form->name;
        $apartment->latitude = $form->latitude;
        $apartment->longitude = $form->longitude;
        $apartment->city_name = $form->city_name;
        $apartment->adress = $form->adress;
        $apartment->country = $form->country;
        $apartment->object_color = $form->object_color;
        $apartment->guid = $form->guid;
        $apartment->external_id = $form->object_id;
        $apartment->user_id = $user_id;
        $apartment->myrent_update = $updateTime;


        return $apartment;
    }

    public static function tableName(): string
    {
        return '{{%apartment}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['doorLocks','owner'],
            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owner ::className(), ['id' => 'owner_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['apartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCameras()
    {
        return $this->hasMany(Camera::className(), ['apartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLocks()
    {
        return $this->hasMany(DoorLock ::className(), ['apartment_id' => 'id']);
    }
}