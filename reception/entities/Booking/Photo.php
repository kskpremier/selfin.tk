<?php

namespace reception\entities\Booking;

use reception\services\WaterMarker;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use reception\entities\User\User;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property string   $file
 * @property integer  $sort
 * @property integer  $id
 * @property string   $date
 * @property integer  $camera_id
 * @property integer  $album_id
 * @property string   $file_name
 * @property integer  $booking_id
 * @property integer  $user_id
 * @property integer  $size
 * @property string   $uploaded
 * @property string   $type
 * @property string   $dimensions
 * @property string   $facematika_id
 * @property integer  $status
 * @property double   $altitude
 * @property double   $longitude
 * @property double   $latitude
 *
 * @property Album $album
 * @property PhotoRealFace[] $photoRealFaces
 * @property Booking $booking
 *
 * @mixin ImageUploadBehavior
 */
class Photo extends ActiveRecord
{
    const ALBUM_REAL_IMAGES = 2;

    public static function create($file, $album_id, $booking_id, $user_id): self
    {
        $photo = new static();
        $photo->file_name =  $file;
        $photo->booking_id = $booking_id;
        $photo->user_id =  $user_id;
        $photo->date = date("Y-m-d H:i",time());
        $photo->album_id = $album_id;

        return $photo;

    }

    public function edit(Photo $photo, $album_id, $booking_id, $user_id, $size, $uploaded, $type, $dimensions, $facematika_id, $status, $altitude, $longitude, $latitude ): self
    {
        $photo->booking_id = $booking_id;
        $photo->user_id =  $user_id;
        $photo->date = date("Y-m-d H:i",time());
        $photo->album_id = $album_id;
        $photo->booking_id =  $booking_id;
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
        return '{{%photo_image}}';
    }

    public function behaviors(): array
    {
        return [
                    [
                        'class' => ImageUploadBehavior::className(),
                        'attribute' => 'file_name',
                        'createThumbsOnRequest' => true,

                        'filePath' => '@documentPath/[[attribute_album_id]]/[[attribute_booking_id]]/[[id]].[[extension]]',
                        'fileUrl' => '@documentUrl/[[attribute_album_id]]/[[attribute_booking_id]]/[[id]].[[extension]]',
                        'thumbPath' => '@documentPath/cache/[[attribute_album_id]]/[[attribute_booking_id]]/[[profile]]_[[id]].[[extension]]',
                        'thumbUrl' => '@documentUrl/cache/[[attribute_album_id]]/[[attribute_booking_id]]/[[profile]]_[[id]].[[extension]]',


                        'thumbs' => [
                            'thumb' => ['width' => 350, 'height' => 250],

                        ],

                    ],
        ];
    }
}