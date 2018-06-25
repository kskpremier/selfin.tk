<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "invoices_log".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property int $invoice_id
 * @property string $type
 * @property int $note
 * @property int $status
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader $invoice
 * @property Users $user
 * @property Workers $worker
 */
class InvoicesLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_log';
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
        * @param int $worker_id//
        * @param int $invoice_id//
        * @param string $type//
        * @param int $note//
        * @param int $status//
        * @param string $created//
        * @param string $changed//
        * @return InvoicesLog    */
    public static function create($id, $user_id, $worker_id, $invoice_id, $type, $note, $status, $created, $changed): InvoicesLog
    {
        $invoicesLog = new static();
                $invoicesLog->id = $id;
                $invoicesLog->user_id = $user_id;
                $invoicesLog->worker_id = $worker_id;
                $invoicesLog->invoice_id = $invoice_id;
                $invoicesLog->type = $type;
                $invoicesLog->note = $note;
                $invoicesLog->status = $status;
                $invoicesLog->created = $created;
                $invoicesLog->changed = $changed;
        
        return $invoicesLog;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param int $invoice_id//
            * @param string $type//
            * @param int $note//
            * @param int $status//
            * @param string $created//
            * @param string $changed//
        * @return InvoicesLog    */
    public function edit($id, $user_id, $worker_id, $invoice_id, $type, $note, $status, $created, $changed): InvoicesLog
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->invoice_id = $invoice_id;
            $this->type = $type;
            $this->note = $note;
            $this->status = $status;
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
            'worker_id' => Yii::t('app', 'Worker ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'type' => Yii::t('app', 'Type'),
            'note' => Yii::t('app', 'Note'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
     * @return \reception\entities\MyRent\queries\InvoicesLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesLogQuery(get_called_class());
    }
}
