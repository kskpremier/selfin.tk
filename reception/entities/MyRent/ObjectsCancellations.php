<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;

/**
 * This is the model class for table "objects_cancellations".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $from
 * @property int $until
 * @property double $percent percent from price
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 */
class ObjectsCancellations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_cancellations';
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
        * @param int $from//
        * @param int $until//
        * @param double $percent// percent from price
        * @param string $created//
        * @param string $changed//
        * @return ObjectsCancellations    */
    public static function create($id, $user_id, $object_id, $from, $until, $percent, $created, $changed): ObjectsCancellations
    {
        $objectsCancellations = new static();
                $objectsCancellations->id = $id;
                $objectsCancellations->user_id = $user_id;
                $objectsCancellations->object_id = $object_id;
                $objectsCancellations->from = $from;
                $objectsCancellations->until = $until;
                $objectsCancellations->percent = $percent;
                $objectsCancellations->created = $created;
                $objectsCancellations->changed = $changed;
        
        return $objectsCancellations;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $from//
            * @param int $until//
            * @param double $percent// percent from price
            * @param string $created//
            * @param string $changed//
        * @return ObjectsCancellations    */
    public function edit($id, $user_id, $object_id, $from, $until, $percent, $created, $changed): ObjectsCancellations
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->from = $from;
            $this->until = $until;
            $this->percent = $percent;
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
            'from' => Yii::t('app', 'From'),
            'until' => Yii::t('app', 'Until'),
            'percent' => Yii::t('app', 'Percent'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsCancellationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsCancellationsQuery(get_called_class());
    }
}
