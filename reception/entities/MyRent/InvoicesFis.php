<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "invoices_fis".
 *
 * @property int $id
 * @property int $user_id
 * @property int $invoice_id
 * @property string $type type of log
 * @property string $data
 * @property string $request
 * @property string $message custome message
 * @property string $jir
 * @property string $zki
 * @property string $status
 * @property string $err_code
 * @property int $request_time
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader $invoice
 * @property Users $user
 */
class InvoicesFis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_fis';
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
        * @param string $type// type of log
        * @param string $data//
        * @param string $request//
        * @param string $message// custome message
        * @param string $jir//
        * @param string $zki//
        * @param string $status//
        * @param string $err_code//
        * @param int $request_time//
        * @param string $created//
        * @param string $changed//
        * @return InvoicesFis    */
    public static function create($id, $user_id, $invoice_id, $type, $data, $request, $message, $jir, $zki, $status, $err_code, $request_time, $created, $changed): InvoicesFis
    {
        $invoicesFis = new static();
                $invoicesFis->id = $id;
                $invoicesFis->user_id = $user_id;
                $invoicesFis->invoice_id = $invoice_id;
                $invoicesFis->type = $type;
                $invoicesFis->data = $data;
                $invoicesFis->request = $request;
                $invoicesFis->message = $message;
                $invoicesFis->jir = $jir;
                $invoicesFis->zki = $zki;
                $invoicesFis->status = $status;
                $invoicesFis->err_code = $err_code;
                $invoicesFis->request_time = $request_time;
                $invoicesFis->created = $created;
                $invoicesFis->changed = $changed;
        
        return $invoicesFis;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $invoice_id//
            * @param string $type// type of log
            * @param string $data//
            * @param string $request//
            * @param string $message// custome message
            * @param string $jir//
            * @param string $zki//
            * @param string $status//
            * @param string $err_code//
            * @param int $request_time//
            * @param string $created//
            * @param string $changed//
        * @return InvoicesFis    */
    public function edit($id, $user_id, $invoice_id, $type, $data, $request, $message, $jir, $zki, $status, $err_code, $request_time, $created, $changed): InvoicesFis
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->invoice_id = $invoice_id;
            $this->type = $type;
            $this->data = $data;
            $this->request = $request;
            $this->message = $message;
            $this->jir = $jir;
            $this->zki = $zki;
            $this->status = $status;
            $this->err_code = $err_code;
            $this->request_time = $request_time;
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
            'type' => Yii::t('app', 'Type'),
            'data' => Yii::t('app', 'Data'),
            'request' => Yii::t('app', 'Request'),
            'message' => Yii::t('app', 'Message'),
            'jir' => Yii::t('app', 'Jir'),
            'zki' => Yii::t('app', 'Zki'),
            'status' => Yii::t('app', 'Status'),
            'err_code' => Yii::t('app', 'Err Code'),
            'request_time' => Yii::t('app', 'Request Time'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\InvoicesFisQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesFisQuery(get_called_class());
    }
}
