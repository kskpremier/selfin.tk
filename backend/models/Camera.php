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
 * @property integer $apartment_id
 *
 * @property Apartment $apartment
 * @property PhotoImage[] $photoImages
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
            [['admin_pin', 'apartment_id'], 'integer'],
            [['ip', 'type'], 'string', 'max' => 255],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(), 'targetAttribute' => ['apartment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'admin_pin' => Yii::t('app', 'Admin Pin'),
            'ip' => Yii::t('app', 'Ip'),
            'type' => Yii::t('app', 'Type'),
            'apartment_id' => Yii::t('app', 'Apartment ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartment()
    {
        return $this->hasOne(Apartment::className(), ['id' => 'apartment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImages()
    {
        return $this->hasMany(PhotoImage::className(), ['camera_id' => 'id']);
    }
}
