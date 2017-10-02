<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 10:20
 */


namespace reception\useCases\manage\Booking;

use reception\entities\Booking\Photo;
use reception\forms\GuestPhotoAddForm;
use reception\forms\GuestPhotoForm;
use reception\repositories\Booking\PhotoRepository;

use reception\entities\Booking\PhotoPhoto;

/**
 * @property PhotoRepository $photoRepository
 *
 */

class PhotoManageService
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;

    }

    public function create(GuestPhotoForm $form): Photo
    {
        foreach ($form->PhotosForm->files as $image) {

            $photo = Photo::create($image, Photo::ALBUM_REAL_IMAGES, $form->booking_id, $form->user_id);
            $this->photoRepository->save($photo);
            $images[]=$photo;
        }
        return $photo;
    }

    public function update(Photo $photo, GuestPhotoForm $form): Photo
    {
        $photo ->edit($photo,
                        Photo::ALBUM_REAL_IMAGES,
                        $form->booking_id,
                        $form->user_id,
                        $form->size,$form->uploaded,
                        $form->type,$form->dimensions,
                        $form->facematika_id,
                        $form->status,
                        $form->altitude,
                        $form->longitude,
                        $form->latitude);
        $this->photoRepository->save($photo);
        return $photo;
    }

   
}
    