<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\UserB2b;

/**
 * This is the model class for table "objects_evisitor".
 *
 * @property int $id
 * @property int $object_id
 * @property int $user_b2b_id
 * @property string $eVizitor_object
 * @property string $checkin
 * @property string $checkout
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property UsersB2b $userB2b
 */
class ObjectsEvisitor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_evisitor';
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
        * @param int $object_id//
        * @param int $user_b2b_id//
        * @param string $eVizitor_object//
        * @param string $checkin//
        * @param string $checkout//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsEvisitor    */
    public static function create($id, $object_id, $user_b2b_id, $eVizitor_object, $checkin, $checkout, $enable, $created, $changed): ObjectsEvisitor
    {
        $objectsEvisitor = new static();
                $objectsEvisitor->id = $id;
                $objectsEvisitor->object_id = $object_id;
                $objectsEvisitor->user_b2b_id = $user_b2b_id;
                $objectsEvisitor->eVizitor_object = $eVizitor_object;
                $objectsEvisitor->checkin = $checkin;
                $objectsEvisitor->checkout = $checkout;
                $objectsEvisitor->enable = $enable;
                $objectsEvisitor->created = $created;
                $objectsEvisitor->changed = $changed;
        
        return $objectsEvisitor;
    }

    /**
            * @param int $id//
            * @param int $object_id//
            * @param int $user_b2b_id//
            * @param string $eVizitor_object//
            * @param string $checkin//
            * @param string $checkout//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsEvisitor    */
    public function edit($id, $object_id, $user_b2b_id, $eVizitor_object, $checkin, $checkout, $enable, $created, $changed): ObjectsEvisitor
    {

            $this->id = $id;
            $this->object_id = $object_id;
            $this->user_b2b_id = $user_b2b_id;
            $this->eVizitor_object = $eVizitor_object;
            $this->checkin = $checkin;
            $this->checkout = $checkout;
            $this->enable = $enable;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'user_b2b_id' => Yii::t('app', 'User B2b ID'),
            'eVizitor_object' => Yii::t('app', 'E Vizitor Object'),
            'checkin' => Yii::t('app', 'Checkin'),
            'checkout' => Yii::t('app', 'Checkout'),
            'enable' => Yii::t('app', 'Enable'),
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
    public function getUserB2b()
    {
        return $this->hasOne(UsersB2b::class, ['id' => 'user_b2b_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsEvisitorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsEvisitorQuery(get_called_class());
    }
}
