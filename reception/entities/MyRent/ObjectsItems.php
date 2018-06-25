<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_items".
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property int $object_id
 * @property int $item_id
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Units $unit
 * @property Users $user
 */
class ObjectsItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_items';
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
        * @param int $unit_id//
        * @param int $object_id//
        * @param int $item_id//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsItems    */
    public static function create($id, $user_id, $unit_id, $object_id, $item_id, $created, $changed): ObjectsItems
    {
        $objectsItems = new static();
                $objectsItems->id = $id;
                $objectsItems->user_id = $user_id;
                $objectsItems->unit_id = $unit_id;
                $objectsItems->object_id = $object_id;
                $objectsItems->item_id = $item_id;
                $objectsItems->created = $created;
                $objectsItems->changed = $changed;
        
        return $objectsItems;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $unit_id//
            * @param int $object_id//
            * @param int $item_id//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsItems    */
    public function edit($id, $user_id, $unit_id, $object_id, $item_id, $created, $changed): ObjectsItems
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->unit_id = $unit_id;
            $this->object_id = $object_id;
            $this->item_id = $item_id;
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'item_id' => Yii::t('app', 'Item ID'),
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
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsItemsQuery(get_called_class());
    }
}
