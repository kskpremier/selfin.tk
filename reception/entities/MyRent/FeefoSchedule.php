<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "feefo_schedule".
 *
 * @property int $id
 * @property int $object_id
 * @property int $from
 * @property int $to
 * @property int $created
 * @property int $updated
 */
class FeefoSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feefo_schedule';
    }

    /**
        * @param int $id//
        * @param int $object_id//
        * @param int $from//
        * @param int $to//
        * @param int $created//
        * @param int $updated//
        * @return FeefoSchedule    */
    public static function create($object_id, $from, $to, $created, $updated): FeefoSchedule
    {

        $feefoSchedule = new static();

                $feefoSchedule->object_id = $object_id;
                $feefoSchedule->from = $from;
                $feefoSchedule->to = $to;
                $feefoSchedule->created = $created;
                $feefoSchedule->updated = $updated;
        
        return $feefoSchedule;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $from//
            * @param int $to//
            * @param int $created//
            * @param int $updated//
        * @return FeefoSchedule    */
    public function edit( $object_id, $from, $to, $created=null, $updated=null): FeefoSchedule
    {
            $this->from = $from;
            $this->to = $to;
            $this->created = $created??$this->created;
            $this->updated = $updated??time();
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\FeefoSheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\FeefoSheduleQuery(get_called_class());
    }
}
