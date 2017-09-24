<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/8/17
 * Time: 2:20 PM
 */



namespace reception\entities\Apartment;

use reception\entities\User\User;
use reception\entities\Apartment\Apartment;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property String $location
 * @property String $name
 * @property User $user
 * @property String $external_id
 * * @property Apartment [] $apartments


 */
class Owner extends ActiveRecord
{
    public static function create( $externalId, $apartments, $user)
    {
        $owner = new static();
        $owner->user = $user;
        $owner->external_id = $externalId;
        $owner->apartments = $apartments;

        return $owner;
    }

    public function updateApartment ($apartments)
    {
        $this->apartments = $apartments;
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