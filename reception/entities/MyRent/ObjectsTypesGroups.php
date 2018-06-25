<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsTypes;

/**
 * This is the model class for table "objects_types_groups".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsTypes[] $objectsTypes
 */
class ObjectsTypesGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_types_groups';
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
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsTypesGroups    */
    public static function create($id, $code, $name, $created, $changed): ObjectsTypesGroups
    {
        $objectsTypesGroups = new static();
                $objectsTypesGroups->id = $id;
                $objectsTypesGroups->code = $code;
                $objectsTypesGroups->name = $name;
                $objectsTypesGroups->created = $created;
                $objectsTypesGroups->changed = $changed;
        
        return $objectsTypesGroups;
    }

    /**
            * @param int $id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsTypesGroups    */
    public function edit($id, $code, $name, $created, $changed): ObjectsTypesGroups
    {

            $this->id = $id;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypes()
    {
        return $this->hasMany(ObjectsTypes::class, ['group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsTypesGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsTypesGroupsQuery(get_called_class());
    }
}
