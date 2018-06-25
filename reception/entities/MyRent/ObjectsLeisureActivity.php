<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_leisure_activity".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $leasure_id
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 */
class ObjectsLeisureActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_leisure_activity';
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
        * @param int $leasure_id//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsLeisureActivity    */
    public static function create($id, $user_id, $object_id, $leasure_id, $created, $changed): ObjectsLeisureActivity
    {
        $objectsLeisureActivity = new static();
                $objectsLeisureActivity->id = $id;
                $objectsLeisureActivity->user_id = $user_id;
                $objectsLeisureActivity->object_id = $object_id;
                $objectsLeisureActivity->leasure_id = $leasure_id;
                $objectsLeisureActivity->created = $created;
                $objectsLeisureActivity->changed = $changed;
        
        return $objectsLeisureActivity;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $leasure_id//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsLeisureActivity    */
    public function edit($id, $user_id, $object_id, $leasure_id, $created, $changed): ObjectsLeisureActivity
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->leasure_id = $leasure_id;
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
            'leasure_id' => Yii::t('app', 'Leasure ID'),
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsLeisureActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsLeisureActivityQuery(get_called_class());
    }
}
