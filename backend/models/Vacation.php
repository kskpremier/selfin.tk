<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vacation".
 *
 * @property int $id
 * @property string $name
 * @property string $XML
 * @property string $link
 * @property int $keyId
 */
class Vacation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['XML',], 'string'],
            [['created_at','updated_at'],'safe'],
            [['keyId',], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['link','response'], 'boolean'],
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
            'XML' => 'Xml',
            'link' => 'Link',
            'keyId' => 'Key ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\VacationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\VacationQuery(get_called_class());
    }
}
