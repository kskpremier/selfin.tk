<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "photo_image".
 *
 * @property integer $id
 * @property string $date
 * @property integer $camera_id
 * @property integer $album_id
 * @property string $file_name
 *
 * @property Album $album
 * @property PhotoRealFace[] $photoRealFaces
 */
class PhotoImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'camera_id', 'album_id'], 'required'],
            [['date'], 'safe'],
            [['camera_id', 'album_id'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
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
            'camera_id' => 'Camera ID',
            'album_id' => 'Album ID',
            'file_name' => 'File Name',
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
    public function getCamera()
    {
        return $this->hasOne(Camera::className(), ['id' => 'camera_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoRealFaces()
    {
        return $this->hasMany(PhotoRealFace::className(), ['photo_image_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
}
