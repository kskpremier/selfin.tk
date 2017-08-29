<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "photo_document_face".
 *
 * @property integer $id
 * @property string $date
 * @property integer $photo_document_id
 * @property string $file_name
 * @property integer $album_id
 * @property double $x1
 * @property double $y2
 * @property double $x2
 *
 * @property Document[] $documents
 * @property Album $album
 * @property PhotoDocument $photoDocument
 */
class PhotoDocumentFace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_document_face';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'photo_document_id', 'album_id'], 'required'],
            [['date'], 'safe'],
            [['photo_document_id', 'album_id'], 'integer'],
            [['x1', 'y2', 'x2'], 'number'],
            [['file_name'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['photo_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoDocument::className(), 'targetAttribute' => ['photo_document_id' => 'id']],
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
            'photo_document_id' => 'Photo Document ID',
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
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['photo_document_face_id' => 'id']);
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
    public function getPhotoDocument()
    {
        return $this->hasOne(PhotoDocument::className(), ['id' => 'photo_document_id']);
    }
}
