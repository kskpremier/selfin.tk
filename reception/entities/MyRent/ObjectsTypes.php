<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsNames;
use reception\entities\MyRent\Group;
use reception\entities\MyRent\ObjectsTypesB2bs;
use reception\entities\MyRent\ObjectsTypesItems;

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
class ObjectsTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        * @param int $id//
        * @param string $type// R-realstate, T-transport, O-other
        * @param int $group_id//
        * @param string $object_type//
        * @param string $name//
        * @param string $description//
        * @param string $picture//
        * @param int $sort//
        * @param string $erp_id//
        * @param string $ota_code//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsTypes    */
    public static function create($id, $type, $group_id, $object_type, $name, $description, $picture, $sort, $erp_id, $ota_code, $created, $changed): ObjectsTypes
    {
        $objectsTypes = new static();
                $objectsTypes->id = $id;
                $objectsTypes->type = $type;
                $objectsTypes->group_id = $group_id;
                $objectsTypes->object_type = $object_type;
                $objectsTypes->name = $name;
                $objectsTypes->description = $description;
                $objectsTypes->picture = $picture;
                $objectsTypes->sort = $sort;
                $objectsTypes->erp_id = $erp_id;
                $objectsTypes->ota_code = $ota_code;
                $objectsTypes->created = $created;
                $objectsTypes->changed = $changed;
        
        return $objectsTypes;
    }

    /**
            * @param int $id//
            * @param string $type// R-realstate, T-transport, O-other
            * @param int $group_id//
            * @param string $object_type//
            * @param string $name//
            * @param string $description//
            * @param string $picture//
            * @param int $sort//
            * @param string $erp_id//
            * @param string $ota_code//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsTypes    */
    public function edit($id, $type, $group_id, $object_type, $name, $description, $picture, $sort, $erp_id, $ota_code, $created, $changed): ObjectsTypes
    {

            $this->id = $id;
            $this->type = $type;
            $this->group_id = $group_id;
            $this->object_type = $object_type;
            $this->name = $name;
            $this->description = $description;
            $this->picture = $picture;
            $this->sort = $sort;
            $this->erp_id = $erp_id;
            $this->ota_code = $ota_code;
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
            'type' => Yii::t('app', 'Type'),
            'group_id' => Yii::t('app', 'Group ID'),
            'object_type' => Yii::t('app', 'Object Type'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'picture' => Yii::t('app', 'Picture'),
            'sort' => Yii::t('app', 'Sort'),
            'erp_id' => Yii::t('app', 'Erp ID'),
            'ota_code' => Yii::t('app', 'Ota Code'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['object_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsNames()
    {
        return $this->hasMany(ObjectsNames::class, ['object_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ObjectsTypesGroups::class, ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesB2bs()
    {
        return $this->hasMany(ObjectsTypesB2b::class, ['objects_types_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesItems()
    {
        return $this->hasMany(ObjectsTypesItems::class, ['object_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsTypesQuery(get_called_class());
    }
}
