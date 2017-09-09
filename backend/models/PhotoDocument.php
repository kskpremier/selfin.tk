<?php

namespace backend\models;

use Yii;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "photo_document".
 *
 * @property integer $id
 * @property string $date

 * @property string $file_name
 * @property integer $album_id
 *
 * @property Document[] $documents
 * @property Album $album

 * @property PhotoDocumentFace[] $photoDocumentFaces
 */
class PhotoDocument extends \yii\db\ActiveRecord
{
    public $file;
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

           // [['file_name'], 'file'],
           // [['file_name'], 'string', 'max' => 255],
            ['file_name', 'file', 'extensions' => 'jpeg, gif, png, jpg'],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['document_id' => 'id']],
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
            'document_id'=>'Document ID',
            'file_name' => 'File Name',
            'album_id' => 'Album ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne( Document::className(), ['id' => 'document_id']);
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
    public function getPhotoDocumentFaces()
    {
        return $this->hasMany(PhotoDocumentFace::className(), ['photo_document_id' => 'id']);
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file_name',
                'createThumbsOnRequest' => true,

                'filePath' => '@documentPath/[[attribute_album_id]]/[[attribute_document_id]]/[[id]].[[extension]]',
                'fileUrl' => '@documentUrl/[[attribute_album_id]]/[[attribute_document_id]]/[[id]].[[extension]]',
                'thumbPath' => '@documentPath/cache/[[attribute_album_id]]/[[attribute_document_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@documentUrl/cache/[[attribute_album_id]]/[[attribute_document_id]]/[[profile]]_[[id]].[[extension]]',


                'thumbs' => [
                    'thumb' => ['width' => 120, 'height' => 48],

                ],
            ],
        ];
    }
}
