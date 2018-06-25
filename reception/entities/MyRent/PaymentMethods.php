<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\User;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsSources;

/**
 * This is the model class for table "payment_methods".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $payment_method_fis type of payment methot that is used for CRO fiscalization
 * @property string $code
 * @property string $code_inv extra code for invoice (use in inv reports)
 * @property string $name
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader[] $invoicesHeaders
 * @property Users $user
 * @property PaymentsRecive[] $paymentsRecives
 * @property Rents[] $rents
 * @property RentsSources[] $rentsSources
 */
class PaymentMethods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_methods';
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
        * @param string $type//
        * @param string $payment_method_fis// type of payment methot that is used for CRO fiscalization
        * @param string $code//
        * @param string $code_inv// extra code for invoice (use in inv reports)
        * @param string $name//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return PaymentMethods    */
    public static function create($id, $user_id, $type, $payment_method_fis, $code, $code_inv, $name, $note, $created, $changed): PaymentMethods
    {
        $paymentMethods = new static();
                $paymentMethods->id = $id;
                $paymentMethods->user_id = $user_id;
                $paymentMethods->type = $type;
                $paymentMethods->payment_method_fis = $payment_method_fis;
                $paymentMethods->code = $code;
                $paymentMethods->code_inv = $code_inv;
                $paymentMethods->name = $name;
                $paymentMethods->note = $note;
                $paymentMethods->created = $created;
                $paymentMethods->changed = $changed;
        
        return $paymentMethods;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $type//
            * @param string $payment_method_fis// type of payment methot that is used for CRO fiscalization
            * @param string $code//
            * @param string $code_inv// extra code for invoice (use in inv reports)
            * @param string $name//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return PaymentMethods    */
    public function edit($id, $user_id, $type, $payment_method_fis, $code, $code_inv, $name, $note, $created, $changed): PaymentMethods
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->type = $type;
            $this->payment_method_fis = $payment_method_fis;
            $this->code = $code;
            $this->code_inv = $code_inv;
            $this->name = $name;
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
            'type' => Yii::t('app', 'Type'),
            'payment_method_fis' => Yii::t('app', 'Payment Method Fis'),
            'code' => Yii::t('app', 'Code'),
            'code_inv' => Yii::t('app', 'Code Inv'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['payment_method_id' => 'id']);
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
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['payment_method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['payment_method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsSources()
    {
        return $this->hasMany(RentsSources::class, ['payment_method_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\PaymentMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\PaymentMethodsQuery(get_called_class());
    }
}
