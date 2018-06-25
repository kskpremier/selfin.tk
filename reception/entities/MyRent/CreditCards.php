<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\InvoicesPayments;
use reception\entities\MyRent\PaymentsRecives;

/**
 * This is the model class for table "credit_cards".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property InvoicesPayments[] $invoicesPayments
 * @property PaymentsRecive[] $paymentsRecives
 */
class CreditCards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credit_cards';
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
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return CreditCards    */
    public static function create($id, $user_id, $code, $name, $created, $changed): CreditCards
    {
        $creditCards = new static();
                $creditCards->id = $id;
                $creditCards->user_id = $user_id;
                $creditCards->code = $code;
                $creditCards->name = $name;
                $creditCards->created = $created;
                $creditCards->changed = $changed;
        
        return $creditCards;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return CreditCards    */
    public function edit($id, $user_id, $code, $name, $created, $changed): CreditCards
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
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
    public function getInvoicesPayments()
    {
        return $this->hasMany(InvoicesPayments::class, ['card_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['credit_card_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CreditCardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CreditCardsQuery(get_called_class());
    }
}
