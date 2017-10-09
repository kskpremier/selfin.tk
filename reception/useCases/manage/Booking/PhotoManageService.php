<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 10:20
 */


namespace reception\useCases\manage\Booking;

use reception\entities\AbstractImage;
use reception\entities\Booking\Photo;
//use reception\forms\GuestPhotoAddForm;
//use reception\forms\GuestPhotoForm;
//use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\AbstractImageRepository;


/**
 * @property AbstractImageRepository $imageRepository
 *
 */

class PhotoManageService extends ImageManageService
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

            $photo = Photo::create($image, Photo::ALBUM_REAL_IMAGES, $form->booking, $form->user_id);
            $this->imageRepository->save($photo);
            $images[]=$photo;
        }
        return $photo;
    }

    public function update(AbstractImage $photo, $form): AbstractImage
    {
        $photo ->edit($photo,
                        Photo::ALBUM_REAL_IMAGES,
                        $form->booking->id,
                        $form->user_id,
                        $form->size,$form->uploaded,
                        $form->type,$form->dimensions,
                        $form->facematika_id,
                        $form->status,
                        $form->altitude,
                        $form->longitude,
                        $form->latitude);
        $this->imageRepository->save($photo);
        return $photo;
    }
//
//    public function extractFaces(AbstractImage $image){
//        $faces = $image->extractFace();
//        $image->faces = $faces;
//        return ($this->photoRepository->save($image));
//    }

   
}
    