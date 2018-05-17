<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "property_filter".
 *
 * @property int $id
 * @property int $name
 * @property int $created
 * @property int $user_id
 * @property string $property_list
 */
class PropertyFilter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_filter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created', 'user_id'], 'integer'],
            [['property_list'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created' => 'Created',
            'user_id' => 'User ID',
            'property_list' => 'Property List',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\ProQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ProQuery(get_called_class());
    }
}
