<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectIdFrom;
use reception\entities\MyRent\ObjectIdTo;

/**
 * This is the model class for table "objects_to_objects".
 *
 * @property int $id
 * @property int $object_id_from
 * @property int $object_id_to
 * @property string $rents
 * @property string $prices
 * @property string $searchable
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property Objects $objectIdFrom
 * @property Objects $objectIdTo
 */
class ObjectsToObjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_to_objects';
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
        * @param int $object_id_from//
        * @param int $object_id_to//
        * @param string $rents//
        * @param string $prices//
        * @param string $searchable//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsToObjects    */
    public static function create($id, $object_id_from, $object_id_to, $rents, $prices, $searchable, $enable, $created, $changed): ObjectsToObjects
    {
        $objectsToObjects = new static();
                $objectsToObjects->id = $id;
                $objectsToObjects->object_id_from = $object_id_from;
                $objectsToObjects->object_id_to = $object_id_to;
                $objectsToObjects->rents = $rents;
                $objectsToObjects->prices = $prices;
                $objectsToObjects->searchable = $searchable;
                $objectsToObjects->enable = $enable;
                $objectsToObjects->created = $created;
                $objectsToObjects->changed = $changed;
        
        return $objectsToObjects;
    }

    /**
            * @param int $id//
            * @param int $object_id_from//
            * @param int $object_id_to//
            * @param string $rents//
            * @param string $prices//
            * @param string $searchable//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsToObjects    */
    public function edit($id, $object_id_from, $object_id_to, $rents, $prices, $searchable, $enable, $created, $changed): ObjectsToObjects
    {

            $this->id = $id;
            $this->object_id_from = $object_id_from;
            $this->object_id_to = $object_id_to;
            $this->rents = $rents;
            $this->prices = $prices;
            $this->searchable = $searchable;
            $this->enable = $enable;
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
            'object_id_from' => Yii::t('app', 'Object Id From'),
            'object_id_to' => Yii::t('app', 'Object Id To'),
            'rents' => Yii::t('app', 'Rents'),
            'prices' => Yii::t('app', 'Prices'),
            'searchable' => Yii::t('app', 'Searchable'),
            'enable' => Yii::t('app', 'Enable'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIdFrom()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id_from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectIdTo()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id_to']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsToObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsToObjectsQuery(get_called_class());
    }
}
