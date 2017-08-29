<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property string $name
 *
 * @property PhotoDocument[] $photoDocuments
 * @property PhotoDocumentFace[] $photoDocumentFaces
 * @property PhotoImage[] $photoImages
 * @property PhotoRealFace[] $photoRealFaces
 */
class Album extends \yii\db\ActiveRecord
{
    public const ALBUM_DOCUMENTS = 1;
    public const ALBUM_FACES = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoDocuments()
    {
        return $this->hasMany(PhotoDocument::className(), ['album_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoDocumentFaces()
    {
        return $this->hasMany(PhotoDocumentFace::className(), ['album_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImages()
    {
        return $this->hasMany(PhotoImage::className(), ['album_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoRealFaces()
    {
        return $this->hasMany(PhotoRealFace::className(), ['album_id' => 'id']);
    }
}
