<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "filters".
 *
 * @property int $id
 * @property string $name
 * @property string $ids
 * @property int $created_at
 */
class Filters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['ids'], 'safe'],
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
            'ids' => 'Ids',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\FiltersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\FiltersQuery(get_called_class());
    }
}
