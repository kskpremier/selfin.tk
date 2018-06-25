<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Guest;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "guests_evisitor".
 *
 * @property int $id
 * @property int $user_id
 * @property int $guest_id
 * @property string $guid
 * @property string $document_type
 * @property string $document_number
 * @property string $gender
 * @property string $birth_country
 * @property string $birth_city
 * @property string $birth_date yyyymmdd
 * @property string $birth_date_date
 * @property string $citizenship
 * @property string $visa_validity_date
 * @property string $visa_type
 * @property string $visa_number
 * @property string $residence_country
 * @property string $residence_city
 * @property string $residence_adress
 * @property string $passage_date
 * @property string $border_crossing
 * @property string $tt_payment_category
 * @property string $arrival_organisation
 * @property string $offered_service_type noćenje
 * @property string $checkin
 * @property string $checkout
 * @property string $verified virfy data for sending
 * @property string $created
 * @property string $changed
 *
 * @property Guests $guest
 * @property Users $user
 */
class GuestsEvisitor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guests_evisitor';
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
        * @param string $guid//
        * @param string $document_type//
        * @param string $document_number//
        * @param string $gender//
        * @param string $birth_country//
        * @param string $birth_city//
        * @param string $birth_date// yyyymmdd
        * @param string $birth_date_date//
        * @param string $citizenship//
        * @param string $visa_validity_date//
        * @param string $visa_type//
        * @param string $visa_number//
        * @param string $residence_country//
        * @param string $residence_city//
        * @param string $residence_adress//
        * @param string $passage_date//
        * @param string $border_crossing//
        * @param string $tt_payment_category//
        * @param string $arrival_organisation//
        * @param string $offered_service_type// noćenje
        * @param string $checkin//
        * @param string $checkout//
        * @param string $verified// virfy data for sending
        * @param string $created//
        * @param string $changed//
        * @return GuestsEvisitor    */
    public static function create($id, $user_id, $guest_id, $guid, $document_type, $document_number, $gender, $birth_country, $birth_city, $birth_date, $birth_date_date, $citizenship, $visa_validity_date, $visa_type, $visa_number, $residence_country, $residence_city, $residence_adress, $passage_date, $border_crossing, $tt_payment_category, $arrival_organisation, $offered_service_type, $checkin, $checkout, $verified, $created, $changed): GuestsEvisitor
    {
        $guestsEvisitor = new static();
                $guestsEvisitor->id = $id;
                $guestsEvisitor->user_id = $user_id;
                $guestsEvisitor->guest_id = $guest_id;
                $guestsEvisitor->guid = $guid;
                $guestsEvisitor->document_type = $document_type;
                $guestsEvisitor->document_number = $document_number;
                $guestsEvisitor->gender = $gender;
                $guestsEvisitor->birth_country = $birth_country;
                $guestsEvisitor->birth_city = $birth_city;
                $guestsEvisitor->birth_date = $birth_date;
                $guestsEvisitor->birth_date_date = $birth_date_date;
                $guestsEvisitor->citizenship = $citizenship;
                $guestsEvisitor->visa_validity_date = $visa_validity_date;
                $guestsEvisitor->visa_type = $visa_type;
                $guestsEvisitor->visa_number = $visa_number;
                $guestsEvisitor->residence_country = $residence_country;
                $guestsEvisitor->residence_city = $residence_city;
                $guestsEvisitor->residence_adress = $residence_adress;
                $guestsEvisitor->passage_date = $passage_date;
                $guestsEvisitor->border_crossing = $border_crossing;
                $guestsEvisitor->tt_payment_category = $tt_payment_category;
                $guestsEvisitor->arrival_organisation = $arrival_organisation;
                $guestsEvisitor->offered_service_type = $offered_service_type;
                $guestsEvisitor->checkin = $checkin;
                $guestsEvisitor->checkout = $checkout;
                $guestsEvisitor->verified = $verified;
                $guestsEvisitor->created = $created;
                $guestsEvisitor->changed = $changed;
        
        return $guestsEvisitor;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $guest_id//
            * @param string $guid//
            * @param string $document_type//
            * @param string $document_number//
            * @param string $gender//
            * @param string $birth_country//
            * @param string $birth_city//
            * @param string $birth_date// yyyymmdd
            * @param string $birth_date_date//
            * @param string $citizenship//
            * @param string $visa_validity_date//
            * @param string $visa_type//
            * @param string $visa_number//
            * @param string $residence_country//
            * @param string $residence_city//
            * @param string $residence_adress//
            * @param string $passage_date//
            * @param string $border_crossing//
            * @param string $tt_payment_category//
            * @param string $arrival_organisation//
            * @param string $offered_service_type// noćenje
            * @param string $checkin//
            * @param string $checkout//
            * @param string $verified// virfy data for sending
            * @param string $created//
            * @param string $changed//
        * @return GuestsEvisitor    */
    public function edit($id, $user_id, $guest_id, $guid, $document_type, $document_number, $gender, $birth_country, $birth_city, $birth_date, $birth_date_date, $citizenship, $visa_validity_date, $visa_type, $visa_number, $residence_country, $residence_city, $residence_adress, $passage_date, $border_crossing, $tt_payment_category, $arrival_organisation, $offered_service_type, $checkin, $checkout, $verified, $created, $changed): GuestsEvisitor
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guest_id = $guest_id;
            $this->guid = $guid;
            $this->document_type = $document_type;
            $this->document_number = $document_number;
            $this->gender = $gender;
            $this->birth_country = $birth_country;
            $this->birth_city = $birth_city;
            $this->birth_date = $birth_date;
            $this->birth_date_date = $birth_date_date;
            $this->citizenship = $citizenship;
            $this->visa_validity_date = $visa_validity_date;
            $this->visa_type = $visa_type;
            $this->visa_number = $visa_number;
            $this->residence_country = $residence_country;
            $this->residence_city = $residence_city;
            $this->residence_adress = $residence_adress;
            $this->passage_date = $passage_date;
            $this->border_crossing = $border_crossing;
            $this->tt_payment_category = $tt_payment_category;
            $this->arrival_organisation = $arrival_organisation;
            $this->offered_service_type = $offered_service_type;
            $this->checkin = $checkin;
            $this->checkout = $checkout;
            $this->verified = $verified;
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
            'guid' => Yii::t('app', 'Guid'),
            'document_type' => Yii::t('app', 'Document Type'),
            'document_number' => Yii::t('app', 'Document Number'),
            'gender' => Yii::t('app', 'Gender'),
            'birth_country' => Yii::t('app', 'Birth Country'),
            'birth_city' => Yii::t('app', 'Birth City'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'birth_date_date' => Yii::t('app', 'Birth Date Date'),
            'citizenship' => Yii::t('app', 'Citizenship'),
            'visa_validity_date' => Yii::t('app', 'Visa Validity Date'),
            'visa_type' => Yii::t('app', 'Visa Type'),
            'visa_number' => Yii::t('app', 'Visa Number'),
            'residence_country' => Yii::t('app', 'Residence Country'),
            'residence_city' => Yii::t('app', 'Residence City'),
            'residence_adress' => Yii::t('app', 'Residence Adress'),
            'passage_date' => Yii::t('app', 'Passage Date'),
            'border_crossing' => Yii::t('app', 'Border Crossing'),
            'tt_payment_category' => Yii::t('app', 'Tt Payment Category'),
            'arrival_organisation' => Yii::t('app', 'Arrival Organisation'),
            'offered_service_type' => Yii::t('app', 'Offered Service Type'),
            'checkin' => Yii::t('app', 'Checkin'),
            'checkout' => Yii::t('app', 'Checkout'),
            'verified' => Yii::t('app', 'Verified'),
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\GuestsEvisitorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\GuestsEvisitorQuery(get_called_class());
    }
}
