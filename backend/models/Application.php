<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $token
 *
 * @property Guest[] $guests
 * @property PhotoDocument[] $photoDocuments
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'token'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(Guest::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoDocuments()
    {
        return $this->hasMany(PhotoDocument::className(), ['application_id' => 'id']);
    }
}
