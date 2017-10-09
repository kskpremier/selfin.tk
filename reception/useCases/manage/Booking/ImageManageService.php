<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/7/17
 * Time: 3:00 PM
 */


namespace reception\useCases\manage\Booking;

use reception\entities\AbstractImage;
use reception\forms\GuestPhotoAddForm;
use reception\repositories\Booking\AbstractImageRepository;


/**
 * @property AbstractImageRepository $imageRepository
 *
 */
abstract class ImageManageService
{
    protected $imageRepository;

    public function __construct(AbstractImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;

    }
    abstract public function create($form): AbstractImage;

    abstract public function update(AbstractImage $photo, $form): AbstractImage;

    public function extractFaces(AbstractImage $image){
        if (!$image->status) {
            $faces = $image->extractFace();
            $image->faces = $faces;
            return ($this->imageRepository->save($image));
        }
        return true;
    }


}
