<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\CreditCard;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\PaymentMethod;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "payments_recive".
 *
 * @property int $id
 * @property int $user_id
 * @property string $create_by
 * @property int $direction
 * @property string $payment_type
 * @property int $worker_id
 * @property int $rent_id
 * @property int $currency_id
 * @property int $payment_method_id
 * @property int $b2b_id B2B partner
 * @property int $credit_card_id
 * @property int $invoice_id link to Invoice
 * @property string $foreign_id external id (if we recive from another system)
 * @property double $price
 * @property double $exchange
 * @property string $price_with_tax
 * @property string $paid is payed
 * @property string $payment_date
 * @property string $payment_time
 * @property string $note
 * @property string $created_at
 * @property string $subject
 * @property string $card_bin
 * @property string $card_name
 * @property string $card_customer_location
 * @property string $card_expiration_date
 * @property string $card_img
 * @property string $card_issuing_bank
 * @property string $card_last_four
 * @property string $currency_iso_code
 * @property string $card_masked_number
 * @property string $status
 * @property string $status_amount
 * @property string $cvv_response_code
 * @property string $erp_id
 * @property string $merchant_account_id
 * @property string $payment_instrument_type
 * @property string $processor_response_code
 * @property string $processor_response_text
 * @property string $type
 * @property string $processor_authorization_code
 * @property string $update_at
 * @property string $ip_adress
 * @property string $user_agent
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader[] $invoicesHeaders
 * @property B2b $b2b
 * @property CreditCards $creditCard
 * @property InvoicesHeader $invoice
 * @property PaymentMethods $paymentMethod
 * @property Currency $currency
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class PaymentsRecive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments_recive';
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
        * @param string $create_by//
        * @param int $direction//
        * @param string $payment_type//
        * @param int $worker_id//
        * @param int $rent_id//
        * @param int $currency_id//
        * @param int $payment_method_id//
        * @param int $b2b_id// B2B partner
        * @param int $credit_card_id//
        * @param int $invoice_id// link to Invoice
        * @param string $foreign_id// external id (if we recive from another system)
        * @param double $price//
        * @param double $exchange//
        * @param string $price_with_tax//
        * @param string $paid// is payed
        * @param string $payment_date//
        * @param string $payment_time//
        * @param string $note//
        * @param string $created_at//
        * @param string $subject//
        * @param string $card_bin//
        * @param string $card_name//
        * @param string $card_customer_location//
        * @param string $card_expiration_date//
        * @param string $card_img//
        * @param string $card_issuing_bank//
        * @param string $card_last_four//
        * @param string $currency_iso_code//
        * @param string $card_masked_number//
        * @param string $status//
        * @param string $status_amount//
        * @param string $cvv_response_code//
        * @param string $erp_id//
        * @param string $merchant_account_id//
        * @param string $payment_instrument_type//
        * @param string $processor_response_code//
        * @param string $processor_response_text//
        * @param string $type//
        * @param string $processor_authorization_code//
        * @param string $update_at//
        * @param string $ip_adress//
        * @param string $user_agent//
        * @param string $created//
        * @param string $changed//
        * @return PaymentsRecive    */
    public static function create($id, $user_id, $create_by, $direction, $payment_type, $worker_id, $rent_id, $currency_id, $payment_method_id, $b2b_id, $credit_card_id, $invoice_id, $foreign_id, $price, $exchange, $price_with_tax, $paid, $payment_date, $payment_time, $note, $created_at, $subject, $card_bin, $card_name, $card_customer_location, $card_expiration_date, $card_img, $card_issuing_bank, $card_last_four, $currency_iso_code, $card_masked_number, $status, $status_amount, $cvv_response_code, $erp_id, $merchant_account_id, $payment_instrument_type, $processor_response_code, $processor_response_text, $type, $processor_authorization_code, $update_at, $ip_adress, $user_agent, $created, $changed): PaymentsRecive
    {
        $paymentsRecive = new static();
                $paymentsRecive->id = $id;
                $paymentsRecive->user_id = $user_id;
                $paymentsRecive->create_by = $create_by;
                $paymentsRecive->direction = $direction;
                $paymentsRecive->payment_type = $payment_type;
                $paymentsRecive->worker_id = $worker_id;
                $paymentsRecive->rent_id = $rent_id;
                $paymentsRecive->currency_id = $currency_id;
                $paymentsRecive->payment_method_id = $payment_method_id;
                $paymentsRecive->b2b_id = $b2b_id;
                $paymentsRecive->credit_card_id = $credit_card_id;
                $paymentsRecive->invoice_id = $invoice_id;
                $paymentsRecive->foreign_id = $foreign_id;
                $paymentsRecive->price = $price;
                $paymentsRecive->exchange = $exchange;
                $paymentsRecive->price_with_tax = $price_with_tax;
                $paymentsRecive->paid = $paid;
                $paymentsRecive->payment_date = $payment_date;
                $paymentsRecive->payment_time = $payment_time;
                $paymentsRecive->note = $note;
                $paymentsRecive->created_at = $created_at;
                $paymentsRecive->subject = $subject;
                $paymentsRecive->card_bin = $card_bin;
                $paymentsRecive->card_name = $card_name;
                $paymentsRecive->card_customer_location = $card_customer_location;
                $paymentsRecive->card_expiration_date = $card_expiration_date;
                $paymentsRecive->card_img = $card_img;
                $paymentsRecive->card_issuing_bank = $card_issuing_bank;
                $paymentsRecive->card_last_four = $card_last_four;
                $paymentsRecive->currency_iso_code = $currency_iso_code;
                $paymentsRecive->card_masked_number = $card_masked_number;
                $paymentsRecive->status = $status;
                $paymentsRecive->status_amount = $status_amount;
                $paymentsRecive->cvv_response_code = $cvv_response_code;
                $paymentsRecive->erp_id = $erp_id;
                $paymentsRecive->merchant_account_id = $merchant_account_id;
                $paymentsRecive->payment_instrument_type = $payment_instrument_type;
                $paymentsRecive->processor_response_code = $processor_response_code;
                $paymentsRecive->processor_response_text = $processor_response_text;
                $paymentsRecive->type = $type;
                $paymentsRecive->processor_authorization_code = $processor_authorization_code;
                $paymentsRecive->update_at = $update_at;
                $paymentsRecive->ip_adress = $ip_adress;
                $paymentsRecive->user_agent = $user_agent;
                $paymentsRecive->created = $created;
                $paymentsRecive->changed = $changed;
        
        return $paymentsRecive;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $create_by//
            * @param int $direction//
            * @param string $payment_type//
            * @param int $worker_id//
            * @param int $rent_id//
            * @param int $currency_id//
            * @param int $payment_method_id//
            * @param int $b2b_id// B2B partner
            * @param int $credit_card_id//
            * @param int $invoice_id// link to Invoice
            * @param string $foreign_id// external id (if we recive from another system)
            * @param double $price//
            * @param double $exchange//
            * @param string $price_with_tax//
            * @param string $paid// is payed
            * @param string $payment_date//
            * @param string $payment_time//
            * @param string $note//
            * @param string $created_at//
            * @param string $subject//
            * @param string $card_bin//
            * @param string $card_name//
            * @param string $card_customer_location//
            * @param string $card_expiration_date//
            * @param string $card_img//
            * @param string $card_issuing_bank//
            * @param string $card_last_four//
            * @param string $currency_iso_code//
            * @param string $card_masked_number//
            * @param string $status//
            * @param string $status_amount//
            * @param string $cvv_response_code//
            * @param string $erp_id//
            * @param string $merchant_account_id//
            * @param string $payment_instrument_type//
            * @param string $processor_response_code//
            * @param string $processor_response_text//
            * @param string $type//
            * @param string $processor_authorization_code//
            * @param string $update_at//
            * @param string $ip_adress//
            * @param string $user_agent//
            * @param string $created//
            * @param string $changed//
        * @return PaymentsRecive    */
    public function edit($id, $user_id, $create_by, $direction, $payment_type, $worker_id, $rent_id, $currency_id, $payment_method_id, $b2b_id, $credit_card_id, $invoice_id, $foreign_id, $price, $exchange, $price_with_tax, $paid, $payment_date, $payment_time, $note, $created_at, $subject, $card_bin, $card_name, $card_customer_location, $card_expiration_date, $card_img, $card_issuing_bank, $card_last_four, $currency_iso_code, $card_masked_number, $status, $status_amount, $cvv_response_code, $erp_id, $merchant_account_id, $payment_instrument_type, $processor_response_code, $processor_response_text, $type, $processor_authorization_code, $update_at, $ip_adress, $user_agent, $created, $changed): PaymentsRecive
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->create_by = $create_by;
            $this->direction = $direction;
            $this->payment_type = $payment_type;
            $this->worker_id = $worker_id;
            $this->rent_id = $rent_id;
            $this->currency_id = $currency_id;
            $this->payment_method_id = $payment_method_id;
            $this->b2b_id = $b2b_id;
            $this->credit_card_id = $credit_card_id;
            $this->invoice_id = $invoice_id;
            $this->foreign_id = $foreign_id;
            $this->price = $price;
            $this->exchange = $exchange;
            $this->price_with_tax = $price_with_tax;
            $this->paid = $paid;
            $this->payment_date = $payment_date;
            $this->payment_time = $payment_time;
            $this->note = $note;
            $this->created_at = $created_at;
            $this->subject = $subject;
            $this->card_bin = $card_bin;
            $this->card_name = $card_name;
            $this->card_customer_location = $card_customer_location;
            $this->card_expiration_date = $card_expiration_date;
            $this->card_img = $card_img;
            $this->card_issuing_bank = $card_issuing_bank;
            $this->card_last_four = $card_last_four;
            $this->currency_iso_code = $currency_iso_code;
            $this->card_masked_number = $card_masked_number;
            $this->status = $status;
            $this->status_amount = $status_amount;
            $this->cvv_response_code = $cvv_response_code;
            $this->erp_id = $erp_id;
            $this->merchant_account_id = $merchant_account_id;
            $this->payment_instrument_type = $payment_instrument_type;
            $this->processor_response_code = $processor_response_code;
            $this->processor_response_text = $processor_response_text;
            $this->type = $type;
            $this->processor_authorization_code = $processor_authorization_code;
            $this->update_at = $update_at;
            $this->ip_adress = $ip_adress;
            $this->user_agent = $user_agent;
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
            'create_by' => Yii::t('app', 'Create By'),
            'direction' => Yii::t('app', 'Direction'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'credit_card_id' => Yii::t('app', 'Credit Card ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'foreign_id' => Yii::t('app', 'Foreign ID'),
            'price' => Yii::t('app', 'Price'),
            'exchange' => Yii::t('app', 'Exchange'),
            'price_with_tax' => Yii::t('app', 'Price With Tax'),
            'paid' => Yii::t('app', 'Paid'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'payment_time' => Yii::t('app', 'Payment Time'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'subject' => Yii::t('app', 'Subject'),
            'card_bin' => Yii::t('app', 'Card Bin'),
            'card_name' => Yii::t('app', 'Card Name'),
            'card_customer_location' => Yii::t('app', 'Card Customer Location'),
            'card_expiration_date' => Yii::t('app', 'Card Expiration Date'),
            'card_img' => Yii::t('app', 'Card Img'),
            'card_issuing_bank' => Yii::t('app', 'Card Issuing Bank'),
            'card_last_four' => Yii::t('app', 'Card Last Four'),
            'currency_iso_code' => Yii::t('app', 'Currency Iso Code'),
            'card_masked_number' => Yii::t('app', 'Card Masked Number'),
            'status' => Yii::t('app', 'Status'),
            'status_amount' => Yii::t('app', 'Status Amount'),
            'cvv_response_code' => Yii::t('app', 'Cvv Response Code'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'merchant_account_id' => Yii::t('app', 'Merchant Account ID'),
            'payment_instrument_type' => Yii::t('app', 'Payment Instrument Type'),
            'processor_response_code' => Yii::t('app', 'Processor Response Code'),
            'processor_response_text' => Yii::t('app', 'Processor Response Text'),
            'type' => Yii::t('app', 'Type'),
            'processor_authorization_code' => Yii::t('app', 'Processor Authorization Code'),
            'update_at' => Yii::t('app', 'Update At'),
            'ip_adress' => Yii::t('app', 'Ip Adress'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditCard()
    {
        return $this->hasOne(CreditCards::class, ['id' => 'credit_card_id']);
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
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethods::class, ['id' => 'payment_method_id']);
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
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
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
     * @return \reception\entities\MyRent\queries\PaymentsReciveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\PaymentsReciveQuery(get_called_class());
    }
}
