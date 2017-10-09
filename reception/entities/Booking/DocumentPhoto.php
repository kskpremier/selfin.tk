<?php

namespace reception\entities\Booking;

use backend\models\Album;
use reception\entities\AbstractImage;
use reception\entities\Face;
use reception\entities\ImageInterface;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use reception\entities\Booking\Document;
use Yii;

/**
 * @property integer $document_id
 *
 * @mixin ImageUploadBehavior
 */
class DocumentPhoto extends AbstractImage
{
   // public $document_id;

    public static function create(UploadedFile $file,  $album_id, $document_id, $user_id): self
    {
        $photo = new static();
        $photo->file_name =  $file;
        $photo->document_id = $document_id;
        $photo->date = date("Y-m-d H:i",time());
        $photo->album_id=$album_id;
        return $photo;
    }
    public function edit(AbstractImage $photo, $album_id, $document_id, $user_id, $size, $uploaded, $type, $dimensions, $facematika_id, $status, $altitude, $longitude, $latitude ): self
    {
        $photo->document_id = $document_id;
        $photo->user_id =  $user_id;
        $photo->date = date("Y-m-d H:i",time());
        $photo->album_id = $album_id;
        $photo->size =  $size;
        $photo->uploaded =  $uploaded;
        $photo->type =  $type;
        $photo->dimensions =  $dimensions;
        $photo->facematika_id =  $facematika_id;
        $photo->status =  $status;
        $photo->altitude =  $altitude;
        $photo->longitude =  $longitude;
        $photo->latitude =  $latitude;

        return $photo;
    }

    public static function tableName(): string
    {
        return '{{%photo_document}}';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaces()
    {
        return $this->hasMany(Face::className(), ['photo_document_id' => 'id']);
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [   'class' => ImageUploadBehavior::className(),
                'attribute' => 'file_name',
                'createThumbsOnRequest' => true,
                'filePath' => '@documentPath/[[attribute_album_id]]/[[attribute_document_id]]/[[id]].[[extension]]',
                'fileUrl' => '@documentUrl/[[attribute_album_id]]/[[attribute_document_id]]/[[id]].[[extension]]',
                'thumbPath' => '@documentPath/cache/[[attribute_album_id]]/[[attribute_document_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@documentUrl/cache/[[attribute_album_id]]/[[attribute_document_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'thumb' => ['width' => 350, 'height' => 250],
                ],
            ]
        ]);
    }
    public function getFilePath(){
        return Yii::getAlias('@documentPath') . '/' . $this->album_id. '/'.$this->document_id .'/'. $this->id. '.jpg';
    }
    public function getFileName(){
        return Yii::getAlias('@documentPath') . '/' . $this->album_id. '/'.$this->document_id .'/'. $this->id. '.jpg';
    }


}