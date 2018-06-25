<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\UsersMyrentInvoicesItems;

/**
 * This is the model class for table "users_myrent_invoices_headers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property string $licence_valid
 * @property int $licence_users
 * @property int $number
 * @property string $note
 * @property string $note_short
 * @property string $date_invoice
 * @property string $date_payment
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property Currency $currency
 * @property UsersMyrentInvoicesItems[] $usersMyrentInvoicesItems
 */
class UsersMyrentInvoicesHeaders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_myrent_invoices_headers';
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
        * @param int $currency_id//
        * @param string $licence_valid//
        * @param int $licence_users//
        * @param int $number//
        * @param string $note//
        * @param string $note_short//
        * @param string $date_invoice//
        * @param string $date_payment//
        * @param string $created//
        * @param string $changed//
        * @return UsersMyrentInvoicesHeaders    */
    public static function create($id, $user_id, $currency_id, $licence_valid, $licence_users, $number, $note, $note_short, $date_invoice, $date_payment, $created, $changed): UsersMyrentInvoicesHeaders
    {
        $usersMyrentInvoicesHeaders = new static();
                $usersMyrentInvoicesHeaders->id = $id;
                $usersMyrentInvoicesHeaders->user_id = $user_id;
                $usersMyrentInvoicesHeaders->currency_id = $currency_id;
                $usersMyrentInvoicesHeaders->licence_valid = $licence_valid;
                $usersMyrentInvoicesHeaders->licence_users = $licence_users;
                $usersMyrentInvoicesHeaders->number = $number;
                $usersMyrentInvoicesHeaders->note = $note;
                $usersMyrentInvoicesHeaders->note_short = $note_short;
                $usersMyrentInvoicesHeaders->date_invoice = $date_invoice;
                $usersMyrentInvoicesHeaders->date_payment = $date_payment;
                $usersMyrentInvoicesHeaders->created = $created;
                $usersMyrentInvoicesHeaders->changed = $changed;
        
        return $usersMyrentInvoicesHeaders;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $currency_id//
            * @param string $licence_valid//
            * @param int $licence_users//
            * @param int $number//
            * @param string $note//
            * @param string $note_short//
            * @param string $date_invoice//
            * @param string $date_payment//
            * @param string $created//
            * @param string $changed//
        * @return UsersMyrentInvoicesHeaders    */
    public function edit($id, $user_id, $currency_id, $licence_valid, $licence_users, $number, $note, $note_short, $date_invoice, $date_payment, $created, $changed): UsersMyrentInvoicesHeaders
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->currency_id = $currency_id;
            $this->licence_valid = $licence_valid;
            $this->licence_users = $licence_users;
            $this->number = $number;
            $this->note = $note;
            $this->note_short = $note_short;
            $this->date_invoice = $date_invoice;
            $this->date_payment = $date_payment;
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
            'currency_id' => Yii::t('app', 'Currency ID'),
            'licence_valid' => Yii::t('app', 'Licence Valid'),
            'licence_users' => Yii::t('app', 'Licence Users'),
            'number' => Yii::t('app', 'Number'),
            'note' => Yii::t('app', 'Note'),
            'note_short' => Yii::t('app', 'Note Short'),
            'date_invoice' => Yii::t('app', 'Date Invoice'),
            'date_payment' => Yii::t('app', 'Date Payment'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMyrentInvoicesItems()
    {
        return $this->hasMany(UsersMyrentInvoicesItems::class, ['invoice_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersMyrentInvoicesHeadersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersMyrentInvoicesHeadersQuery(get_called_class());
    }
}
