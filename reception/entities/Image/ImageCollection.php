<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 12/14/17
 * Time: 3:21 PM
 */
namespace reception\entities\Image;


class ImageCollection
{
    private $images;

    public function __construct(array $images )
    {
        $this->images = $images;
    }

}