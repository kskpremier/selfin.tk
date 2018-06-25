<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Unit;

/**
 * This is the model class for table "units_iban".
 *
 * @property int $id
 * @property int $unit_id
 * @property string $iban
 * @property string $recipient
 * @property string $swift
 * @property string $name
 * @property string $adress
 * @property string $city
 * @property string $country
 * @property string $purpose_code
 * @property string $request_for_payment_model
 * @property string $created
 * @property string $changed
 *
 * @property Units $unit
 */
class UnitsIban extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_iban';
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
        * @param int $unit_id//
        * @param string $iban//
        * @param string $recipient//
        * @param string $swift//
        * @param string $name//
        * @param string $adress//
        * @param string $city//
        * @param string $country//
        * @param string $purpose_code//
        * @param string $request_for_payment_model//
        * @param string $created//
        * @param string $changed//
        * @return UnitsIban    */
    public static function create($id, $unit_id, $iban, $recipient, $swift, $name, $adress, $city, $country, $purpose_code, $request_for_payment_model, $created, $changed): UnitsIban
    {
        $unitsIban = new static();
                $unitsIban->id = $id;
                $unitsIban->unit_id = $unit_id;
                $unitsIban->iban = $iban;
                $unitsIban->recipient = $recipient;
                $unitsIban->swift = $swift;
                $unitsIban->name = $name;
                $unitsIban->adress = $adress;
                $unitsIban->city = $city;
                $unitsIban->country = $country;
                $unitsIban->purpose_code = $purpose_code;
                $unitsIban->request_for_payment_model = $request_for_payment_model;
                $unitsIban->created = $created;
                $unitsIban->changed = $changed;
        
        return $unitsIban;
    }

    /**
            * @param int $id//
            * @param int $unit_id//
            * @param string $iban//
            * @param string $recipient//
            * @param string $swift//
            * @param string $name//
            * @param string $adress//
            * @param string $city//
            * @param string $country//
            * @param string $purpose_code//
            * @param string $request_for_payment_model//
            * @param string $created//
            * @param string $changed//
        * @return UnitsIban    */
    public function edit($id, $unit_id, $iban, $recipient, $swift, $name, $adress, $city, $country, $purpose_code, $request_for_payment_model, $created, $changed): UnitsIban
    {

            $this->id = $id;
            $this->unit_id = $unit_id;
            $this->iban = $iban;
            $this->recipient = $recipient;
            $this->swift = $swift;
            $this->name = $name;
            $this->adress = $adress;
            $this->city = $city;
            $this->country = $country;
            $this->purpose_code = $purpose_code;
            $this->request_for_payment_model = $request_for_payment_model;
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'iban' => Yii::t('app', 'Iban'),
            'recipient' => Yii::t('app', 'Recipient'),
            'swift' => Yii::t('app', 'Swift'),
            'name' => Yii::t('app', 'Name'),
            'adress' => Yii::t('app', 'Adress'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'purpose_code' => Yii::t('app', 'Purpose Code'),
            'request_for_payment_model' => Yii::t('app', 'Request For Payment Model'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitsIbanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsIbanQuery(get_called_class());
    }
}
