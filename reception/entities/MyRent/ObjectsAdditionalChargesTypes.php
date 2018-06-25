<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsAdditionalCharges;

/**
 * This is the model class for table "objects_additional_charges_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsAdditionalCharges[] $objectsAdditionalCharges
 */
class ObjectsAdditionalChargesTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_additional_charges_types';
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
        * @return ObjectsAdditionalChargesTypes    */
    public static function create($id, $user_id, $code, $name, $created, $changed): ObjectsAdditionalChargesTypes
    {
        $objectsAdditionalChargesTypes = new static();
                $objectsAdditionalChargesTypes->id = $id;
                $objectsAdditionalChargesTypes->user_id = $user_id;
                $objectsAdditionalChargesTypes->code = $code;
                $objectsAdditionalChargesTypes->name = $name;
                $objectsAdditionalChargesTypes->created = $created;
                $objectsAdditionalChargesTypes->changed = $changed;
        
        return $objectsAdditionalChargesTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsAdditionalChargesTypes    */
    public function edit($id, $user_id, $code, $name, $created, $changed): ObjectsAdditionalChargesTypes
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
    public function getObjectsAdditionalCharges()
    {
        return $this->hasMany(ObjectsAdditionalCharges::class, ['type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsAdditionalChargesTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsAdditionalChargesTypesQuery(get_called_class());
    }
}
