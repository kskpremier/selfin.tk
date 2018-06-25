<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\User;
use reception\entities\MyRent\AmenitiesB2bs;
use reception\entities\MyRent\ObjectsAmenites;
use reception\entities\MyRent\ObjectsRoomsAmenities;

/**
 * This is the model class for table "amenities".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Users $user
 * @property AmenitiesB2b[] $amenitiesB2bs
 * @property ObjectsAmenites[] $objectsAmenites
 * @property ObjectsRoomsAmenities[] $objectsRoomsAmenities
 */
class Amenities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amenities';
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
        * @param int $b2b_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return Amenities    */
    public static function create($id, $user_id, $b2b_id, $code, $name, $created, $changed): Amenities
    {
        $amenities = new static();
                $amenities->id = $id;
                $amenities->user_id = $user_id;
                $amenities->b2b_id = $b2b_id;
                $amenities->code = $code;
                $amenities->name = $name;
                $amenities->created = $created;
                $amenities->changed = $changed;
        
        return $amenities;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return Amenities    */
    public function edit($id, $user_id, $b2b_id, $code, $name, $created, $changed): Amenities
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->code = $code;
            $this->name = $name;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenitiesB2bs()
    {
        return $this->hasMany(AmenitiesB2b::class, ['amnety_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAmenites()
    {
        return $this->hasMany(ObjectsAmenites::class, ['amenity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsAmenities()
    {
        return $this->hasMany(ObjectsRoomsAmenities::class, ['amenity_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\AmenitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\AmenitiesQuery(get_called_class());
    }
}
