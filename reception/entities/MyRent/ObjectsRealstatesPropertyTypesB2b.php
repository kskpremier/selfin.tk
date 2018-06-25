<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "objects_realstates_property_types_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $type_id
 * @property int $value
 * @property string $created
 * @property string $changed
 */
class ObjectsRealstatesPropertyTypesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realstates_property_types_b2b';
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
        * @param int $type_id//
        * @param int $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealstatesPropertyTypesB2b    */
    public static function create($id, $b2b_id, $type_id, $value, $created, $changed): ObjectsRealstatesPropertyTypesB2b
    {
        $objectsRealstatesPropertyTypesB2b = new static();
                $objectsRealstatesPropertyTypesB2b->id = $id;
                $objectsRealstatesPropertyTypesB2b->b2b_id = $b2b_id;
                $objectsRealstatesPropertyTypesB2b->type_id = $type_id;
                $objectsRealstatesPropertyTypesB2b->value = $value;
                $objectsRealstatesPropertyTypesB2b->created = $created;
                $objectsRealstatesPropertyTypesB2b->changed = $changed;
        
        return $objectsRealstatesPropertyTypesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $type_id//
            * @param int $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealstatesPropertyTypesB2b    */
    public function edit($id, $b2b_id, $type_id, $value, $created, $changed): ObjectsRealstatesPropertyTypesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->type_id = $type_id;
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
            'type_id' => Yii::t('app', 'Type ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRealstatesPropertyTypesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealstatesPropertyTypesB2bQuery(get_called_class());
    }
}
