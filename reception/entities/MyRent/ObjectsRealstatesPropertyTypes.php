<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsRealestates;

/**
 * This is the model class for table "objects_realstates_property_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsRealestates[] $objectsRealestates
 */
class ObjectsRealstatesPropertyTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realstates_property_types';
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
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealstatesPropertyTypes    */
    public static function create($id, $user_id, $code, $name, $created, $changed): ObjectsRealstatesPropertyTypes
    {
        $objectsRealstatesPropertyTypes = new static();
                $objectsRealstatesPropertyTypes->id = $id;
                $objectsRealstatesPropertyTypes->user_id = $user_id;
                $objectsRealstatesPropertyTypes->code = $code;
                $objectsRealstatesPropertyTypes->name = $name;
                $objectsRealstatesPropertyTypes->created = $created;
                $objectsRealstatesPropertyTypes->changed = $changed;
        
        return $objectsRealstatesPropertyTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealstatesPropertyTypes    */
    public function edit($id, $user_id, $code, $name, $created, $changed): ObjectsRealstatesPropertyTypes
    {

            $this->id = $id;
            $this->user_id = $user_id;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestates()
    {
        return $this->hasMany(ObjectsRealestates::class, ['property_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRealstatesPropertyTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealstatesPropertyTypesQuery(get_called_class());
    }
}
