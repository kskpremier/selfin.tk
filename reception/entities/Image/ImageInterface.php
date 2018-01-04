<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 12/13/17
 * Time: 10:53 PM
 */

namespace reception\entities\Image;

use reception\entities\Booking\Document;
use reception\entities\Face;
use yii\web\UploadedFile;

interface ImageInterface {

    public static function create(UploadedFile $file, $album_id = null, Document $document = null, $booking_id = null, $user_id = null);
    public function edit($size, $uploaded, $type, $dimensions, $facematika_id, $status, $altitude, $longitude, $latitude);
    public function delete();
//    public function getDetectedFaces();
    public function createFileForFace(Face $face, AbstractImage $parent);
    public static function createFaceImage(Face $face, $filename, $album_id = null, $document_id = null, $user_id = null);
    public function getFileName();
    public function getFilePath();

    public function putImageInAlbum($album_id);

}