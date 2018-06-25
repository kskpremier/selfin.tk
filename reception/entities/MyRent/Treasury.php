<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Invoice;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "treasury".
 *
 * @property int $id
 * @property int $user_id
 * @property int $invoice_id
 * @property int $rent_id
 * @property int $worker_id
 * @property string $type
 * @property double $price
 * @property string $date
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader $invoice
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class Treasury extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treasury';
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
        * @param int $rent_id//
        * @param int $worker_id//
        * @param string $type//
        * @param double $price//
        * @param string $date//
        * @param string $created//
        * @param string $changed//
        * @return Treasury    */
    public static function create($id, $user_id, $invoice_id, $rent_id, $worker_id, $type, $price, $date, $created, $changed): Treasury
    {
        $treasury = new static();
                $treasury->id = $id;
                $treasury->user_id = $user_id;
                $treasury->invoice_id = $invoice_id;
                $treasury->rent_id = $rent_id;
                $treasury->worker_id = $worker_id;
                $treasury->type = $type;
                $treasury->price = $price;
                $treasury->date = $date;
                $treasury->created = $created;
                $treasury->changed = $changed;
        
        return $treasury;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $invoice_id//
            * @param int $rent_id//
            * @param int $worker_id//
            * @param string $type//
            * @param double $price//
            * @param string $date//
            * @param string $created//
            * @param string $changed//
        * @return Treasury    */
    public function edit($id, $user_id, $invoice_id, $rent_id, $worker_id, $type, $price, $date, $created, $changed): Treasury
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->invoice_id = $invoice_id;
            $this->rent_id = $rent_id;
            $this->worker_id = $worker_id;
            $this->type = $type;
            $this->price = $price;
            $this->date = $date;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'type' => Yii::t('app', 'Type'),
            'price' => Yii::t('app', 'Price'),
            'date' => Yii::t('app', 'Date'),
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
     * @return \reception\entities\MyRent\queries\TreasuryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\TreasuryQuery(get_called_class());
    }
}
