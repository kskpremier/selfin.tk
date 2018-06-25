<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\ObjectsRealestatesPictures;

/**
 * This is the model class for table "objects_realestates_pictures_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $objects_realestates_pictures_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsRealestatesPictures $objectsRealestatesPictures
 */
class ObjectsRealestatesPicturesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realestates_pictures_b2b';
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
        * @param int $objects_realestates_pictures_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealestatesPicturesB2b    */
    public static function create($id, $b2b_id, $objects_realestates_pictures_id, $value, $created, $changed): ObjectsRealestatesPicturesB2b
    {
        $objectsRealestatesPicturesB2b = new static();
                $objectsRealestatesPicturesB2b->id = $id;
                $objectsRealestatesPicturesB2b->b2b_id = $b2b_id;
                $objectsRealestatesPicturesB2b->objects_realestates_pictures_id = $objects_realestates_pictures_id;
                $objectsRealestatesPicturesB2b->value = $value;
                $objectsRealestatesPicturesB2b->created = $created;
                $objectsRealestatesPicturesB2b->changed = $changed;
        
        return $objectsRealestatesPicturesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $objects_realestates_pictures_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealestatesPicturesB2b    */
    public function edit($id, $b2b_id, $objects_realestates_pictures_id, $value, $created, $changed): ObjectsRealestatesPicturesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->objects_realestates_pictures_id = $objects_realestates_pictures_id;
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
            'objects_realestates_pictures_id' => Yii::t('app', 'Objects Realestates Pictures ID'),
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
    public function getObjectsRealestatesPictures()
    {
        return $this->hasOne(ObjectsRealestatesPictures::class, ['id' => 'objects_realestates_pictures_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRealestatesPicturesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealestatesPicturesB2bQuery(get_called_class());
    }
}
