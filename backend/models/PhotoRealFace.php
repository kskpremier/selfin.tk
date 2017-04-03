<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "photo_real_face".
 *
 * @property integer $id
 * @property string $date
 * @property integer $photo_image_id
 * @property string $file_name
 * @property integer $album_id
 * @property double $x1
 * @property double $y2
 * @property double $x2
 *
 * @property Album $album
 * @property PhotoImage $photoImage
 */
class PhotoRealFace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_real_face';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'photo_image_id', 'album_id'], 'required'],
            [['date'], 'safe'],
            [['photo_image_id', 'album_id'], 'integer'],
            [['x1', 'y2', 'x2'], 'number'],
            [['file_name'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['photo_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoImage::className(), 'targetAttribute' => ['photo_image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'photo_image_id' => 'Photo Image ID',
            'file_name' => 'File Name',
            'album_id' => 'Album ID',
            'x1' => 'X1',
            'y2' => 'Y2',
            'x2' => 'X2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImage()
    {
        return $this->hasOne(PhotoImage::className(), ['id' => 'photo_image_id']);
    }
}
