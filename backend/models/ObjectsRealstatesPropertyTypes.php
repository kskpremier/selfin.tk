<?php

namespace backend\models;

use Yii;

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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created', 'changed'], 'safe'],
            [['code', 'name'], 'string', 'max' => 50],
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
            'code' => 'Code',
            'name' => 'Name',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestates()
    {
        return $this->hasMany(ObjectsRealestates::className(), ['property_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\ObjectsRealstatesPropertyTypes the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ObjectsRealstatesPropertyTypes(get_called_class());
    }
}
