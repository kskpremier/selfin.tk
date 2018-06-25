<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "_danijela".
 *
 * @property string $Start_date
 * @property string $End_date
 * @property string $Customer
 * @property string $Source
 * @property string $Amount
 * @property string $Status
 * @property string $SKU
 * @property string $E_mail
 * @property int $TID
 * @property string $Country
 * @property string $Note
 * @property string $Booking_ID
 */
class Danijela extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_danijela';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param string $Start_date//
        * @param string $End_date//
        * @param string $Customer//
        * @param string $Source//
        * @param string $Amount//
        * @param string $Status//
        * @param string $SKU//
        * @param string $E_mail//
        * @param int $TID//
        * @param string $Country//
        * @param string $Note//
        * @param string $Booking_ID//
        * @return Danijela    */
    public static function create($Start_date, $End_date, $Customer, $Source, $Amount, $Status, $SKU, $E_mail, $TID, $Country, $Note, $Booking_ID): Danijela
    {
        $danijela = new static();
                $danijela->Start_date = $Start_date;
                $danijela->End_date = $End_date;
                $danijela->Customer = $Customer;
                $danijela->Source = $Source;
                $danijela->Amount = $Amount;
                $danijela->Status = $Status;
                $danijela->SKU = $SKU;
                $danijela->E_mail = $E_mail;
                $danijela->TID = $TID;
                $danijela->Country = $Country;
                $danijela->Note = $Note;
                $danijela->Booking_ID = $Booking_ID;
        
        return $danijela;
    }

    /**
            * @param string $Start_date//
            * @param string $End_date//
            * @param string $Customer//
            * @param string $Source//
            * @param string $Amount//
            * @param string $Status//
            * @param string $SKU//
            * @param string $E_mail//
            * @param int $TID//
            * @param string $Country//
            * @param string $Note//
            * @param string $Booking_ID//
        * @return Danijela    */
    public function edit($Start_date, $End_date, $Customer, $Source, $Amount, $Status, $SKU, $E_mail, $TID, $Country, $Note, $Booking_ID): Danijela
    {

            $this->Start_date = $Start_date;
            $this->End_date = $End_date;
            $this->Customer = $Customer;
            $this->Source = $Source;
            $this->Amount = $Amount;
            $this->Status = $Status;
            $this->SKU = $SKU;
            $this->E_mail = $E_mail;
            $this->TID = $TID;
            $this->Country = $Country;
            $this->Note = $Note;
            $this->Booking_ID = $Booking_ID;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Start_date' => Yii::t('app', 'Start Date'),
            'End_date' => Yii::t('app', 'End Date'),
            'Customer' => Yii::t('app', 'Customer'),
            'Source' => Yii::t('app', 'Source'),
            'Amount' => Yii::t('app', 'Amount'),
            'Status' => Yii::t('app', 'Status'),
            'SKU' => Yii::t('app', 'Sku'),
            'E_mail' => Yii::t('app', 'E Mail'),
            'TID' => Yii::t('app', 'Tid'),
            'Country' => Yii::t('app', 'Country'),
            'Note' => Yii::t('app', 'Note'),
            'Booking_ID' => Yii::t('app', 'Booking  ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\DanijelaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\DanijelaQuery(get_called_class());
    }
}
