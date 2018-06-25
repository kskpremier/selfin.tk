<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_payment_options".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property double $deposit
 * @property int $payment_method_id
 * @property int $prepayment_type_id
 * @property double $prepayment
 * @property int $final_payment_id
 * @property int $deposit_id
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPaymentOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_payment_options';
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
        * @param int $object_id//
        * @param double $deposit//
        * @param int $payment_method_id//
        * @param int $prepayment_type_id//
        * @param double $prepayment//
        * @param int $final_payment_id//
        * @param int $deposit_id//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPaymentOptions    */
    public static function create($id, $user_id, $object_id, $deposit, $payment_method_id, $prepayment_type_id, $prepayment, $final_payment_id, $deposit_id, $created, $changed): ObjectsPaymentOptions
    {
        $objectsPaymentOptions = new static();
                $objectsPaymentOptions->id = $id;
                $objectsPaymentOptions->user_id = $user_id;
                $objectsPaymentOptions->object_id = $object_id;
                $objectsPaymentOptions->deposit = $deposit;
                $objectsPaymentOptions->payment_method_id = $payment_method_id;
                $objectsPaymentOptions->prepayment_type_id = $prepayment_type_id;
                $objectsPaymentOptions->prepayment = $prepayment;
                $objectsPaymentOptions->final_payment_id = $final_payment_id;
                $objectsPaymentOptions->deposit_id = $deposit_id;
                $objectsPaymentOptions->created = $created;
                $objectsPaymentOptions->changed = $changed;
        
        return $objectsPaymentOptions;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param double $deposit//
            * @param int $payment_method_id//
            * @param int $prepayment_type_id//
            * @param double $prepayment//
            * @param int $final_payment_id//
            * @param int $deposit_id//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPaymentOptions    */
    public function edit($id, $user_id, $object_id, $deposit, $payment_method_id, $prepayment_type_id, $prepayment, $final_payment_id, $deposit_id, $created, $changed): ObjectsPaymentOptions
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->deposit = $deposit;
            $this->payment_method_id = $payment_method_id;
            $this->prepayment_type_id = $prepayment_type_id;
            $this->prepayment = $prepayment;
            $this->final_payment_id = $final_payment_id;
            $this->deposit_id = $deposit_id;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'deposit' => Yii::t('app', 'Deposit'),
            'payment_method_id' => Yii::t('app', 'Payment Method ID'),
            'prepayment_type_id' => Yii::t('app', 'Prepayment Type ID'),
            'prepayment' => Yii::t('app', 'Prepayment'),
            'final_payment_id' => Yii::t('app', 'Final Payment ID'),
            'deposit_id' => Yii::t('app', 'Deposit ID'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsPaymentOptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPaymentOptionsQuery(get_called_class());
    }
}
