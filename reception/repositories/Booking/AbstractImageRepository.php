<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/7/17
 * Time: 2:58 PM
 */
namespace reception\repositories\Booking;

use reception\entities\AbstractImage;
use reception\entities\ImageInterface;
use reception\repositories\NotFoundException;

class AbstractImageRepository
{
    public function get($id): AbstractImage
    {
        if (!$photo = AbstractImage::findOne($id)) {
            throw new NotFoundException('Photo is not found.');
        }
        return $photo;
    }

    public function save(ImageInterface $photo)
    {
        if (!$photo->save()) {
            throw new \RuntimeException('Saving error.');
        }
        return true;
    }

    public function remove(ImageInterface $photo): void
    {
        if (!$photo->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}