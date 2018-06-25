<?php


namespace reception\entities;

use Yii;
use reception\entities\Amenity;
use reception\entities\Object;
use reception\entities\User;

/**
 * This is the model class for table "objects_amenites".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $amenity_id
 * @property string $charge
 * @property string $charge_type
 * @property string $paid_place
 * @property string $paid_mandatory
 * @property double $price
 * @property string $created
 * @property string $changed
 *
 * @property Amenities $amenity
 * @property Objects $object
 * @property Users $user
 */
class ObjectsAmenites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_amenites';
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
        * @param int $amenity_id//
        * @param string $charge//
        * @param string $charge_type//
        * @param string $paid_place//
        * @param string $paid_mandatory//
        * @param double $price//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsAmenites    */
    public static function create($id, $user_id, $object_id, $amenity_id, $charge, $charge_type, $paid_place, $paid_mandatory, $price, $created, $changed): ObjectsAmenites
    {
        $objectsAmenites = new static();
                $objectsAmenites->id = $id;
                $objectsAmenites->user_id = $user_id;
                $objectsAmenites->object_id = $object_id;
                $objectsAmenites->amenity_id = $amenity_id;
                $objectsAmenites->charge = $charge;
                $objectsAmenites->charge_type = $charge_type;
                $objectsAmenites->paid_place = $paid_place;
                $objectsAmenites->paid_mandatory = $paid_mandatory;
                $objectsAmenites->price = $price;
                $objectsAmenites->created = $created;
                $objectsAmenites->changed = $changed;
        
        return $objectsAmenites;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $amenity_id//
            * @param string $charge//
            * @param string $charge_type//
            * @param string $paid_place//
            * @param string $paid_mandatory//
            * @param double $price//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsAmenites    */
    public function edit($id, $user_id, $object_id, $amenity_id, $charge, $charge_type, $paid_place, $paid_mandatory, $price, $created, $changed): ObjectsAmenites
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->amenity_id = $amenity_id;
            $this->charge = $charge;
            $this->charge_type = $charge_type;
            $this->paid_place = $paid_place;
            $this->paid_mandatory = $paid_mandatory;
            $this->price = $price;
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
            'amenity_id' => Yii::t('app', 'Amenity ID'),
            'charge' => Yii::t('app', 'Charge'),
            'charge_type' => Yii::t('app', 'Charge Type'),
            'paid_place' => Yii::t('app', 'Paid Place'),
            'paid_mandatory' => Yii::t('app', 'Paid Mandatory'),
            'price' => Yii::t('app', 'Price'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenity()
    {
        return $this->hasOne(Amenities::class, ['id' => 'amenity_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsAmenitesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsAmenitesQuery(get_called_class());
    }
}
