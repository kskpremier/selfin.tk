<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "objects_names".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_type_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsTypes $objectType
 * @property Users $user
 * @property ObjectsRealestates[] $objectsRealestates
 */
class ObjectsNames extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects_names';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_type_id'], 'integer'],
            [['created', 'changed'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['object_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectsTypes::className(), 'targetAttribute' => ['object_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'object_type_id' => 'Object Type ID',
            'code' => 'Code',
            'name' => 'Name',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        return $this->hasOne(ObjectsTypes::className(), ['id' => 'object_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestates()
    {
        return $this->hasMany(ObjectsRealestates::className(), ['object_name_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\ObjectsNamesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ObjectsNamesQuery(get_called_class());
    }
}
