<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Owner;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "owners_contracts".
 *
 * @property int $id
 * @property int $user_id
 * @property int $owner_id
 * @property string $date_from
 * @property string $calculation F - fix price, E - add extra
 * @property string $date_until
 * @property string $contract_type_id
 * @property double $fee_guests
 * @property double $fee_alotman_guests
 * @property double $fee_owner_guests
 * @property string $fee_type_id
 * @property string $tourist_tax
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Owners $owner
 * @property Users $user
 */
class OwnersContracts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owners_contracts';
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
        * @param int $owner_id//
        * @param string $date_from//
        * @param string $calculation// F - fix price, E - add extra
        * @param string $date_until//
        * @param string $contract_type_id//
        * @param double $fee_guests//
        * @param double $fee_alotman_guests//
        * @param double $fee_owner_guests//
        * @param string $fee_type_id//
        * @param string $tourist_tax//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return OwnersContracts    */
    public static function create($id, $user_id, $owner_id, $date_from, $calculation, $date_until, $contract_type_id, $fee_guests, $fee_alotman_guests, $fee_owner_guests, $fee_type_id, $tourist_tax, $note, $created, $changed): OwnersContracts
    {
        $ownersContracts = new static();
                $ownersContracts->id = $id;
                $ownersContracts->user_id = $user_id;
                $ownersContracts->owner_id = $owner_id;
                $ownersContracts->date_from = $date_from;
                $ownersContracts->calculation = $calculation;
                $ownersContracts->date_until = $date_until;
                $ownersContracts->contract_type_id = $contract_type_id;
                $ownersContracts->fee_guests = $fee_guests;
                $ownersContracts->fee_alotman_guests = $fee_alotman_guests;
                $ownersContracts->fee_owner_guests = $fee_owner_guests;
                $ownersContracts->fee_type_id = $fee_type_id;
                $ownersContracts->tourist_tax = $tourist_tax;
                $ownersContracts->note = $note;
                $ownersContracts->created = $created;
                $ownersContracts->changed = $changed;
        
        return $ownersContracts;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $owner_id//
            * @param string $date_from//
            * @param string $calculation// F - fix price, E - add extra
            * @param string $date_until//
            * @param string $contract_type_id//
            * @param double $fee_guests//
            * @param double $fee_alotman_guests//
            * @param double $fee_owner_guests//
            * @param string $fee_type_id//
            * @param string $tourist_tax//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return OwnersContracts    */
    public function edit($id, $user_id, $owner_id, $date_from, $calculation, $date_until, $contract_type_id, $fee_guests, $fee_alotman_guests, $fee_owner_guests, $fee_type_id, $tourist_tax, $note, $created, $changed): OwnersContracts
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->owner_id = $owner_id;
            $this->date_from = $date_from;
            $this->calculation = $calculation;
            $this->date_until = $date_until;
            $this->contract_type_id = $contract_type_id;
            $this->fee_guests = $fee_guests;
            $this->fee_alotman_guests = $fee_alotman_guests;
            $this->fee_owner_guests = $fee_owner_guests;
            $this->fee_type_id = $fee_type_id;
            $this->tourist_tax = $tourist_tax;
            $this->note = $note;
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
            'owner_id' => Yii::t('app', 'Owner ID'),
            'date_from' => Yii::t('app', 'Date From'),
            'calculation' => Yii::t('app', 'Calculation'),
            'date_until' => Yii::t('app', 'Date Until'),
            'contract_type_id' => Yii::t('app', 'Contract Type ID'),
            'fee_guests' => Yii::t('app', 'Fee Guests'),
            'fee_alotman_guests' => Yii::t('app', 'Fee Alotman Guests'),
            'fee_owner_guests' => Yii::t('app', 'Fee Owner Guests'),
            'fee_type_id' => Yii::t('app', 'Fee Type ID'),
            'tourist_tax' => Yii::t('app', 'Tourist Tax'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owners::class, ['id' => 'owner_id']);
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
     * @return \reception\entities\MyRent\queries\OwnersContractsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\OwnersContractsQuery(get_called_class());
    }
}
