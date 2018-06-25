<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;

/**
 * This is the model class for table "objects_prices_discounts".
 *
 * @property int $id
 * @property int $object_id
 * @property int $from
 * @property int $until
 * @property int $discount
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 */
class ObjectsPricesDiscounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_discounts';
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
        * @param int $object_id//
        * @param int $from//
        * @param int $until//
        * @param int $discount//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesDiscounts    */
    public static function create($id, $object_id, $from, $until, $discount, $created, $changed): ObjectsPricesDiscounts
    {
        $objectsPricesDiscounts = new static();
                $objectsPricesDiscounts->id = $id;
                $objectsPricesDiscounts->object_id = $object_id;
                $objectsPricesDiscounts->from = $from;
                $objectsPricesDiscounts->until = $until;
                $objectsPricesDiscounts->discount = $discount;
                $objectsPricesDiscounts->created = $created;
                $objectsPricesDiscounts->changed = $changed;
        
        return $objectsPricesDiscounts;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $from//
            * @param int $until//
            * @param int $discount//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesDiscounts    */
    public function edit($id, $object_id, $from, $until, $discount, $created, $changed): ObjectsPricesDiscounts
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->from = $from;
            $this->until = $until;
            $this->discount = $discount;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'from' => Yii::t('app', 'From'),
            'until' => Yii::t('app', 'Until'),
            'discount' => Yii::t('app', 'Discount'),
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
     * @return \reception\entities\MyRent\queries\ObjectsPricesDiscountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesDiscountsQuery(get_called_class());
    }
}
