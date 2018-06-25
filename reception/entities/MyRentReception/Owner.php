<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 11/5/17
 * Time: 8:12 PM
 */


namespace reception\entities\MyRent;

use reception\entities\User\User;
use reception\entities\Apartment\Apartment;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 *  @property Apartment[] $apartments;

 *  @property integer  $external_id;
 *  @property integer $user_id
 *  @property string  $guid
 *  @property string  $name
 *  @property integer $country_id
 *  @property string  $contact_tel
 *  @property string  $contact_email
 *  @property string  $contact_name
 *  @property string  $created
 *  @property string  $changed
 *  @property integer $language_id
 *  @property string  $country
 *  @property string  $name_local
 *  @property integer $telephone_code

 */
class Owner extends ActiveRecord
{
    public static function create( $external_id, $guid, $name, $country_id, $tel, $email,
                                   $contact_name, $created, $changed, $language_id=null, $country=null,
                                   $name_local=null, $telephone_code=null,  $user_id, $apartments = null)
    { 
        $owner = new static();
        $owner->user_id = $user_id ;
        $owner->guid= $guid ;
        //$owner->name= $name;
        $owner->country_id= $country_id;
        $owner->contact_tel= $tel;
        $owner->contact_email= $email;
        $owner->contact_name= $contact_name;
        $owner->created= $created;
        $owner->changed= $changed;
       // $owner->language_id= $language_id;
        $owner->country_id= $country;
        //$owner->name_local= $name_local;
        //$owner->telephone_code= $telephone_code;

        $owner->external_id = $external_id;
        $owner->apartments = $apartments;

        return $owner;
    }

    public function updateMyRentOwner()
    {
        $updateTime = time();
        $apartments = [];
        if (($this->myrent_update === null) || ($updateTime - $this->myrent_update > MyRent::MyRent_UPDATE_INTERVAL)) {
            //запросить список апартаментов
            $apartmentList = MyRent::getApartmentsForOwner($this->user->external_id);
            foreach ($apartmentList as $apartmentData) {
                try {
                    $form = new ApartmentForm();
                    $form->load($apartmentData, '');
                    if ($form->validate()) {
                        $apartment = Apartment::create($form);
                        foreach ($form->doorlocks as $doorLockForm) {
                            $doorLocks[] = DoorLock::installInApartment($apartment->id, $doorLockForm->name, $doorLockForm->id);
                        }
                        $apartment->doorlocks = $doorLocks;
                        $apartments[] = $apartment;
                    } else throw new \DomainException ('Failed to create the object => ' . \GuzzleHttp\json_encode($form->getFirstErrors()));
                    //записать owner новое время
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                }
            }
        }
        $this->apartments = $apartments;
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