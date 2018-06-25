<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "rents_del".
 *
 * @property int $id
 * @property int $object_id
 * @property int $rent_status_id
 * @property int $user_id
 * @property string $guid
 * @property int $number
 * @property string $from_date
 * @property string $from_time
 * @property string $until_date
 * @property string $until_time
 * @property string $note
 * @property string $note_short
 * @property string $note_user
 * @property double $price
 * @property string $paid
 * @property int $payment_method_id
 * @property int $currency_id
 * @property double $exchange exchange number for price
 * @property double $in_advance
 * @property string $in_advance_paid
 * @property int $in_advance_currency_id
 * @property string $contact_name
 * @property string $money_recived
 * @property string $contact_email
 * @property string $contact_tel
 * @property int $contact_country_id
 * @property string $contact_confirm contact confirm data and rent
 * @property int $raiting
 * @property string $rating_note
 * @property int $rent_import_id
 * @property int $rent_source_id rent source ID 
 * @property string $foreign_id
 * @property string $import_message
 * @property string $active active rent or not
 * @property string $created
 * @property string $changed
 */
class RentsDel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_del';
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
        * @param int $object_id//
        * @param int $rent_status_id//
        * @param int $user_id//
        * @param string $guid//
        * @param int $number//
        * @param string $from_date//
        * @param string $from_time//
        * @param string $until_date//
        * @param string $until_time//
        * @param string $note//
        * @param string $note_short//
        * @param string $note_user//
        * @param double $price//
        * @param string $paid//
        * @param int $payment_method_id//
        * @param int $currency_id//
        * @param double $exchange// exchange number for price
        * @param double $in_advance//
        * @param string $in_advance_paid//
        * @param int $in_advance_currency_id//
        * @param string $contact_name//
        * @param string $money_recived//
        * @param string $contact_email//
        * @param string $contact_tel//
        * @param int $contact_country_id//
        * @param string $contact_confirm// contact confirm data and rent
        * @param int $raiting//
        * @param string $rating_note//
        * @param int $rent_import_id//
        * @param int $rent_source_id// rent source ID 
        * @param string $foreign_id//
        * @param string $import_message//
        * @param string $active// active rent or not
        * @param string $created//
        * @param string $changed//
        * @return RentsDel    */
    public static function create($id, $object_id, $rent_status_id, $user_id, $guid, $number, $from_date, $from_time, $until_date, $until_time, $note, $note_short, $note_user, $price, $paid, $payment_method_id, $currency_id, $exchange, $in_advance, $in_advance_paid, $in_advance_currency_id, $contact_name, $money_recived, $contact_email, $contact_tel, $contact_country_id, $contact_confirm, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $import_message, $active, $created, $changed): RentsDel
    {
        $rentsDel = new static();
                $rentsDel->id = $id;
                $rentsDel->object_id = $object_id;
                $rentsDel->rent_status_id = $rent_status_id;
                $rentsDel->user_id = $user_id;
                $rentsDel->guid = $guid;
                $rentsDel->number = $number;
                $rentsDel->from_date = $from_date;
                $rentsDel->from_time = $from_time;
                $rentsDel->until_date = $until_date;
                $rentsDel->until_time = $until_time;
                $rentsDel->note = $note;
                $rentsDel->note_short = $note_short;
                $rentsDel->note_user = $note_user;
                $rentsDel->price = $price;
                $rentsDel->paid = $paid;
                $rentsDel->payment_method_id = $payment_method_id;
                $rentsDel->currency_id = $currency_id;
                $rentsDel->exchange = $exchange;
                $rentsDel->in_advance = $in_advance;
                $rentsDel->in_advance_paid = $in_advance_paid;
                $rentsDel->in_advance_currency_id = $in_advance_currency_id;
                $rentsDel->contact_name = $contact_name;
                $rentsDel->money_recived = $money_recived;
                $rentsDel->contact_email = $contact_email;
                $rentsDel->contact_tel = $contact_tel;
                $rentsDel->contact_country_id = $contact_country_id;
                $rentsDel->contact_confirm = $contact_confirm;
                $rentsDel->raiting = $raiting;
                $rentsDel->rating_note = $rating_note;
                $rentsDel->rent_import_id = $rent_import_id;
                $rentsDel->rent_source_id = $rent_source_id;
                $rentsDel->foreign_id = $foreign_id;
                $rentsDel->import_message = $import_message;
                $rentsDel->active = $active;
                $rentsDel->created = $created;
                $rentsDel->changed = $changed;
        
        return $rentsDel;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $rent_status_id//
            * @param int $user_id//
            * @param string $guid//
            * @param int $number//
            * @param string $from_date//
            * @param string $from_time//
            * @param string $until_date//
            * @param string $until_time//
            * @param string $note//
            * @param string $note_short//
            * @param string $note_user//
            * @param double $price//
            * @param string $paid//
            * @param int $payment_method_id//
            * @param int $currency_id//
            * @param double $exchange// exchange number for price
            * @param double $in_advance//
            * @param string $in_advance_paid//
            * @param int $in_advance_currency_id//
            * @param string $contact_name//
            * @param string $money_recived//
            * @param string $contact_email//
            * @param string $contact_tel//
            * @param int $contact_country_id//
            * @param string $contact_confirm// contact confirm data and rent
            * @param int $raiting//
            * @param string $rating_note//
            * @param int $rent_import_id//
            * @param int $rent_source_id// rent source ID 
            * @param string $foreign_id//
            * @param string $import_message//
            * @param string $active// active rent or not
            * @param string $created//
            * @param string $changed//
        * @return RentsDel    */
    public function edit($id, $object_id, $rent_status_id, $user_id, $guid, $number, $from_date, $from_time, $until_date, $until_time, $note, $note_short, $note_user, $price, $paid, $payment_method_id, $currency_id, $exchange, $in_advance, $in_advance_paid, $in_advance_currency_id, $contact_name, $money_recived, $contact_email, $contact_tel, $contact_country_id, $contact_confirm, $raiting, $rating_note, $rent_import_id, $rent_source_id, $foreign_id, $import_message, $active, $created, $changed): RentsDel
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->rent_status_id = $rent_status_id;
            $this->user_id = $user_id;
            $this->guid = $guid;
            $this->number = $number;
            $this->from_date = $from_date;
            $this->from_time = $from_time;
            $this->until_date = $until_date;
            $this->until_time = $until_time;
            $this->note = $note;
            $this->note_short = $note_short;
            $this->note_user = $note_user;
            $this->price = $price;
            $this->paid = $paid;
            $this->payment_method_id = $payment_method_id;
            $this->currency_id = $currency_id;
            $this->exchange = $exchange;
            $this->in_advance = $in_advance;
            $this->in_advance_paid = $in_advance_paid;
            $this->in_advance_currency_id = $in_advance_currency_id;
            $this->contact_name = $contact_name;
            $this->money_recived = $money_recived;
            $this->contact_email = $contact_email;
            $this->contact_tel = $contact_tel;
            $this->contact_country_id = $contact_country_id;
            $this->contact_confirm = $contact_confirm;
            $this->raiting = $raiting;
            $this->rating_note = $rating_note;
            $this->rent_import_id = $rent_import_id;
            $this->rent_source_id = $rent_source_id;
            $this->foreign_id = $foreign_id;
            $this->import_message = $import_message;
            $this->active = $active;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'rent_status_id' => Yii::t('app', 'Rent Status ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'guid' => Yii::t('app', 'Guid'),
            'number' => Yii::t('app', 'Number'),
            'from_date' => Yii::t('app', 'From Date'),
            'from_time' => Yii::t('app', 'From Time'),
            'until_date' => Yii::t('app', 'Until Date'),
            'until_time' => Yii::t('app', 'Until Time'),
            'note' => Yii::t('app', 'Note'),
            'note_short' => Yii::t('app', 'Note Short'),
            'note_user' => Yii::t('app', 'Note User'),
            'price' => Yii::t('app', 'Price'),
            'paid' => Yii::t('app', 'Paid'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'exchange' => Yii::t('app', 'Exchange'),
            'in_advance' => Yii::t('app', 'In Advance'),
            'in_advance_paid' => Yii::t('app', 'In Advance Paid'),
            'in_advance_currency_id' => Yii::t('app', 'In Advance Currency ID'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'money_recived' => Yii::t('app', 'Money Recived'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_tel' => Yii::t('app', 'Contact Tel'),
            'contact_country_id' => Yii::t('app', 'Contact Country ID'),
            'contact_confirm' => Yii::t('app', 'Contact Confirm'),
            'raiting' => Yii::t('app', 'Raiting'),
            'rating_note' => Yii::t('app', 'Rating Note'),
            'rent_import_id' => Yii::t('app', 'Rent Import ID'),
            'rent_source_id' => Yii::t('app', 'Rent Source ID'),
            'foreign_id' => Yii::t('app', 'Foreign ID'),
            'import_message' => Yii::t('app', 'Import Message'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsDelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsDelQuery(get_called_class());
    }
}
