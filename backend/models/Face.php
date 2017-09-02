<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "face".
 *
 * @property integer $id
 * @property string $face_id
 * @property double $x
 * @property double $y
 * @property double $width
 * @property double $angle
 * @property integer $photo_image_id
 * @property integer isChecked
 *
 * @property PhotoImage $photoImage
 */
class Face extends \yii\db\ActiveRecord
{
    public $isChecked;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'face';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['x', 'y', 'width', 'angle'], 'number'],
            [['photo_image_id','isChecked'], 'integer'],
            [['face_id'], 'string', 'max' => 255],
            [['photo_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoImage::className(), 'targetAttribute' => ['photo_image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'face_id' => Yii::t('app', 'Face ID'),
            'x' => Yii::t('app', 'X'),
            'y' => Yii::t('app', 'Y'),
            'width' => Yii::t('app', 'Width'),
            'angle' => Yii::t('app', 'Angle'),
            'photo_image_id' => Yii::t('app', 'Photo Image ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImage()
    {
        return $this->hasOne(PhotoImage::className(), ['id' => 'photo_image_id']);
    }

}
