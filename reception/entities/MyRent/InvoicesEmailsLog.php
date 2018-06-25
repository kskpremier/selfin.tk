<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\LogEmail;

/**
 * This is the model class for table "invoices_emails_log".
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $log_email_id
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader $invoice
 * @property LogEmail $logEmail
 */
class InvoicesEmailsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_emails_log';
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
        * @param int $invoice_id//
        * @param int $log_email_id//
        * @param string $created//
        * @param string $changed//
        * @return InvoicesEmailsLog    */
    public static function create($id, $invoice_id, $log_email_id, $created, $changed): InvoicesEmailsLog
    {
        $invoicesEmailsLog = new static();
                $invoicesEmailsLog->id = $id;
                $invoicesEmailsLog->invoice_id = $invoice_id;
                $invoicesEmailsLog->log_email_id = $log_email_id;
                $invoicesEmailsLog->created = $created;
                $invoicesEmailsLog->changed = $changed;
        
        return $invoicesEmailsLog;
    }

    /**
            * @param int $id//
            * @param int $invoice_id//
            * @param int $log_email_id//
            * @param string $created//
            * @param string $changed//
        * @return InvoicesEmailsLog    */
    public function edit($id, $invoice_id, $log_email_id, $created, $changed): InvoicesEmailsLog
    {

            $this->id = $id;
            $this->invoice_id = $invoice_id;
            $this->log_email_id = $log_email_id;
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
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'log_email_id' => Yii::t('app', 'Log Email ID'),
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
    public function getLogEmail()
    {
        return $this->hasOne(LogEmail::class, ['id' => 'log_email_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\InvoicesEmailsLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesEmailsLogQuery(get_called_class());
    }
}
