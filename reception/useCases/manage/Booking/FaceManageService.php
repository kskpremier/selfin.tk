<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/4/17
 * Time: 10:14 PM
 */


namespace reception\useCases\manage\Booking;

use backend\service\Draw;
use reception\entities\FaceInterface;
use reception\entities\Booking\Photo;
use reception\entities\Booking\Booking;
use reception\entities\ImageInterface;
use reception\forms\FaceForm;
use reception\repositories\Booking\FaceRepository;


/**
 * @property FaceRepository $faceRepository
 *
 */

class FaceManageService
{
    private $faceRepository;

    public function __construct(FaceRepository $faceRepository)
    {
        $this->faceRepository = $faceRepository;

    }
    public function create(FaceForm $form): FaceInterface
    {
            $face = FaceInterface::create(
                $form->face_id, $form->x, $form->y, $form->width, $form->angle, $form->image->id);
            $this->faceRepository->save($face);

        return $face;
    }
    public function update(FaceInterface $face, FaceForm $form): FaceInterface
    {
        $face ->edit( $face,
            $form->face_id,
            $form->x,
            $form->y,
            $form->width,
            $form->angle,
            $form->image->id);
        $this->faceRepository->save($face);
        return $face;
    }

    /**
     * Шлет фотографию в сервис распознавания
     * Назад получает список распознанных лиц на фотографии
     * и добавляет их в базу данных

     * также пытается нарисовать на фото красную линию между выделенными глазами

     * @return integer (photoImage->id) that get in constructor
     **/
    public function faceDetect(ImageInterface $photoImage) {

    }

    public function compareFaces($booking, $face)
    {
        $documentFaceList = [];
        $imageFaceList = [];
        //выполняем распознавание всех лиц с реальных фото, заносим их в $imageFaceList[]
        foreach ($booking->photoImages as $image)
            $imageFaceList = array_merge($imageFaceList,$image->extractFace());
        //выполняем detect всех лиц с документов туристов, заносим их в $documentFaceList[]
        foreach ($booking->guests as $guest)
            foreach ($guest->documents as $document)
                foreach ($document->images as $documentPhoto) {
                    $documentFaceList = array_merge($documentFaceList,$documentPhoto->extractFace());
                    foreach ($documentFaceList as $documentFace) {
                        //выполняем сравнение и поиск наиболее подходящей фото для фото с паспорта
                        $matchedPhoto = $documentFace->faceMatch($imageFaceList);
                        $this->faceRepository->save($documentFace);
                    }
                }
    }

    public function analyzingResultOfComparing($booking, $face)
    {
        $notMatchedDocumentList=[];
        foreach ($booking->guests as $guest)
            foreach ($guest->documents as $document)
                foreach ($document->images as $documentPhoto)
                    if (($p=$documentPhoto->getTheMostSimilarFaceComparationProbability()) < Booking::BOOKING_RECOCNITION_LOWREST_PROBABILITY){
                        $notMatchedDocumentList[] = [$documentPhoto,$p];
                    }
        return $notMatchedDocumentList;
    }


}
    