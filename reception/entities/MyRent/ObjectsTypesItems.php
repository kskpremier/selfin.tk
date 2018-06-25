<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\ObjectType;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_types_items".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_type_id
 * @property string $code
 * @property string $name
 * @property double $price
 * @property int $currency_id
 * @property double $vat
 *
 * @property Currency $currency
 * @property ObjectsTypes $objectType
 * @property Users $user
 */
class ObjectsTypesItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_types_items';
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
        * @param int $object_type_id//
        * @param string $code//
        * @param string $name//
        * @param double $price//
        * @param int $currency_id//
        * @param double $vat//
        * @return ObjectsTypesItems    */
    public static function create($id, $user_id, $object_type_id, $code, $name, $price, $currency_id, $vat): ObjectsTypesItems
    {
        $objectsTypesItems = new static();
                $objectsTypesItems->id = $id;
                $objectsTypesItems->user_id = $user_id;
                $objectsTypesItems->object_type_id = $object_type_id;
                $objectsTypesItems->code = $code;
                $objectsTypesItems->name = $name;
                $objectsTypesItems->price = $price;
                $objectsTypesItems->currency_id = $currency_id;
                $objectsTypesItems->vat = $vat;
        
        return $objectsTypesItems;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_type_id//
            * @param string $code//
            * @param string $name//
            * @param double $price//
            * @param int $currency_id//
            * @param double $vat//
        * @return ObjectsTypesItems    */
    public function edit($id, $user_id, $object_type_id, $code, $name, $price, $currency_id, $vat): ObjectsTypesItems
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_type_id = $object_type_id;
            $this->code = $code;
            $this->name = $name;
            $this->price = $price;
            $this->currency_id = $currency_id;
            $this->vat = $vat;
    
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
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'vat' => Yii::t('app', 'Vat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(ObjectsTypes::class, ['id' => 'object_type_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsTypesItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsTypesItemsQuery(get_called_class());
    }
}
