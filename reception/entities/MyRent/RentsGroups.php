<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Customer;
use reception\entities\MyRent\User;
use reception\entities\MyRent\RentsGroupsRents;

/**
 * This is the model class for table "rents_groups".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property string $type type of invoices
 * @property string $code
 * @property string $name
 * @property string $note_short
 * @property string $request_for_payment request for paymets
 * @property string $date
 * @property string $date_payment
 * @property string $note
 * @property string $message message on report
 * @property string $payed
 * @property string $send
 * @property string $created
 * @property string $changed
 *
 * @property Customers $customer
 * @property Users $user
 * @property RentsGroupsRents[] $rentsGroupsRents
 */
class RentsGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_groups';
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
        * @param int $customer_id//
        * @param string $type// type of invoices
        * @param string $code//
        * @param string $name//
        * @param string $note_short//
        * @param string $request_for_payment// request for paymets
        * @param string $date//
        * @param string $date_payment//
        * @param string $note//
        * @param string $message// message on report
        * @param string $payed//
        * @param string $send//
        * @param string $created//
        * @param string $changed//
        * @return RentsGroups    */
    public static function create($id, $user_id, $customer_id, $type, $code, $name, $note_short, $request_for_payment, $date, $date_payment, $note, $message, $payed, $send, $created, $changed): RentsGroups
    {
        $rentsGroups = new static();
                $rentsGroups->id = $id;
                $rentsGroups->user_id = $user_id;
                $rentsGroups->customer_id = $customer_id;
                $rentsGroups->type = $type;
                $rentsGroups->code = $code;
                $rentsGroups->name = $name;
                $rentsGroups->note_short = $note_short;
                $rentsGroups->request_for_payment = $request_for_payment;
                $rentsGroups->date = $date;
                $rentsGroups->date_payment = $date_payment;
                $rentsGroups->note = $note;
                $rentsGroups->message = $message;
                $rentsGroups->payed = $payed;
                $rentsGroups->send = $send;
                $rentsGroups->created = $created;
                $rentsGroups->changed = $changed;
        
        return $rentsGroups;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $customer_id//
            * @param string $type// type of invoices
            * @param string $code//
            * @param string $name//
            * @param string $note_short//
            * @param string $request_for_payment// request for paymets
            * @param string $date//
            * @param string $date_payment//
            * @param string $note//
            * @param string $message// message on report
            * @param string $payed//
            * @param string $send//
            * @param string $created//
            * @param string $changed//
        * @return RentsGroups    */
    public function edit($id, $user_id, $customer_id, $type, $code, $name, $note_short, $request_for_payment, $date, $date_payment, $note, $message, $payed, $send, $created, $changed): RentsGroups
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->customer_id = $customer_id;
            $this->type = $type;
            $this->code = $code;
            $this->name = $name;
            $this->note_short = $note_short;
            $this->request_for_payment = $request_for_payment;
            $this->date = $date;
            $this->date_payment = $date_payment;
            $this->note = $note;
            $this->message = $message;
            $this->payed = $payed;
            $this->send = $send;
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'type' => Yii::t('app', 'Type'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'note_short' => Yii::t('app', 'Note Short'),
            'request_for_payment' => Yii::t('app', 'Request For Payment'),
            'date' => Yii::t('app', 'Date'),
            'date_payment' => Yii::t('app', 'Date Payment'),
            'note' => Yii::t('app', 'Note'),
            'message' => Yii::t('app', 'Message'),
            'payed' => Yii::t('app', 'Payed'),
            'send' => Yii::t('app', 'Send'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::class, ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsGroupsRents()
    {
        return $this->hasMany(RentsGroupsRents::class, ['rent_group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsGroupsQuery(get_called_class());
    }
}
