<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property integer $admin_pin
 * @property string $ip
 * @property string $type
 *
 * @property Apartment[] $apartments
 */
class Camera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_pin'], 'integer'],
            [['ip', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_pin' => 'Admin Pin',
            'ip' => 'Ip',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments()
    {
        return $this->hasMany(Apartment::className(), ['camera_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImages()
    {
        return $this->hasMany(PhotoImage::className(), ['camera_id' => 'id']);
    }
}
