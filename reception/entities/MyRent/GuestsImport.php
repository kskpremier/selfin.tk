<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "guests_import".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $user_id
 * @property int $rent_id
 * @property string $date_from
 * @property string $date_until
 * @property string $erp_id external id
 * @property string $name_first
 * @property string $name_last
 * @property string $email
 * @property string $tel telephone
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
 * @property string $request save request from import API
 * @property string $evizitor_checkin
 * @property string $evizitor_checkout
 * @property string $verified virfy data for sending
 * @property string $imported is it imported
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Rents $rent
 * @property Users $user
 */
class GuestsImport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guests_import';
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
        * @param int $b2b_id//
        * @param int $user_id//
        * @param int $rent_id//
        * @param string $date_from//
        * @param string $date_until//
        * @param string $erp_id// external id
        * @param string $name_first//
        * @param string $name_last//
        * @param string $email//
        * @param string $tel// telephone
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
        * @param string $request// save request from import API
        * @param string $evizitor_checkin//
        * @param string $evizitor_checkout//
        * @param string $verified// virfy data for sending
        * @param string $imported// is it imported
        * @param string $created//
        * @param string $changed//
        * @return GuestsImport    */
    public static function create($id, $b2b_id, $user_id, $rent_id, $date_from, $date_until, $erp_id, $name_first, $name_last, $email, $tel, $guid, $document_type, $document_number, $gender, $birth_country, $birth_city, $birth_date, $birth_date_date, $citizenship, $visa_validity_date, $visa_type, $visa_number, $residence_country, $residence_city, $residence_adress, $passage_date, $border_crossing, $tt_payment_category, $arrival_organisation, $offered_service_type, $request, $evizitor_checkin, $evizitor_checkout, $verified, $imported, $created, $changed): GuestsImport
    {
        $guestsImport = new static();
                $guestsImport->id = $id;
                $guestsImport->b2b_id = $b2b_id;
                $guestsImport->user_id = $user_id;
                $guestsImport->rent_id = $rent_id;
                $guestsImport->date_from = $date_from;
                $guestsImport->date_until = $date_until;
                $guestsImport->erp_id = $erp_id;
                $guestsImport->name_first = $name_first;
                $guestsImport->name_last = $name_last;
                $guestsImport->email = $email;
                $guestsImport->tel = $tel;
                $guestsImport->guid = $guid;
                $guestsImport->document_type = $document_type;
                $guestsImport->document_number = $document_number;
                $guestsImport->gender = $gender;
                $guestsImport->birth_country = $birth_country;
                $guestsImport->birth_city = $birth_city;
                $guestsImport->birth_date = $birth_date;
                $guestsImport->birth_date_date = $birth_date_date;
                $guestsImport->citizenship = $citizenship;
                $guestsImport->visa_validity_date = $visa_validity_date;
                $guestsImport->visa_type = $visa_type;
                $guestsImport->visa_number = $visa_number;
                $guestsImport->residence_country = $residence_country;
                $guestsImport->residence_city = $residence_city;
                $guestsImport->residence_adress = $residence_adress;
                $guestsImport->passage_date = $passage_date;
                $guestsImport->border_crossing = $border_crossing;
                $guestsImport->tt_payment_category = $tt_payment_category;
                $guestsImport->arrival_organisation = $arrival_organisation;
                $guestsImport->offered_service_type = $offered_service_type;
                $guestsImport->request = $request;
                $guestsImport->evizitor_checkin = $evizitor_checkin;
                $guestsImport->evizitor_checkout = $evizitor_checkout;
                $guestsImport->verified = $verified;
                $guestsImport->imported = $imported;
                $guestsImport->created = $created;
                $guestsImport->changed = $changed;
        
        return $guestsImport;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param string $date_from//
            * @param string $date_until//
            * @param string $erp_id// external id
            * @param string $name_first//
            * @param string $name_last//
            * @param string $email//
            * @param string $tel// telephone
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
            * @param string $request// save request from import API
            * @param string $evizitor_checkin//
            * @param string $evizitor_checkout//
            * @param string $verified// virfy data for sending
            * @param string $imported// is it imported
            * @param string $created//
            * @param string $changed//
        * @return GuestsImport    */
    public function edit($id, $b2b_id, $user_id, $rent_id, $date_from, $date_until, $erp_id, $name_first, $name_last, $email, $tel, $guid, $document_type, $document_number, $gender, $birth_country, $birth_city, $birth_date, $birth_date_date, $citizenship, $visa_validity_date, $visa_type, $visa_number, $residence_country, $residence_city, $residence_adress, $passage_date, $border_crossing, $tt_payment_category, $arrival_organisation, $offered_service_type, $request, $evizitor_checkin, $evizitor_checkout, $verified, $imported, $created, $changed): GuestsImport
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->date_from = $date_from;
            $this->date_until = $date_until;
            $this->erp_id = $erp_id;
            $this->name_first = $name_first;
            $this->name_last = $name_last;
            $this->email = $email;
            $this->tel = $tel;
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
            $this->request = $request;
            $this->evizitor_checkin = $evizitor_checkin;
            $this->evizitor_checkout = $evizitor_checkout;
            $this->verified = $verified;
            $this->imported = $imported;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_until' => Yii::t('app', 'Date Until'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'name_first' => Yii::t('app', 'Name First'),
            'name_last' => Yii::t('app', 'Name Last'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
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
            'request' => Yii::t('app', 'Request'),
            'evizitor_checkin' => Yii::t('app', 'Evizitor Checkin'),
            'evizitor_checkout' => Yii::t('app', 'Evizitor Checkout'),
            'verified' => Yii::t('app', 'Verified'),
            'imported' => Yii::t('app', 'Imported'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
     * @return \reception\entities\MyRent\queries\GuestsImportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\GuestsImportQuery(get_called_class());
    }
}
