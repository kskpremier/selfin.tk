<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\entities\Booking\Photo;
use reception\repositories\NotFoundException;

class PhotoRepository
{
    public function get($id): Photo
    {
        if (!$photo = Photo::findOne($id)) {
            throw new NotFoundException('Photo is not found.');
        }
        return $photo;
    }


    public function save(Photo $photo): void
    {
        if (!$photo->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Photo $photo): void
    {
        if (!$photo->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}