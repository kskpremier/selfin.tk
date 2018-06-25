<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ItemsB2bs;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsGroupsB2bs;
use reception\entities\MyRent\ObjectsGroupsObjects;
use reception\entities\MyRent\ObjectsGroupsPricesDays;

/**
 * This is the model class for table "objects_groups".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id default object_id for this group
 * @property int $currency_id
 * @property string $code
 * @property string $name
 * @property string $color
 * @property string $web_display
 * @property string $price_sync
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property ItemsB2b[] $itemsB2bs
 * @property Currency $currency
 * @property Objects $object
 * @property Users $user
 * @property ObjectsGroupsB2b[] $objectsGroupsB2bs
 * @property ObjectsGroupsObjects[] $objectsGroupsObjects
 * @property ObjectsGroupsPricesDays[] $objectsGroupsPricesDays
 */
class ObjectsGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_groups';
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
        * @param int $object_id// default object_id for this group
        * @param int $currency_id//
        * @param string $code//
        * @param string $name//
        * @param string $color//
        * @param string $web_display//
        * @param string $price_sync//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsGroups    */
    public static function create($id, $user_id, $object_id, $currency_id, $code, $name, $color, $web_display, $price_sync, $active, $created, $changed): ObjectsGroups
    {
        $objectsGroups = new static();
                $objectsGroups->id = $id;
                $objectsGroups->user_id = $user_id;
                $objectsGroups->object_id = $object_id;
                $objectsGroups->currency_id = $currency_id;
                $objectsGroups->code = $code;
                $objectsGroups->name = $name;
                $objectsGroups->color = $color;
                $objectsGroups->web_display = $web_display;
                $objectsGroups->price_sync = $price_sync;
                $objectsGroups->active = $active;
                $objectsGroups->created = $created;
                $objectsGroups->changed = $changed;
        
        return $objectsGroups;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id// default object_id for this group
            * @param int $currency_id//
            * @param string $code//
            * @param string $name//
            * @param string $color//
            * @param string $web_display//
            * @param string $price_sync//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsGroups    */
    public function edit($id, $user_id, $object_id, $currency_id, $code, $name, $color, $web_display, $price_sync, $active, $created, $changed): ObjectsGroups
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->currency_id = $currency_id;
            $this->code = $code;
            $this->name = $name;
            $this->color = $color;
            $this->web_display = $web_display;
            $this->price_sync = $price_sync;
            $this->active = $active;
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
            'currency_id' => Yii::t('app', 'Currency ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
            'web_display' => Yii::t('app', 'Web Display'),
            'price_sync' => Yii::t('app', 'Price Sync'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsB2bs()
    {
        return $this->hasMany(ItemsB2b::class, ['group_id' => 'id']);
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
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsB2bs()
    {
        return $this->hasMany(ObjectsGroupsB2b::class, ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsObjects()
    {
        return $this->hasMany(ObjectsGroupsObjects::class, ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsPricesDays()
    {
        return $this->hasMany(ObjectsGroupsPricesDays::class, ['group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsGroupsQuery(get_called_class());
    }
}
