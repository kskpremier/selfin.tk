<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Guest;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "guests_city_taxes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $guest_id
 * @property int $rent_id
 * @property string $day
 * @property double $price
 * @property string $created
 * @property string $changed
 *
 * @property Guests $guest
 * @property Rents $rent
 * @property Users $user
 */
class GuestsCityTaxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guests_city_taxes';
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
        * @param int $guest_id//
        * @param int $rent_id//
        * @param string $day//
        * @param double $price//
        * @param string $created//
        * @param string $changed//
        * @return GuestsCityTaxes    */
    public static function create($id, $user_id, $guest_id, $rent_id, $day, $price, $created, $changed): GuestsCityTaxes
    {
        $guestsCityTaxes = new static();
                $guestsCityTaxes->id = $id;
                $guestsCityTaxes->user_id = $user_id;
                $guestsCityTaxes->guest_id = $guest_id;
                $guestsCityTaxes->rent_id = $rent_id;
                $guestsCityTaxes->day = $day;
                $guestsCityTaxes->price = $price;
                $guestsCityTaxes->created = $created;
                $guestsCityTaxes->changed = $changed;
        
        return $guestsCityTaxes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $guest_id//
            * @param int $rent_id//
            * @param string $day//
            * @param double $price//
            * @param string $created//
            * @param string $changed//
        * @return GuestsCityTaxes    */
    public function edit($id, $user_id, $guest_id, $rent_id, $day, $price, $created, $changed): GuestsCityTaxes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guest_id = $guest_id;
            $this->rent_id = $rent_id;
            $this->day = $day;
            $this->price = $price;
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
            'guest_id' => Yii::t('app', 'Guest ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'day' => Yii::t('app', 'Day'),
            'price' => Yii::t('app', 'Price'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(Guests::class, ['id' => 'guest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
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
     * @return \reception\entities\MyRent\queries\GuestsCityTaxesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\GuestsCityTaxesQuery(get_called_class());
    }
}
