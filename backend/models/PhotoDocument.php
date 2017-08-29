<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "photo_document".
 *
 * @property integer $id
 * @property string $date
 * @property integer $application_id
 * @property string $file_name
 * @property integer $album_id
 *
 * @property Document[] $documents
 * @property Album $album
 * @property Application $application
 * @property PhotoDocumentFace[] $photoDocumentFaces
 */
class PhotoDocument extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['application_id', 'album_id'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
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
            'application_id' => 'Application ID',
            'file_name' => 'File Name',
            'album_id' => 'Album ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['photo_document_id' => 'id']);
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
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoDocumentFaces()
    {
        return $this->hasMany(PhotoDocumentFace::className(), ['photo_document_id' => 'id']);
    }
}
