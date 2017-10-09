<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/4/17
 * Time: 10:14 PM
 */


namespace reception\useCases\manage\Booking;

use reception\entities\Booking\FaceComparation;
use reception\entities\Booking\Photo;
use reception\entities\Booking\Booking;
use reception\forms\FaceComparationForm;
use reception\repositories\Booking\FaceComparationRepository;
use reception\repositories\Booking\FaceRepository;


/**
 * @property FaceRepository $faceRepository
 *
 */

class FaceComparationManageService
{
    private $faceComparationRepository;

    public function __construct(FaceComparationRepository $faceComparationRepository)
    {
        $this->faceComparationRepository = $faceComparationRepository;

    }
    public function create($origin_id,$foto_id,$probability): FaceComparation
    {
        $faceComparation = FaceComparation::create($origin_id,$foto_id,$probability);
        $this->faceComparationRepository->save($faceComparation);

        return $faceComparation;
    }
    public function update(FaceComparation $faceComparation,$origin_id,$foto_id,$probability): FaceComparation
    {
        $faceComparation ->edit( $origin_id,$foto_id,$probability);
        $this->faceComparationRepository->save($faceComparation);
        return $faceComparation;
    }

    //делает сравнение лица оригинала и лиц с других фотографий
    //возвращает  id лица с наибольшим значением вероятности сравнения

    public function getPhoto(ImageInterface $image, Booking $booking) {
        foreach ($image->faces as $face){
            $face_id = $face->faceComparation->getMaximumProbability();

        }
    }


}
