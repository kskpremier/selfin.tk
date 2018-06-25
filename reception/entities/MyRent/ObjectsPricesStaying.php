<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_prices_staying".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $day_from
 * @property int $day_until
 * @property double $price
 * @property double $price_day
 * @property double $percent
 * @property double $day_charge
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPricesStaying extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_staying';
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
        * @param int $day_from//
        * @param int $day_until//
        * @param double $price//
        * @param double $price_day//
        * @param double $percent//
        * @param double $day_charge//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesStaying    */
    public static function create($id, $user_id, $object_id, $day_from, $day_until, $price, $price_day, $percent, $day_charge, $created, $changed): ObjectsPricesStaying
    {
        $objectsPricesStaying = new static();
                $objectsPricesStaying->id = $id;
                $objectsPricesStaying->user_id = $user_id;
                $objectsPricesStaying->object_id = $object_id;
                $objectsPricesStaying->day_from = $day_from;
                $objectsPricesStaying->day_until = $day_until;
                $objectsPricesStaying->price = $price;
                $objectsPricesStaying->price_day = $price_day;
                $objectsPricesStaying->percent = $percent;
                $objectsPricesStaying->day_charge = $day_charge;
                $objectsPricesStaying->created = $created;
                $objectsPricesStaying->changed = $changed;
        
        return $objectsPricesStaying;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $day_from//
            * @param int $day_until//
            * @param double $price//
            * @param double $price_day//
            * @param double $percent//
            * @param double $day_charge//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesStaying    */
    public function edit($id, $user_id, $object_id, $day_from, $day_until, $price, $price_day, $percent, $day_charge, $created, $changed): ObjectsPricesStaying
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->day_from = $day_from;
            $this->day_until = $day_until;
            $this->price = $price;
            $this->price_day = $price_day;
            $this->percent = $percent;
            $this->day_charge = $day_charge;
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
            'day_from' => Yii::t('app', 'Day From'),
            'day_until' => Yii::t('app', 'Day Until'),
            'price' => Yii::t('app', 'Price'),
            'price_day' => Yii::t('app', 'Price Day'),
            'percent' => Yii::t('app', 'Percent'),
            'day_charge' => Yii::t('app', 'Day Charge'),
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
     * @return \reception\entities\MyRent\queries\ObjectsPricesStayingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesStayingQuery(get_called_class());
    }
}
