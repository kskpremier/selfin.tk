<?php

namespace reception\listeners\Booking;


use reception\entities\Booking\events\DocumentAddRequested;
use reception\entities\EventTrait;
use reception\entities\Image\AbstractImage;
use reception\repositories\Booking\DocumentRepository;
use reception\repositories\Booking\FaceRepository;


class DocumentAddListener
{
    use EventTrait;

    private $service;
    private $documentRepository;
    private $faceRepository;

    public function __construct(ImageProcessingManagment $service, DocumentRepository $documentRepository, FaceRepository $faceRepository)
    {

        $this->service = $service;
        $this->documentRepository = $documentRepository;
        $this->faceRepository = $faceRepository;
    }

    public function handle(DocumentAddRequested $event): void
{
    //обработка и добавление фотографий
    if (isset($event->PhotosForm)) {
        foreach ($event->PhotosForm->files as $photoDoc) {
            $image = AbstractImage::create($photoDoc, AbstractImage::ALBUM_DOCUMENT, $event->document);
            $this->imageRepository->save($image);
            $facesFromDoc = $this->service->getDetectedFaces($image);
        }
    }
    if (isset($event->SelfyForm)) {
        foreach ($event->SelfyForm->files as $image) {
            $image = AbstractImage::create($photoDoc, AbstractImage::ALBUM_IMAGES, $event->document);
            $this->imageRepository->save($image);
            $facesFromSelfy = $this->service->getDetectedFaces($image);

        }
    }
    $array=$this->documentRepository->isDocumentReadyForMatching($event->document);
    if (!isEmpty($array["doc"])&&!isEmpty($array["face"]))
        $this->service->processDocumentImages($event->document, $array);
}
}