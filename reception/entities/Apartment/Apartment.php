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
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property String $location
 * @property String $name
 * @property String $external_id
 * @property Integre $owner_id


 */
class Apartment extends ActiveRecord
{
    public static function create($location,$name,$externalId,$owner=null)
    {
        $apartment = new static();
        $apartment->location = $location;
        $apartment->name = $name;
        $apartment->external_id = $externalId;
        $apartment->owner_id = ($owner)?$owner->id:null;

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
        //В будущем апартаменты смогут иметь более одного замка
        return $this->hasMany(DoorLock::className(), ['apartment_id' => 'id']);
        // return $this->hasOne(DoorLock::className(), ['apartment_id' => 'id']);
    }
}