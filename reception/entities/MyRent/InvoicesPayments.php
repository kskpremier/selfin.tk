<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Card;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "invoices_payments".
 *
 * @property int $id
 * @property int $user_id
 * @property int $invoice_id
 * @property int $worker_id
 * @property int $card_id
 * @property string $type
 * @property double $price
 * @property string $note_short
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property CreditCards $card
 * @property InvoicesHeader $invoice
 * @property Users $user
 * @property Workers $worker
 */
class InvoicesPayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_payments';
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
        * @param int $invoice_id//
        * @param int $worker_id//
        * @param int $card_id//
        * @param string $type//
        * @param double $price//
        * @param string $note_short//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return InvoicesPayments    */
    public static function create($id, $user_id, $invoice_id, $worker_id, $card_id, $type, $price, $note_short, $note, $created, $changed): InvoicesPayments
    {
        $invoicesPayments = new static();
                $invoicesPayments->id = $id;
                $invoicesPayments->user_id = $user_id;
                $invoicesPayments->invoice_id = $invoice_id;
                $invoicesPayments->worker_id = $worker_id;
                $invoicesPayments->card_id = $card_id;
                $invoicesPayments->type = $type;
                $invoicesPayments->price = $price;
                $invoicesPayments->note_short = $note_short;
                $invoicesPayments->note = $note;
                $invoicesPayments->created = $created;
                $invoicesPayments->changed = $changed;
        
        return $invoicesPayments;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $invoice_id//
            * @param int $worker_id//
            * @param int $card_id//
            * @param string $type//
            * @param double $price//
            * @param string $note_short//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return InvoicesPayments    */
    public function edit($id, $user_id, $invoice_id, $worker_id, $card_id, $type, $price, $note_short, $note, $created, $changed): InvoicesPayments
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->invoice_id = $invoice_id;
            $this->worker_id = $worker_id;
            $this->card_id = $card_id;
            $this->type = $type;
            $this->price = $price;
            $this->note_short = $note_short;
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
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'card_id' => Yii::t('app', 'Card ID'),
            'type' => Yii::t('app', 'Type'),
            'price' => Yii::t('app', 'Price'),
            'note_short' => Yii::t('app', 'Note Short'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(CreditCards::class, ['id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(InvoicesHeader::class, ['id' => 'invoice_id']);
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
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\InvoicesPaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesPaymentsQuery(get_called_class());
    }
}
