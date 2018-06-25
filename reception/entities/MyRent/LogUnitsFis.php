<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Unit;

/**
 * This is the model class for table "log_units_fis".
 *
 * @property int $id
 * @property int $unit_id
 * @property string $type
 * @property string $send
 * @property string $recive
 * @property int $runtime
 * @property string $status
 * @property string $created
 *
 * @property Units $unit
 */
class LogUnitsFis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_units_fis';
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
        * @param int $unit_id//
        * @param string $type//
        * @param string $send//
        * @param string $recive//
        * @param int $runtime//
        * @param string $status//
        * @param string $created//
        * @return LogUnitsFis    */
    public static function create($id, $unit_id, $type, $send, $recive, $runtime, $status, $created): LogUnitsFis
    {
        $logUnitsFis = new static();
                $logUnitsFis->id = $id;
                $logUnitsFis->unit_id = $unit_id;
                $logUnitsFis->type = $type;
                $logUnitsFis->send = $send;
                $logUnitsFis->recive = $recive;
                $logUnitsFis->runtime = $runtime;
                $logUnitsFis->status = $status;
                $logUnitsFis->created = $created;
        
        return $logUnitsFis;
    }

    /**
            * @param int $id//
            * @param int $unit_id//
            * @param string $type//
            * @param string $send//
            * @param string $recive//
            * @param int $runtime//
            * @param string $status//
            * @param string $created//
        * @return LogUnitsFis    */
    public function edit($id, $unit_id, $type, $send, $recive, $runtime, $status, $created): LogUnitsFis
    {

            $this->id = $id;
            $this->unit_id = $unit_id;
            $this->type = $type;
            $this->send = $send;
            $this->recive = $recive;
            $this->runtime = $runtime;
            $this->status = $status;
            $this->created = $created;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'type' => Yii::t('app', 'Type'),
            'send' => Yii::t('app', 'Send'),
            'recive' => Yii::t('app', 'Recive'),
            'runtime' => Yii::t('app', 'Runtime'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogUnitsFisQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogUnitsFisQuery(get_called_class());
    }
}
