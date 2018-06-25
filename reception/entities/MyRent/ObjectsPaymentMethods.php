<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Method;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_payment_methods".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $method_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property ObjectsPaymentMethodsList $method
 * @property Users $user
 */
class ObjectsPaymentMethods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_payment_methods';
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
        * @param int $object_id//
        * @param int $method_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPaymentMethods    */
    public static function create($id, $user_id, $object_id, $method_id, $value, $created, $changed): ObjectsPaymentMethods
    {
        $objectsPaymentMethods = new static();
                $objectsPaymentMethods->id = $id;
                $objectsPaymentMethods->user_id = $user_id;
                $objectsPaymentMethods->object_id = $object_id;
                $objectsPaymentMethods->method_id = $method_id;
                $objectsPaymentMethods->value = $value;
                $objectsPaymentMethods->created = $created;
                $objectsPaymentMethods->changed = $changed;
        
        return $objectsPaymentMethods;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $method_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPaymentMethods    */
    public function edit($id, $user_id, $object_id, $method_id, $value, $created, $changed): ObjectsPaymentMethods
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->method_id = $method_id;
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
            'user_id' => Yii::t('app', 'User ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'method_id' => Yii::t('app', 'Method ID'),
            'value' => Yii::t('app', 'Value'),
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
    public function getMethod()
    {
        return $this->hasOne(ObjectsPaymentMethodsList::class, ['id' => 'method_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsPaymentMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPaymentMethodsQuery(get_called_class());
    }
}
