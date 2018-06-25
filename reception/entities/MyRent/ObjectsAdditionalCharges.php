<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Type;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_additional_charges".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $type_id
 * @property int $calculation_id
 * @property string $optional
 * @property double $price
 * @property string $grp
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property ObjectsAdditionalChargesTypes $type
 * @property Users $user
 */
class ObjectsAdditionalCharges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_additional_charges';
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
        * @param int $type_id//
        * @param int $calculation_id//
        * @param string $optional//
        * @param double $price//
        * @param string $grp//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsAdditionalCharges    */
    public static function create($id, $user_id, $object_id, $type_id, $calculation_id, $optional, $price, $grp, $created, $changed): ObjectsAdditionalCharges
    {
        $objectsAdditionalCharges = new static();
                $objectsAdditionalCharges->id = $id;
                $objectsAdditionalCharges->user_id = $user_id;
                $objectsAdditionalCharges->object_id = $object_id;
                $objectsAdditionalCharges->type_id = $type_id;
                $objectsAdditionalCharges->calculation_id = $calculation_id;
                $objectsAdditionalCharges->optional = $optional;
                $objectsAdditionalCharges->price = $price;
                $objectsAdditionalCharges->grp = $grp;
                $objectsAdditionalCharges->created = $created;
                $objectsAdditionalCharges->changed = $changed;
        
        return $objectsAdditionalCharges;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $type_id//
            * @param int $calculation_id//
            * @param string $optional//
            * @param double $price//
            * @param string $grp//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsAdditionalCharges    */
    public function edit($id, $user_id, $object_id, $type_id, $calculation_id, $optional, $price, $grp, $created, $changed): ObjectsAdditionalCharges
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->type_id = $type_id;
            $this->calculation_id = $calculation_id;
            $this->optional = $optional;
            $this->price = $price;
            $this->grp = $grp;
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
            'type_id' => Yii::t('app', 'Type ID'),
            'calculation_id' => Yii::t('app', 'Calculation ID'),
            'optional' => Yii::t('app', 'Optional'),
            'price' => Yii::t('app', 'Price'),
            'grp' => Yii::t('app', 'Grp'),
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
    public function getType()
    {
        return $this->hasOne(ObjectsAdditionalChargesTypes::class, ['id' => 'type_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsAdditionalChargesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsAdditionalChargesQuery(get_called_class());
    }
}
