<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Description;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_realestates_descriptions_b2b".
 *
 * @property int $id
 * @property int $user_id
 * @property int $description_id
 * @property int $b2b_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsRealestatesDescriptions $description
 * @property Users $user
 */
class ObjectsRealestatesDescriptionsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realestates_descriptions_b2b';
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
        * @param int $description_id//
        * @param int $b2b_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealestatesDescriptionsB2b    */
    public static function create($id, $user_id, $description_id, $b2b_id, $value, $created, $changed): ObjectsRealestatesDescriptionsB2b
    {
        $objectsRealestatesDescriptionsB2b = new static();
                $objectsRealestatesDescriptionsB2b->id = $id;
                $objectsRealestatesDescriptionsB2b->user_id = $user_id;
                $objectsRealestatesDescriptionsB2b->description_id = $description_id;
                $objectsRealestatesDescriptionsB2b->b2b_id = $b2b_id;
                $objectsRealestatesDescriptionsB2b->value = $value;
                $objectsRealestatesDescriptionsB2b->created = $created;
                $objectsRealestatesDescriptionsB2b->changed = $changed;
        
        return $objectsRealestatesDescriptionsB2b;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $description_id//
            * @param int $b2b_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealestatesDescriptionsB2b    */
    public function edit($id, $user_id, $description_id, $b2b_id, $value, $created, $changed): ObjectsRealestatesDescriptionsB2b
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->description_id = $description_id;
            $this->b2b_id = $b2b_id;
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
            'description_id' => Yii::t('app', 'Description ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescription()
    {
        return $this->hasOne(ObjectsRealestatesDescriptions::class, ['id' => 'description_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsRealestatesDescriptionsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealestatesDescriptionsB2bQuery(get_called_class());
    }
}
