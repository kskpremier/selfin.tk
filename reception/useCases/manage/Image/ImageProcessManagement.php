<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/7/17
 * Time: 3:00 PM
 */


namespace reception\useCases\manage\Image;

use reception\entities\Booking\events\DocumentBadFaceMatching;
use reception\entities\Image\AbstractImage;
use reception\entities\Booking\Document;
use reception\entities\Booking\FaceComparation;
use reception\entities\EventTrait;
use reception\entities\Face;
use reception\entities\Image\ImageCollection;
use reception\forms\GuestPhotoAddForm;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\DocumentRepository;
use reception\repositories\Booking\FaceComparationRepository;
use reception\repositories\Booking\FaceRepository;
use yii\base\ErrorHandler;
use reception\services\Facematica\FacematicaService;


/**
 * @property AbstractImageRepository $imageRepository
 * @property AbstractImageRepository $faceRepository
 * @property AbstractImageRepository $comparationRepository
 *
 */
class ImageProcessManagement

{
    /**
     *
     */
    public const LOWEST_PROBABILITY = 0.9;

    use EventTrait;

    /**
     * @var AbstractImageRepository
     */
    private $imageRepository;
    /**
     * @var FaceRepository
     */
    private $faceRepository;
    /**
     * @var FaceComparationRepository
     */
    private $comparationRepository;

    private $documentRepository;

    private $errorHandler;

    public function __construct(AbstractImageRepository $imageRepository, FaceRepository $faceRepository, FaceComparationRepository $comparationRepository,
                                DocumentRepository $documentRepository, ErrorHandler $errorHandler )
    {
        $this->imageRepository = $imageRepository;
        $this->faceRepository = $faceRepository;
        $this->comparationRepository = $comparationRepository;
        $this->documentRepository = $documentRepository;
        $this->errorHandler = $errorHandler;

    }
/*
 * Кейс для обработки изображений, присланных вместе с документом
 * 1. Распознаем все изображения самого документа
 * 2. Если есть фото - под них соответственно создаются все Faces
 * 3. Распознаем фото с селфи
 * 4. Производим сравнение фото из документа с фото из селфи
 */

    /**
     * @param Document $document
     * @param $array
     * @return array
     * @throws ServerErrorHttpException
     */
    public function processDocumentImages(Document $document, $array=null) {
        //выделить лицо с фото документа
        //выделить лицо с селфи
        //сравнить лица
        //записать результат сравнения
        $selfyFaces=[]; $faces=[]; $probability[]=0;
        try {
            foreach ($document->selfys as $selfy) {
                $selfyFaces = $this->getDetectedFaces($selfy);
            }
            foreach ($document->documentImages as $image) {
                $faces = $this->getDetectedFaces($image);
            }
            foreach ($faces as $targetFace) {
                $comparations = $targetFace->faceMatch($selfyFaces);
                foreach ($comparations as $comparation ) {
                    $this->comparationRepository->save($comparation);
                    $probability[] = $comparation->probability;
                }
            }
        } catch (\Exception $e) {
          $this->errorHandler->logException($e);
        }
        $maxProbability = max($probability);
        $document->maxprobability =  $maxProbability;
        if ($maxProbability < self::LOWEST_PROBABILITY) {
            $document->recordEvent(new DocumentBadFaceMatching($document, $maxProbability));
        }
        $this->documentRepository->save($document);
        return $maxProbability;
    }

    /**
     * Кейс для обработки изображений, поступающих с камеры
     * 1. Распознаем все изображения
     * 2. Если есть фото - под них соответственно создаются все Faces
     * 3. Распознаем фото с селфи
     * 4. Производим сравнение фото из документа с фото из селфи
     */

//    public function processRowImages(ImageCollection $images) {
//        //выделить лицо с каждого имиджа
//        //выделить лицо с селфи
//        //сравнить лица
//        //записать результат сравнения
////        foreach ($document->selfy as $selfy) {
////            $selfyFaces[] = $selfy->recognize();
////            $this->imageRepository->save($selfy);
////        }
////        foreach ($document->images as $image) {
////            $faces[] = $image->recognize();
////            $this->imageRepository->save($image);
////        }
////        foreach ($selfyFaces as $originFace){
////            foreach ($faces as $targetFace){
////                $comparation = $originFace->compareWith($targetFace);
////                $this->comparationRepository->save($comparation);
////                $probability [$originFace->id][$targetFace->id] = $comparation->probability;
////            }
////        }
////        $maxProbability = max($probability);
////        if ($maxProbability < self::LOWEST_PROBABILITY) {
////            $document->recordEvent(new DocumentBadFaceMatching($document, $maxProbability));
////            return $probability;
////        }
////        return $probability;
//    }

    /**
     * Making recognition of image for face detecting
     * If some faces detected - create ne Face instance and ne Image instance for earch

     * @param AbstractImage $image
     * @return array|\reception\entities\ActiveQuery
     */
    public function getDetectedFaces(AbstractImage $image) {
        $faces=$image->faces;
        $files[]=$image->getFileName();
        if (!$image->isRecognized()) {
            $response = FacematicaService::faceDetect($files);
            if ($response->getIsOk()) {
                $data = json_decode($response->content, true);
                try {
                    foreach ($files as $file) {
                        $form = $data[pathinfo($file)['filename']];
                        $image->edit($form['size'], $form['uploaded'], $form['type'], $form['dimensions'], $form['id'], AbstractImage::STATUS_RECOGNIZED, 0, 0, 0);
                        foreach ($form['faces'] as $face) {
                            $newFile=null;$newFace=null;
                            //Делаем заготовку для Image лица
                            $imageForFace = AbstractImage::createFaceImage($newFace, $newFile, AbstractImage::ALBUM_FACES, $image->document_id, $image->user_id);
                            //Делаем заготовку для лица
                            $newFace = Face::create($face['faceid'], $face['faceid'] . '.jpg', $face['coordinates']['x'], $face['coordinates']['y'], $face['coordinates']['width'], $face['coordinates']['angle'],
                                                    $image->document_id, $image->id);
                            if (isset($newFace) && isset($imageForFace)) {
                                $imageForFace->file_name = $newFace->face_id.".jpg";
                                $this->imageRepository->save($imageForFace);
                                $newFace->picture_id = $imageForFace->id;
                                $this->faceRepository->save($newFace);
                                //записываем файл изображения лица
                                $newFile = $imageForFace->createFileForFace($newFace,$image);
                                $faces[] = $newFace;
                            }
                            else throw new \DomainException('Could not create file for face =>' . $newFace->face_id);
                            //вопрос - надо ли теперь распознавать это лицо и ставить его в альбом????
                        }
                    }
                } catch (\Exception $e) {
                    $this->errorHandler->logException($e);
                }
                $image->status = AbstractImage::STATUS_RECOGNIZED;
                //$image->putImageInAlbum(self::ALBUM_RECOGNIZED);
                $image->faces = $faces;
            } else {
                $image->status = AbstractImage::STATUS_ERROR;
                $this->imageRepository->save($image);
                throw new ServerErrorHttpException('Wrong result of face recognition =>' . $response);
            }
            $this->imageRepository->save($image);
        }
        return (!count($faces))?  [] : $faces;
    }


}