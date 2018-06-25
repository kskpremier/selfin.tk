<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Offer;

/**
 * This is the model class for table "offers_objects".
 *
 * @property int $id
 * @property int $offer_id
 * @property int $object_id
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Offers $offer
 */
class OffersObjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers_objects';
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
        * @param int $offer_id//
        * @param int $object_id//
        * @param string $created//
        * @param string $changed//
        * @return OffersObjects    */
    public static function create($id, $offer_id, $object_id, $created, $changed): OffersObjects
    {
        $offersObjects = new static();
                $offersObjects->id = $id;
                $offersObjects->offer_id = $offer_id;
                $offersObjects->object_id = $object_id;
                $offersObjects->created = $created;
                $offersObjects->changed = $changed;
        
        return $offersObjects;
    }

    /**
            * @param int $id//
            * @param int $offer_id//
            * @param int $object_id//
            * @param string $created//
            * @param string $changed//
        * @return OffersObjects    */
    public function edit($id, $offer_id, $object_id, $created, $changed): OffersObjects
    {

            $this->id = $id;
            $this->offer_id = $offer_id;
            $this->object_id = $object_id;
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
            'offer_id' => Yii::t('app', 'Offer ID'),
            'object_id' => Yii::t('app', 'Object ID'),
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
    public function getOffer()
    {
        return $this->hasOne(Offers::class, ['id' => 'offer_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\OffersObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\OffersObjectsQuery(get_called_class());
    }
}
