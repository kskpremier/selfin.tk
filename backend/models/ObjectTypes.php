<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "objects_types".
 *
 * @property int $id
 * @property string $type R-realstate, T-transport, O-other
 * @property int $group_id
 * @property string $object_type
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property int $sort
 * @property string $erp_id
 * @property string $ota_code
 * @property string $created
 * @property string $changed
 *
 * @property Objects[] $objects
 * @property ObjectsNames[] $objectsNames
 * @property ObjectsTypesGroups $group
 * @property ObjectsTypesB2b[] $objectsTypesB2bs
 * @property ObjectsTypesItems[] $objectsTypesItems
 */
class ObjectTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects_types';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['group_id', 'sort'], 'integer'],
            [['created', 'changed'], 'safe'],
            [['object_type', 'name', 'description', 'picture', 'erp_id', 'ota_code'], 'string', 'max' => 50],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectsTypesGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'group_id' => 'Group ID',
            'object_type' => 'Object Type',
            'name' => 'Name',
            'description' => 'Description',
            'picture' => 'Picture',
            'sort' => 'Sort',
            'erp_id' => 'Erp ID',
            'ota_code' => 'Ota Code',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['object_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsNames()
    {
        return $this->hasMany(ObjectsNames::className(), ['object_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ObjectsTypesGroups::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesB2bs()
    {
        return $this->hasMany(ObjectsTypesB2b::className(), ['objects_types_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesItems()
    {
        return $this->hasMany(ObjectsTypesItems::className(), ['object_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ObjectTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObjectTypesQuery(get_called_class());
    }
}
