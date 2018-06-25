<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 11/5/17
 * Time: 8:12 PM
 */


namespace reception\entities\MyRent;

use reception\entities\MyRent\User\User;
use reception\entities\MyRent\Apartment\Apartment;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 *  @property Apartment[] $apartments;

 *  @property integer  $external_id;
 *  @property integer $user_id
 *  @property string  $guid
 *  @property string  $name
 *  @property integer $country_id
 *  @property string  $tel
 *  @property string  $email
 *  @property string  $contact_name
 *  @property string  $created
 *  @property string  $changed
 *  @property integer $language_id
 *  @property string  $country
 *  @property string  $name_local
 *  @property integer $telephone_code

 */
class Worker extends ActiveRecord
{
    public static function create( $external_id, $guid, $name, $country_id, $tel, $email,
                                   $contact_name, $created, $changed, $language_id, $country,
                                   $name_local, $telephone_code,  $user_id, $apartments = null)
    {
        $owner = new static();
        $owner->user_id = $user_id ;
        $owner->guid= $guid ;
        $owner->name= $name;
        $owner->country_id= $country_id;
        $owner->tel= $tel;
        $owner->email= $email;
        $owner->contact_name= $contact_name;
        $owner->created= $created;
        $owner->changed= $changed;
        $owner->language_id= $language_id;
        $owner->country= $country;
        $owner->name_local= $name_local;
        $owner->telephone_code= $telephone_code;

        $owner->external_id = $external_id;
        $owner->apartments = $apartments;

        return $owner;
    }

    public function updateApartment ($apartments)
    {

        $this->apartments = $apartments;
    }

    public function saveUpdate ($time)
    {
        $this->update = $time;
        $this->save();
    }

    public static function tableName(): string
    {
        return '{{%worker}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['user','apartments'],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments()
    {
        return $this->hasMany(Apartment::class, ['owner_id' => 'id']);
    }
}