<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Charge;
use reception\entities\MyRent\ObjectsAdditionalChargesB2bs;

/**
 * This is the model class for table "objects_additional_charges_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $charge_id
 * @property int $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsAdditionalChargesB2b $charge
 * @property ObjectsAdditionalChargesB2b[] $objectsAdditionalChargesB2bs
 */
class ObjectsAdditionalChargesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_additional_charges_b2b';
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
        * @param int $b2b_id//
        * @param int $charge_id//
        * @param int $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsAdditionalChargesB2b    */
    public static function create($id, $b2b_id, $charge_id, $value, $created, $changed): ObjectsAdditionalChargesB2b
    {
        $objectsAdditionalChargesB2b = new static();
                $objectsAdditionalChargesB2b->id = $id;
                $objectsAdditionalChargesB2b->b2b_id = $b2b_id;
                $objectsAdditionalChargesB2b->charge_id = $charge_id;
                $objectsAdditionalChargesB2b->value = $value;
                $objectsAdditionalChargesB2b->created = $created;
                $objectsAdditionalChargesB2b->changed = $changed;
        
        return $objectsAdditionalChargesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $charge_id//
            * @param int $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsAdditionalChargesB2b    */
    public function edit($id, $b2b_id, $charge_id, $value, $created, $changed): ObjectsAdditionalChargesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->charge_id = $charge_id;
            $this->value = $value;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'charge_id' => Yii::t('app', 'Charge ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharge()
    {
        return $this->hasOne(ObjectsAdditionalChargesB2b::class, ['id' => 'charge_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAdditionalChargesB2bs()
    {
        return $this->hasMany(ObjectsAdditionalChargesB2b::class, ['charge_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsAdditionalChargesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsAdditionalChargesB2bQuery(get_called_class());
    }
}
