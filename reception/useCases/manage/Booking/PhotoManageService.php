<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 10:20
 */


namespace reception\useCases\manage\Booking;

use reception\entities\Booking\events\DocumentAddRequested;
use reception\entities\Image\AbstractImage;
use reception\entities\Booking\Photo;

use reception\forms\GuestPhotoForm;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\DocumentRepository;
use reception\useCases\manage\Image\ImageProcessManagement;


/**
 * @property AbstractImageRepository $imageRepository
 *
 */

class PhotoManageService
{
    private $photoRepository;
    private $documentRepository;
    private $processing;

    public function __construct(AbstractImageRepository $photoRepository, DocumentRepository $documentRepository, ImageProcessManagement $processing )
    {
        $this->photoRepository = $photoRepository;
        $this->documentRepository = $documentRepository;
        $this->processing = $processing;

    }

    public function create(GuestPhotoForm $form):array
    {
        $images=[];
        $document = $this->documentRepository->get($form->document_number);
        if ($document) {
            foreach ($form->SelfyForm->files as $image) {
                //Создаем Image
                $photo = AbstractImage::create($image, AbstractImage:: ALBUM_IMAGES, $document, $form->booking_id, $form->user_id);
                //Распознаем лица на имадже
                $this->photoRepository->save($photo);
                $this->processing->getDetectedFaces($photo);

                $images[] = $photo;
            }
            //Генерируем событие о том, что создано дополнительное фото к документу
            $document->recordEvent(new DocumentAddRequested($document, null, $form->SelfyForm));
            $this->documentRepository->save($document);
        }
        else {
            throw new \DomainException("Document with such number was not found");
        }
        return $images;
    }

    public function update(AbstractImage $photo, $form): AbstractImage
    {
        $photo ->edit($photo,
            AbstractImage::ALBUM_REAL_IMAGES,
                        $form->booking->id,
                        $form->user_id,
                        $form->size,
                        $form->uploaded,
                        $form->type,
                        $form->dimensions,
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
    