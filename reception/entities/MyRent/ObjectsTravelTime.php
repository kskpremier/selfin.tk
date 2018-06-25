<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_travel_time".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $hour_id_arrival
 * @property int $hour_id_departure
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 */
class ObjectsTravelTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_travel_time';
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
        * @param int $hour_id_arrival//
        * @param int $hour_id_departure//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsTravelTime    */
    public static function create($id, $user_id, $object_id, $hour_id_arrival, $hour_id_departure, $created, $changed): ObjectsTravelTime
    {
        $objectsTravelTime = new static();
                $objectsTravelTime->id = $id;
                $objectsTravelTime->user_id = $user_id;
                $objectsTravelTime->object_id = $object_id;
                $objectsTravelTime->hour_id_arrival = $hour_id_arrival;
                $objectsTravelTime->hour_id_departure = $hour_id_departure;
                $objectsTravelTime->created = $created;
                $objectsTravelTime->changed = $changed;
        
        return $objectsTravelTime;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $hour_id_arrival//
            * @param int $hour_id_departure//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsTravelTime    */
    public function edit($id, $user_id, $object_id, $hour_id_arrival, $hour_id_departure, $created, $changed): ObjectsTravelTime
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->hour_id_arrival = $hour_id_arrival;
            $this->hour_id_departure = $hour_id_departure;
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
            'hour_id_arrival' => Yii::t('app', 'Hour Id Arrival'),
            'hour_id_departure' => Yii::t('app', 'Hour Id Departure'),
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
     * @return \reception\entities\MyRent\queries\ObjectsTravelTimeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsTravelTimeQuery(get_called_class());
    }
}
