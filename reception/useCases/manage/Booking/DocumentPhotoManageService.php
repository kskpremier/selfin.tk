<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/7/17
 * Time: 4:07 PM
 */
namespace reception\useCases\manage\Booking;

use reception\entities\AbstractImage;
use reception\entities\Booking\DocumentPhoto;
//use reception\forms\GuestPhotoAddForm;
//use reception\forms\GuestPhotoForm;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\PhotoRepository;
use reception\useCases\manage\Booking\ImageManageService;


/**
 * @property AbstractImageRepository $imageRepository
 *
 */

class DocumentPhotoManageService extends ImageManageService
{
//    private $photoRepository;
//
//    public function __construct(PhotoRepository $photoRepository)
//    {
//        $this->photoRepository = $photoRepository;
//
//    }

    public function create($form): AbstractImage
    {
        foreach ($form->PhotosForm->files as $image) {

            $photo = DocumentPhoto::create($image, AbstractImage::ALBUM_DOCUMENT_IMAGES, $form->document, $form->user_id);
            $this->imageRepository->save($photo);
            $images[] = $photo;
        }
        return $photo;
    }

    public function update(AbstractImage $photo, $form): AbstractImage
    {
        $photo->edit($photo,
            AbstractImage::ALBUM_DOCUMENT_IMAGES,
            $form->document->id,
            $form->user_id,
            $form->size, $form->uploaded,
            $form->type, $form->dimensions,
            $form->facematika_id,
            $form->status,
            $form->altitude,
            $form->longitude,
            $form->latitude);
        $this->imageRepository->save($photo);
        return $photo;
    }
}