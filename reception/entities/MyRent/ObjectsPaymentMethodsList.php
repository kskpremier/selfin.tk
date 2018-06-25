<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsPaymentMethods;
use reception\entities\MyRent\Objects;

/**
 * This is the model class for table "objects_payment_methods_list".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsPaymentMethods[] $objectsPaymentMethods
 * @property Objects[] $objects
 */
class ObjectsPaymentMethodsList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_payment_methods_list';
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
        * @return ObjectsPaymentMethodsList    */
    public static function create($id, $code, $name, $created, $changed): ObjectsPaymentMethodsList
    {
        $objectsPaymentMethodsList = new static();
                $objectsPaymentMethodsList->id = $id;
                $objectsPaymentMethodsList->code = $code;
                $objectsPaymentMethodsList->name = $name;
                $objectsPaymentMethodsList->created = $created;
                $objectsPaymentMethodsList->changed = $changed;
        
        return $objectsPaymentMethodsList;
    }

    /**
            * @param int $id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPaymentMethodsList    */
    public function edit($id, $code, $name, $created, $changed): ObjectsPaymentMethodsList
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
    public function getObjectsPaymentMethods()
    {
        return $this->hasMany(ObjectsPaymentMethods::class, ['method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['id' => 'object_id'])->viaTable('objects_payment_methods', ['method_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsPaymentMethodsListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPaymentMethodsListQuery(get_called_class());
    }
}
