<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/5/17
 * Time: 9:14 AM
 */

namespace reception\entities;

use reception\entities\Booking\Booking;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is common Interface for any image (real photos or document photos)
 *
 * @mixin ImageUploadBehavior
 */
Interface ImageInterface
{
    const ALBUM_REAL_IMAGES = 2;
    const ALBUM_DOCUMENT_IMAGES = 3;

    const IMAGE_RECOGNIZED = 10;
    const IMAGE_RAW = 0;


    public static function create(UploadedFile $file, $album_id, $booking_id, $user_id);

    public function edit(AbstractImage $photo, $album_id, $booking_id, $user_id, $size, $uploaded, $type, $dimensions, $facematika_id, $status, $altitude, $longitude, $latitude );

    public function extractFace():array;

    public function detectFace(string $filename);

    public function faceMatch(array $listOfFaces);

    //public function recognize(self $image);
}