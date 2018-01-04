<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/7/17
 * Time: 2:58 PM
 */
namespace reception\repositories\Booking;

use reception\entities\Image\AbstractImage;

use reception\entities\Image\ImageInterface;
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

    public function save(ImageInterface $image)
    {
        if (!$image->save()) {
            throw new \RuntimeException('Saving error.');
        }
        return true;
    }

    public function remove(ImageInterface $image): void
    {
        if (!$image->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}