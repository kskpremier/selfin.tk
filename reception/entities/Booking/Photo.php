<?php

namespace reception\entities\Booking;

use reception\entities\Face;
use reception\entities\AbstractImage;
use reception\entities\ImageInterface;
use reception\services\WaterMarker;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use reception\entities\User\User;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * @property integer  $booking_id
 * @property Album $album
 * @property PhotoRealFace[] $photoRealFaces
 * @property Booking $booking
 *
 * @mixin ImageUploadBehavior
 */
class Photo  extends AbstractImage
{
    //public $booking_id;

    public static function create(UploadedFile $file, $album_id=null, $booking=null, $user_id=null): self
    {
        $photo = new static();
        $photo->file_name =  $file;
        $photo->booking_id = $booking->id;
        $photo->user_id =  $user_id;
        $photo->date = date("Y-m-d H:i",time());
        $photo->album_id = $album_id;

        return $photo;

    }

    public function edit(AbstractImage $photo, $album_id=null, $booking=null, $user_id=null, $size, $uploaded, $type, $dimensions, $facematika_id, $status, $altitude, $longitude, $latitude ): self
    {
        $photo->booking_id = $booking->id;
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

//    public function extractFace() : array //
//    {
//        parent::extractFace();
//    }
    public static function tableName(): string
    {
        return '{{%photo_image}}';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaces()
    {
        return $this->hasMany(Face::className(), ['photo_image_id' => 'id']);
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(),[
                    [   'class' => ImageUploadBehavior::className(),
                        'attribute' => 'file_name',
                        'createThumbsOnRequest' => true,
                        'filePath' => '@imagePath/[[attribute_album_id]]/[[attribute_booking_id]]/[[id]].[[extension]]',
                        'fileUrl' => '@imageUrl/[[attribute_album_id]]/[[attribute_booking_id]]/[[id]].[[extension]]',
                        'thumbPath' => '@imagePath/cache/[[attribute_album_id]]/[[attribute_booking_id]]/[[profile]]_[[id]].[[extension]]',
                        'thumbUrl' => '@imageUrl/cache/[[attribute_album_id]]/[[attribute_booking_id]]/[[profile]]_[[id]].[[extension]]',
                        'thumbs' => [
                            'thumb' => ['width' => 150, 'height' => 100],
                        ],
                    ],
        ]);
    }
    public function getFileName(){
         return Yii::getAlias('@imagePath') . '/' . $this->album_id. '/'.$this->booking_id .'/'. $this->id. '.jpg';
    }
    public function getFilePath(){
        return Yii::getAlias('@imagePath') . '/' . $this->album_id. '/'.$this->booking_id .'/';
    }
}