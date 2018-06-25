<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "payments_boxes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id responsable worker
 * @property string $code
 * @property string $type
 * @property string $name
 * @property double $money_min
 * @property double $money_max
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property Workers $worker
 */
class PaymentsBoxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments_boxes';
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
        * @param int $worker_id// responsable worker
        * @param string $code//
        * @param string $type//
        * @param string $name//
        * @param double $money_min//
        * @param double $money_max//
        * @param string $created//
        * @param string $changed//
        * @return PaymentsBoxes    */
    public static function create($id, $user_id, $worker_id, $code, $type, $name, $money_min, $money_max, $created, $changed): PaymentsBoxes
    {
        $paymentsBoxes = new static();
                $paymentsBoxes->id = $id;
                $paymentsBoxes->user_id = $user_id;
                $paymentsBoxes->worker_id = $worker_id;
                $paymentsBoxes->code = $code;
                $paymentsBoxes->type = $type;
                $paymentsBoxes->name = $name;
                $paymentsBoxes->money_min = $money_min;
                $paymentsBoxes->money_max = $money_max;
                $paymentsBoxes->created = $created;
                $paymentsBoxes->changed = $changed;
        
        return $paymentsBoxes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id// responsable worker
            * @param string $code//
            * @param string $type//
            * @param string $name//
            * @param double $money_min//
            * @param double $money_max//
            * @param string $created//
            * @param string $changed//
        * @return PaymentsBoxes    */
    public function edit($id, $user_id, $worker_id, $code, $type, $name, $money_min, $money_max, $created, $changed): PaymentsBoxes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->code = $code;
            $this->type = $type;
            $this->name = $name;
            $this->money_min = $money_min;
            $this->money_max = $money_max;
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
            'code' => Yii::t('app', 'Code'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'money_min' => Yii::t('app', 'Money Min'),
            'money_max' => Yii::t('app', 'Money Max'),
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
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\PaymentsBoxesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\PaymentsBoxesQuery(get_called_class());
    }
}
