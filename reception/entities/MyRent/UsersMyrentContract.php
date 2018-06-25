<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_myrent_contract".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $date_expire unitl is valid
 * @property string $date_next_payment date of next payment
 * @property double $price_next_payment price of next payment
 * @property int $objects_max how many properties
 * @property int $object_cm how many channel manager connection
 * @property string $billing
 * @property string $note
 * @property string $contract_number number of contract
 * @property double $object_price
 * @property double $price_full
 * @property int $currency_id
 * @property double $invoices
 * @property double $invoices_fis
 * @property double $messages
 * @property double $messages_sms
 * @property double $channel_manager
 * @property string $active
 * @property string $active_type
 * @property string $created
 * @property string $changed
 * @property string $guests_portal
 * @property string $guests_eVizitor
 *
 * @property Users $user
 */
class UsersMyrentContract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_myrent_contract';
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
        * @param string $date//
        * @param string $date_expire// unitl is valid
        * @param string $date_next_payment// date of next payment
        * @param double $price_next_payment// price of next payment
        * @param int $objects_max// how many properties
        * @param int $object_cm// how many channel manager connection
        * @param string $billing//
        * @param string $note//
        * @param string $contract_number// number of contract
        * @param double $object_price//
        * @param double $price_full//
        * @param int $currency_id//
        * @param double $invoices//
        * @param double $invoices_fis//
        * @param double $messages//
        * @param double $messages_sms//
        * @param double $channel_manager//
        * @param string $active//
        * @param string $active_type//
        * @param string $created//
        * @param string $changed//
        * @param string $guests_portal//
        * @param string $guests_eVizitor//
        * @return UsersMyrentContract    */
    public static function create($id, $user_id, $date, $date_expire, $date_next_payment, $price_next_payment, $objects_max, $object_cm, $billing, $note, $contract_number, $object_price, $price_full, $currency_id, $invoices, $invoices_fis, $messages, $messages_sms, $channel_manager, $active, $active_type, $created, $changed, $guests_portal, $guests_eVizitor): UsersMyrentContract
    {
        $usersMyrentContract = new static();
                $usersMyrentContract->id = $id;
                $usersMyrentContract->user_id = $user_id;
                $usersMyrentContract->date = $date;
                $usersMyrentContract->date_expire = $date_expire;
                $usersMyrentContract->date_next_payment = $date_next_payment;
                $usersMyrentContract->price_next_payment = $price_next_payment;
                $usersMyrentContract->objects_max = $objects_max;
                $usersMyrentContract->object_cm = $object_cm;
                $usersMyrentContract->billing = $billing;
                $usersMyrentContract->note = $note;
                $usersMyrentContract->contract_number = $contract_number;
                $usersMyrentContract->object_price = $object_price;
                $usersMyrentContract->price_full = $price_full;
                $usersMyrentContract->currency_id = $currency_id;
                $usersMyrentContract->invoices = $invoices;
                $usersMyrentContract->invoices_fis = $invoices_fis;
                $usersMyrentContract->messages = $messages;
                $usersMyrentContract->messages_sms = $messages_sms;
                $usersMyrentContract->channel_manager = $channel_manager;
                $usersMyrentContract->active = $active;
                $usersMyrentContract->active_type = $active_type;
                $usersMyrentContract->created = $created;
                $usersMyrentContract->changed = $changed;
                $usersMyrentContract->guests_portal = $guests_portal;
                $usersMyrentContract->guests_eVizitor = $guests_eVizitor;
        
        return $usersMyrentContract;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $date//
            * @param string $date_expire// unitl is valid
            * @param string $date_next_payment// date of next payment
            * @param double $price_next_payment// price of next payment
            * @param int $objects_max// how many properties
            * @param int $object_cm// how many channel manager connection
            * @param string $billing//
            * @param string $note//
            * @param string $contract_number// number of contract
            * @param double $object_price//
            * @param double $price_full//
            * @param int $currency_id//
            * @param double $invoices//
            * @param double $invoices_fis//
            * @param double $messages//
            * @param double $messages_sms//
            * @param double $channel_manager//
            * @param string $active//
            * @param string $active_type//
            * @param string $created//
            * @param string $changed//
            * @param string $guests_portal//
            * @param string $guests_eVizitor//
        * @return UsersMyrentContract    */
    public function edit($id, $user_id, $date, $date_expire, $date_next_payment, $price_next_payment, $objects_max, $object_cm, $billing, $note, $contract_number, $object_price, $price_full, $currency_id, $invoices, $invoices_fis, $messages, $messages_sms, $channel_manager, $active, $active_type, $created, $changed, $guests_portal, $guests_eVizitor): UsersMyrentContract
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->date = $date;
            $this->date_expire = $date_expire;
            $this->date_next_payment = $date_next_payment;
            $this->price_next_payment = $price_next_payment;
            $this->objects_max = $objects_max;
            $this->object_cm = $object_cm;
            $this->billing = $billing;
            $this->note = $note;
            $this->contract_number = $contract_number;
            $this->object_price = $object_price;
            $this->price_full = $price_full;
            $this->currency_id = $currency_id;
            $this->invoices = $invoices;
            $this->invoices_fis = $invoices_fis;
            $this->messages = $messages;
            $this->messages_sms = $messages_sms;
            $this->channel_manager = $channel_manager;
            $this->active = $active;
            $this->active_type = $active_type;
            $this->created = $created;
            $this->changed = $changed;
            $this->guests_portal = $guests_portal;
            $this->guests_eVizitor = $guests_eVizitor;
    
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
            'date' => Yii::t('app', 'Date'),
            'date_expire' => Yii::t('app', 'Date Expire'),
            'date_next_payment' => Yii::t('app', 'Date Next Payment'),
            'price_next_payment' => Yii::t('app', 'Price Next Payment'),
            'objects_max' => Yii::t('app', 'Objects Max'),
            'object_cm' => Yii::t('app', 'Object Cm'),
            'billing' => Yii::t('app', 'Billing'),
            'note' => Yii::t('app', 'Note'),
            'contract_number' => Yii::t('app', 'Contract Number'),
            'object_price' => Yii::t('app', 'Object Price'),
            'price_full' => Yii::t('app', 'Price Full'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'invoices' => Yii::t('app', 'Invoices'),
            'invoices_fis' => Yii::t('app', 'Invoices Fis'),
            'messages' => Yii::t('app', 'Messages'),
            'messages_sms' => Yii::t('app', 'Messages Sms'),
            'channel_manager' => Yii::t('app', 'Channel Manager'),
            'active' => Yii::t('app', 'Active'),
            'active_type' => Yii::t('app', 'Active Type'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
            'guests_portal' => Yii::t('app', 'Guests Portal'),
            'guests_eVizitor' => Yii::t('app', 'Guests E Vizitor'),
        ];
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
     * @return \reception\entities\MyRent\queries\UsersMyrentContractQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersMyrentContractQuery(get_called_class());
    }
}
