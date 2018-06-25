<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsRentsSources;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsApartments;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\PaymentMethod;
use reception\entities\MyRent\RentStatus;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_sources".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property int $rent_status_id
 * @property int $payment_method_id
 * @property string $color
 * @property string $name
 * @property string $link
 * @property string $link_object
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $external
 * @property string $optional
 * @property string $note
 * @property double $charge_extra price of extra charge
 * @property double $provision provision from OTAs in %
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsRentsSources[] $objectsRentsSources
 * @property Rents[] $rents
 * @property RentsApartments[] $rentsApartments
 * @property B2b $b2b
 * @property PaymentMethods $paymentMethod
 * @property RentsStatus $rentStatus
 * @property Users $user
 */
class RentsSources extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_sources';
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
        * @param int $b2b_id//
        * @param int $rent_status_id//
        * @param int $payment_method_id//
        * @param string $color//
        * @param string $name//
        * @param string $link//
        * @param string $link_object//
        * @param string $username//
        * @param string $password//
        * @param string $email//
        * @param string $external//
        * @param string $optional//
        * @param string $note//
        * @param double $charge_extra// price of extra charge
        * @param double $provision// provision from OTAs in %
        * @param string $created//
        * @param string $changed//
        * @return RentsSources    */
    public static function create($id, $user_id, $b2b_id, $rent_status_id, $payment_method_id, $color, $name, $link, $link_object, $username, $password, $email, $external, $optional, $note, $charge_extra, $provision, $created, $changed): RentsSources
    {
        $rentsSources = new static();
                $rentsSources->id = $id;
                $rentsSources->user_id = $user_id;
                $rentsSources->b2b_id = $b2b_id;
                $rentsSources->rent_status_id = $rent_status_id;
                $rentsSources->payment_method_id = $payment_method_id;
                $rentsSources->color = $color;
                $rentsSources->name = $name;
                $rentsSources->link = $link;
                $rentsSources->link_object = $link_object;
                $rentsSources->username = $username;
                $rentsSources->password = $password;
                $rentsSources->email = $email;
                $rentsSources->external = $external;
                $rentsSources->optional = $optional;
                $rentsSources->note = $note;
                $rentsSources->charge_extra = $charge_extra;
                $rentsSources->provision = $provision;
                $rentsSources->created = $created;
                $rentsSources->changed = $changed;
        
        return $rentsSources;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param int $rent_status_id//
            * @param int $payment_method_id//
            * @param string $color//
            * @param string $name//
            * @param string $link//
            * @param string $link_object//
            * @param string $username//
            * @param string $password//
            * @param string $email//
            * @param string $external//
            * @param string $optional//
            * @param string $note//
            * @param double $charge_extra// price of extra charge
            * @param double $provision// provision from OTAs in %
            * @param string $created//
            * @param string $changed//
        * @return RentsSources    */
    public function edit($id, $user_id, $b2b_id, $rent_status_id, $payment_method_id, $color, $name, $link, $link_object, $username, $password, $email, $external, $optional, $note, $charge_extra, $provision, $created, $changed): RentsSources
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->rent_status_id = $rent_status_id;
            $this->payment_method_id = $payment_method_id;
            $this->color = $color;
            $this->name = $name;
            $this->link = $link;
            $this->link_object = $link_object;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->external = $external;
            $this->optional = $optional;
            $this->note = $note;
            $this->charge_extra = $charge_extra;
            $this->provision = $provision;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'rent_status_id' => Yii::t('app', 'Rent Status ID'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'color' => Yii::t('app', 'Color'),
            'name' => Yii::t('app', 'Name'),
            'link' => Yii::t('app', 'Link'),
            'link_object' => Yii::t('app', 'Link Object'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'external' => Yii::t('app', 'External'),
            'optional' => Yii::t('app', 'Optional'),
            'note' => Yii::t('app', 'Note'),
            'charge_extra' => Yii::t('app', 'Charge Extra'),
            'provision' => Yii::t('app', 'Provision'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRentsSources()
    {
        return $this->hasMany(ObjectsRentsSources::class, ['rent_source_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['rent_source_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsApartments()
    {
        return $this->hasMany(RentsApartments::class, ['rent_source_id' => 'id']);
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
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethods::class, ['id' => 'payment_method_id']);
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
     * @return \reception\entities\MyRent\queries\RentsSourcesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsSourcesQuery(get_called_class());
    }
}
