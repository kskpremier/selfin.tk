<?php

namespace reception\entities\Booking;

//use shop\services\WaterMarker;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use reception\entities\Booking\Document;
use Yii;

/**
 * @property integer $id
 * @property string $file
 * @property integer $sort
 *
 * @mixin ImageUploadBehavior
 */
class DocumentPhoto extends ActiveRecord
{
    public static function create(UploadedFile $file, $documentId): self
    {
        $photo = new static();
        $photo->file_name = $file->name;
        $photo->document_id = $documentId;
        $photo->date = date("Y-m-d H:i",time());
        $photo->album_id=3; //оно вообще скорее всего не нужно это поле, но пока по умолчанию 3 -фото документов типа
        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%photo_document}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file_name',
                'createThumbsOnRequest' => true,
                'filePath' => Yii::getAlias('@documentPath').'/[[attribute_document_id]]/[[id]].[[extension]]',
                'fileUrl' => Yii::getAlias('@documentUrl').'/[[attribute_document_id]]/[[id]].[[extension]]',
                'thumbPath' => Yii::getAlias('@backend').'/cache/document_photos/[[attribute_document_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => Yii::getAlias('@backend').'/cache/document_photos/[[attribute_document_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'thumb' => ['width' => 120, 'height' => 48],

                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne( Document::className(), ['id' => 'document_id']);
    }
}