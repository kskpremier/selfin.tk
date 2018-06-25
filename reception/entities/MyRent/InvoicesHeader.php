<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesEmailsLogs;
use reception\entities\MyRent\InvoicesFis;
use reception\entities\MyRent\CustomerCountry;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\CurrencyIdInfo;
use reception\entities\MyRent\Customer;
use reception\entities\MyRent\StornoInvoice;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\InvoiceType;
use reception\entities\MyRent\Owner;
use reception\entities\MyRent\PaymentMethod;
use reception\entities\MyRent\Payment;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\ReportIdDefault;
use reception\entities\MyRent\TransactionAccount;
use reception\entities\MyRent\User;
use reception\entities\MyRent\FisWorker;
use reception\entities\MyRent\Worker;
use reception\entities\MyRent\InvoicesItems;
use reception\entities\MyRent\InvoicesItems0;
use reception\entities\MyRent\InvoicesLogs;
use reception\entities\MyRent\InvoicesPayments;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\Treasuries;

/**
 * This is the model class for table "invoices_header".
 *
 * @property int $id
 * @property int $rent_id
 * @property int $user_id
 * @property int $payment_method_id
 * @property int $payment_id link to recive payments
 * @property int $owner_id link to owners
 * @property int $invoice_type_id
 * @property int $worker_id worker who created invoice
 * @property int $report_id_default default report id
 * @property int $invoice_id link to storno invoice
 * @property string $type
 * @property int $number number of invoice
 * @property string $number_office adition number for inv
 * @property string $number_pos adition number for inv
 * @property int $transaction_account_id
 * @property string $inv_date
 * @property string $inv_time
 * @property string $inv_lock Y means that the invoice has been completed
 * @property string $external_id
 * @property string $storno is it storno or not
 * @property int $storno_invoice_id
 * @property double $price full price of invoice (populate from invoices_items)
 * @property double $price_neto price for paying to owners
 * @property double $advance advance amount recive
 * @property double $vat sum of vat on invoice (populate from invoice_items)
 * @property double $exchange_info amount of exchange for information obout price 
 * @property int $currency_id_info info currency
 * @property int $currency_id
 * @property string $zki CRO fiscalization
 * @property string $jir CRO fiscalization 
 * @property string $status_fis CRO fiscalization - status Y > ok
 * @property string $datetime_fis
 * @property int $fis_worker_id
 * @property string $worker_tax_id tax id number of worker who create the invoice
 * @property string $customer_name
 * @property int $customer_id
 * @property string $company_number
 * @property string $customer_adress
 * @property string $customer_city_name
 * @property string $customer_city_zip
 * @property string $customer_email
 * @property string $customer_tel
 * @property int $customer_country_id
 * @property string $note
 * @property string $note_short
 * @property string $private_note prvate note visible to user
 * @property string $request_for_payment number for linking the payments
 * @property string $request_for_payment_model model for payment
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesEmailsLog[] $invoicesEmailsLogs
 * @property InvoicesFis[] $invoicesFis
 * @property Countries $customerCountry
 * @property Currency $currency
 * @property Currency $currencyIdInfo
 * @property Customers $customer
 * @property InvoicesHeader $stornoInvoice
 * @property InvoicesHeader[] $invoicesHeaders
 * @property InvoicesTypes $invoiceType
 * @property Owners $owner
 * @property PaymentMethods $paymentMethod
 * @property PaymentsRecive $payment
 * @property Rents $rent
 * @property Reports $reportIdDefault
 * @property TransactionsAccounts $transactionAccount
 * @property Users $user
 * @property Workers $fisWorker
 * @property Workers $worker
 * @property InvoicesItems[] $invoicesItems
 * @property InvoicesItems[] $invoicesItems0
 * @property InvoicesLog[] $invoicesLogs
 * @property InvoicesPayments[] $invoicesPayments
 * @property PaymentsRecive[] $paymentsRecives
 * @property Treasury[] $treasuries
 */
class InvoicesHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_header';
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
        * @param int $rent_id//
        * @param int $user_id//
        * @param int $payment_method_id//
        * @param int $payment_id// link to recive payments
        * @param int $owner_id// link to owners
        * @param int $invoice_type_id//
        * @param int $worker_id// worker who created invoice
        * @param int $report_id_default// default report id
        * @param int $invoice_id// link to storno invoice
        * @param string $type//
        * @param int $number// number of invoice
        * @param string $number_office// adition number for inv
        * @param string $number_pos// adition number for inv
        * @param int $transaction_account_id//
        * @param string $inv_date//
        * @param string $inv_time//
        * @param string $inv_lock// Y means that the invoice has been completed
        * @param string $external_id//
        * @param string $storno// is it storno or not
        * @param int $storno_invoice_id//
        * @param double $price// full price of invoice (populate from invoices_items)
        * @param double $price_neto// price for paying to owners
        * @param double $advance// advance amount recive
        * @param double $vat// sum of vat on invoice (populate from invoice_items)
        * @param double $exchange_info// amount of exchange for information obout price 
        * @param int $currency_id_info// info currency
        * @param int $currency_id//
        * @param string $zki// CRO fiscalization
        * @param string $jir// CRO fiscalization 
        * @param string $status_fis// CRO fiscalization - status Y > ok
        * @param string $datetime_fis//
        * @param int $fis_worker_id//
        * @param string $worker_tax_id// tax id number of worker who create the invoice
        * @param string $customer_name//
        * @param int $customer_id//
        * @param string $company_number//
        * @param string $customer_adress//
        * @param string $customer_city_name//
        * @param string $customer_city_zip//
        * @param string $customer_email//
        * @param string $customer_tel//
        * @param int $customer_country_id//
        * @param string $note//
        * @param string $note_short//
        * @param string $private_note// prvate note visible to user
        * @param string $request_for_payment// number for linking the payments
        * @param string $request_for_payment_model// model for payment
        * @param string $created//
        * @param string $changed//
        * @return InvoicesHeader    */
    public static function create($id, $rent_id, $user_id, $payment_method_id, $payment_id, $owner_id, $invoice_type_id, $worker_id, $report_id_default, $invoice_id, $type, $number, $number_office, $number_pos, $transaction_account_id, $inv_date, $inv_time, $inv_lock, $external_id, $storno, $storno_invoice_id, $price, $price_neto, $advance, $vat, $exchange_info, $currency_id_info, $currency_id, $zki, $jir, $status_fis, $datetime_fis, $fis_worker_id, $worker_tax_id, $customer_name, $customer_id, $company_number, $customer_adress, $customer_city_name, $customer_city_zip, $customer_email, $customer_tel, $customer_country_id, $note, $note_short, $private_note, $request_for_payment, $request_for_payment_model, $created, $changed): InvoicesHeader
    {
        $invoicesHeader = new static();
                $invoicesHeader->id = $id;
                $invoicesHeader->rent_id = $rent_id;
                $invoicesHeader->user_id = $user_id;
                $invoicesHeader->payment_method_id = $payment_method_id;
                $invoicesHeader->payment_id = $payment_id;
                $invoicesHeader->owner_id = $owner_id;
                $invoicesHeader->invoice_type_id = $invoice_type_id;
                $invoicesHeader->worker_id = $worker_id;
                $invoicesHeader->report_id_default = $report_id_default;
                $invoicesHeader->invoice_id = $invoice_id;
                $invoicesHeader->type = $type;
                $invoicesHeader->number = $number;
                $invoicesHeader->number_office = $number_office;
                $invoicesHeader->number_pos = $number_pos;
                $invoicesHeader->transaction_account_id = $transaction_account_id;
                $invoicesHeader->inv_date = $inv_date;
                $invoicesHeader->inv_time = $inv_time;
                $invoicesHeader->inv_lock = $inv_lock;
                $invoicesHeader->external_id = $external_id;
                $invoicesHeader->storno = $storno;
                $invoicesHeader->storno_invoice_id = $storno_invoice_id;
                $invoicesHeader->price = $price;
                $invoicesHeader->price_neto = $price_neto;
                $invoicesHeader->advance = $advance;
                $invoicesHeader->vat = $vat;
                $invoicesHeader->exchange_info = $exchange_info;
                $invoicesHeader->currency_id_info = $currency_id_info;
                $invoicesHeader->currency_id = $currency_id;
                $invoicesHeader->zki = $zki;
                $invoicesHeader->jir = $jir;
                $invoicesHeader->status_fis = $status_fis;
                $invoicesHeader->datetime_fis = $datetime_fis;
                $invoicesHeader->fis_worker_id = $fis_worker_id;
                $invoicesHeader->worker_tax_id = $worker_tax_id;
                $invoicesHeader->customer_name = $customer_name;
                $invoicesHeader->customer_id = $customer_id;
                $invoicesHeader->company_number = $company_number;
                $invoicesHeader->customer_adress = $customer_adress;
                $invoicesHeader->customer_city_name = $customer_city_name;
                $invoicesHeader->customer_city_zip = $customer_city_zip;
                $invoicesHeader->customer_email = $customer_email;
                $invoicesHeader->customer_tel = $customer_tel;
                $invoicesHeader->customer_country_id = $customer_country_id;
                $invoicesHeader->note = $note;
                $invoicesHeader->note_short = $note_short;
                $invoicesHeader->private_note = $private_note;
                $invoicesHeader->request_for_payment = $request_for_payment;
                $invoicesHeader->request_for_payment_model = $request_for_payment_model;
                $invoicesHeader->created = $created;
                $invoicesHeader->changed = $changed;
        
        return $invoicesHeader;
    }

    /**
            * @param int $id//
            * @param int $rent_id//
            * @param int $user_id//
            * @param int $payment_method_id//
            * @param int $payment_id// link to recive payments
            * @param int $owner_id// link to owners
            * @param int $invoice_type_id//
            * @param int $worker_id// worker who created invoice
            * @param int $report_id_default// default report id
            * @param int $invoice_id// link to storno invoice
            * @param string $type//
            * @param int $number// number of invoice
            * @param string $number_office// adition number for inv
            * @param string $number_pos// adition number for inv
            * @param int $transaction_account_id//
            * @param string $inv_date//
            * @param string $inv_time//
            * @param string $inv_lock// Y means that the invoice has been completed
            * @param string $external_id//
            * @param string $storno// is it storno or not
            * @param int $storno_invoice_id//
            * @param double $price// full price of invoice (populate from invoices_items)
            * @param double $price_neto// price for paying to owners
            * @param double $advance// advance amount recive
            * @param double $vat// sum of vat on invoice (populate from invoice_items)
            * @param double $exchange_info// amount of exchange for information obout price 
            * @param int $currency_id_info// info currency
            * @param int $currency_id//
            * @param string $zki// CRO fiscalization
            * @param string $jir// CRO fiscalization 
            * @param string $status_fis// CRO fiscalization - status Y > ok
            * @param string $datetime_fis//
            * @param int $fis_worker_id//
            * @param string $worker_tax_id// tax id number of worker who create the invoice
            * @param string $customer_name//
            * @param int $customer_id//
            * @param string $company_number//
            * @param string $customer_adress//
            * @param string $customer_city_name//
            * @param string $customer_city_zip//
            * @param string $customer_email//
            * @param string $customer_tel//
            * @param int $customer_country_id//
            * @param string $note//
            * @param string $note_short//
            * @param string $private_note// prvate note visible to user
            * @param string $request_for_payment// number for linking the payments
            * @param string $request_for_payment_model// model for payment
            * @param string $created//
            * @param string $changed//
        * @return InvoicesHeader    */
    public function edit($id, $rent_id, $user_id, $payment_method_id, $payment_id, $owner_id, $invoice_type_id, $worker_id, $report_id_default, $invoice_id, $type, $number, $number_office, $number_pos, $transaction_account_id, $inv_date, $inv_time, $inv_lock, $external_id, $storno, $storno_invoice_id, $price, $price_neto, $advance, $vat, $exchange_info, $currency_id_info, $currency_id, $zki, $jir, $status_fis, $datetime_fis, $fis_worker_id, $worker_tax_id, $customer_name, $customer_id, $company_number, $customer_adress, $customer_city_name, $customer_city_zip, $customer_email, $customer_tel, $customer_country_id, $note, $note_short, $private_note, $request_for_payment, $request_for_payment_model, $created, $changed): InvoicesHeader
    {

            $this->id = $id;
            $this->rent_id = $rent_id;
            $this->user_id = $user_id;
            $this->payment_method_id = $payment_method_id;
            $this->payment_id = $payment_id;
            $this->owner_id = $owner_id;
            $this->invoice_type_id = $invoice_type_id;
            $this->worker_id = $worker_id;
            $this->report_id_default = $report_id_default;
            $this->invoice_id = $invoice_id;
            $this->type = $type;
            $this->number = $number;
            $this->number_office = $number_office;
            $this->number_pos = $number_pos;
            $this->transaction_account_id = $transaction_account_id;
            $this->inv_date = $inv_date;
            $this->inv_time = $inv_time;
            $this->inv_lock = $inv_lock;
            $this->external_id = $external_id;
            $this->storno = $storno;
            $this->storno_invoice_id = $storno_invoice_id;
            $this->price = $price;
            $this->price_neto = $price_neto;
            $this->advance = $advance;
            $this->vat = $vat;
            $this->exchange_info = $exchange_info;
            $this->currency_id_info = $currency_id_info;
            $this->currency_id = $currency_id;
            $this->zki = $zki;
            $this->jir = $jir;
            $this->status_fis = $status_fis;
            $this->datetime_fis = $datetime_fis;
            $this->fis_worker_id = $fis_worker_id;
            $this->worker_tax_id = $worker_tax_id;
            $this->customer_name = $customer_name;
            $this->customer_id = $customer_id;
            $this->company_number = $company_number;
            $this->customer_adress = $customer_adress;
            $this->customer_city_name = $customer_city_name;
            $this->customer_city_zip = $customer_city_zip;
            $this->customer_email = $customer_email;
            $this->customer_tel = $customer_tel;
            $this->customer_country_id = $customer_country_id;
            $this->note = $note;
            $this->note_short = $note_short;
            $this->private_note = $private_note;
            $this->request_for_payment = $request_for_payment;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'payment_id' => Yii::t('app', 'Payment ID'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'invoice_type_id' => Yii::t('app', 'Invoice Type ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'report_id_default' => Yii::t('app', 'Report Id Default'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'type' => Yii::t('app', 'Type'),
            'number' => Yii::t('app', 'Number'),
            'number_office' => Yii::t('app', 'Number Office'),
            'number_pos' => Yii::t('app', 'Number Pos'),
            'transaction_account_id' => Yii::t('app', 'Transaction Account ID'),
            'inv_date' => Yii::t('app', 'Inv Date'),
            'inv_time' => Yii::t('app', 'Inv Time'),
            'inv_lock' => Yii::t('app', 'Inv Lock'),
            'external_id' => Yii::t('app', 'External ID'),
            'storno' => Yii::t('app', 'Storno'),
            'storno_invoice_id' => Yii::t('app', 'Storno Invoice ID'),
            'price' => Yii::t('app', 'Price'),
            'price_neto' => Yii::t('app', 'Price Neto'),
            'advance' => Yii::t('app', 'Advance'),
            'vat' => Yii::t('app', 'Vat'),
            'exchange_info' => Yii::t('app', 'Exchange Info'),
            'currency_id_info' => Yii::t('app', 'Currency Id Info'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'zki' => Yii::t('app', 'Zki'),
            'jir' => Yii::t('app', 'Jir'),
            'status_fis' => Yii::t('app', 'Status Fis'),
            'datetime_fis' => Yii::t('app', 'Datetime Fis'),
            'fis_worker_id' => Yii::t('app', 'Fis Worker ID'),
            'worker_tax_id' => Yii::t('app', 'Worker Tax ID'),
            'customer_name' => Yii::t('app', 'Customer Name'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'company_number' => Yii::t('app', 'Company Number'),
            'customer_adress' => Yii::t('app', 'Customer Adress'),
            'customer_city_name' => Yii::t('app', 'Customer City Name'),
            'customer_city_zip' => Yii::t('app', 'Customer City Zip'),
            'customer_email' => Yii::t('app', 'Customer Email'),
            'customer_tel' => Yii::t('app', 'Customer Tel'),
            'customer_country_id' => Yii::t('app', 'Customer Country ID'),
            'note' => Yii::t('app', 'Note'),
            'note_short' => Yii::t('app', 'Note Short'),
            'private_note' => Yii::t('app', 'Private Note'),
            'request_for_payment' => Yii::t('app', 'Request For Payment'),
            'request_for_payment_model' => Yii::t('app', 'Request For Payment Model'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesEmailsLogs()
    {
        return $this->hasMany(InvoicesEmailsLog::class, ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesFis()
    {
        return $this->hasMany(InvoicesFis::class, ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'customer_country_id']);
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
    public function getCurrencyIdInfo()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id_info']);
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
    public function getStornoInvoice()
    {
        return $this->hasOne(InvoicesHeader::class, ['id' => 'storno_invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['storno_invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceType()
    {
        return $this->hasOne(InvoicesTypes::class, ['id' => 'invoice_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owners::class, ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethods::class, ['id' => 'payment_method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentsRecive::class, ['id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportIdDefault()
    {
        return $this->hasOne(Reports::class, ['id' => 'report_id_default']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccount()
    {
        return $this->hasOne(TransactionsAccounts::class, ['id' => 'transaction_account_id']);
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
    public function getFisWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'fis_worker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems()
    {
        return $this->hasMany(InvoicesItems::class, ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems0()
    {
        return $this->hasMany(InvoicesItems::class, ['invoice_id_storno' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesLogs()
    {
        return $this->hasMany(InvoicesLog::class, ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesPayments()
    {
        return $this->hasMany(InvoicesPayments::class, ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreasuries()
    {
        return $this->hasMany(Treasury::class, ['invoice_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\InvoicesHeaderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesHeaderQuery(get_called_class());
    }
}
