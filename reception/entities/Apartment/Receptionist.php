<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/8/17
 * Time: 2:20 PM
 */



namespace reception\entities\Apartment;

use reception\entities\User\User;
use reception\entities\Apartment\Owner;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property String $location
 * @property integer $id
 * @property String $name
 * @property User $user
 * @property String $external_id
 * @property Apartment [] $apartments


 */
class Receptionist extends ActiveRecord
{
    public static function create( $externalId, $owners, $user)
    {
        $receptionist = new static();
        $receptionist->user = $user;
        $receptionist->external_id = $externalId;
        $receptionist->owners = $owners;

        return $receptionist;
    }

    public function updateOwners ($owners)
    {
        $this->owners = $owners;
    }

    public static function tableName(): string
    {
        return '{{%receptionist}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['user','owners'],
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
    public function getOwners()
    {
        return $this->hasMany(Owner::className(), ['receptionist_id' => 'id']);
    }
}