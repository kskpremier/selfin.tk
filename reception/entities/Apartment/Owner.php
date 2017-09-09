<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/8/17
 * Time: 2:20 PM
 */



namespace reception\entities\Apartment;

use reception\entities\Booking\Booking;
use reception\entities\DoorLock\DoorLock;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property String $location
 * @property String $name
 * @property String $external_id


 */
class Owner extends ActiveRecord
{
    public static function create($user,$externalId)
    {
        $owner = new static();
        $owner->user = $user;
        $owner->external_id = $externalId;

        return $owner;
    }

    public static function tableName(): string
    {
        return '{{%owner}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['user','apartments'],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments()
    {
        return $this->hasMany(Apartment::className(), ['owner_id' => 'id']);
    }
}