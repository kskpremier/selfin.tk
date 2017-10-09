<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\entities\Booking\Booking;
use reception\entities\Booking\FaceComparation;
use reception\repositories\NotFoundException;

class FaceComparationRepository
{
    public function get($origin_id, $face_id): FaceComparation
    {
        if (!$faceComparation = FaceComparation::findOne(['origin_id'=>$origin_id,'face_id'=>$face_id])) {
            throw new NotFoundException('FaceComparation is not found.');
        }
        return $faceComparation;
    }
    public function getByBooking(Booking $booking): array
    {   $set=[];

        foreach ($booking->guests as $guest)
            foreach ($guest->documents as $document)
                foreach($document->images as $documentImage)
                    foreach ($documentImage->faces as $documentImagesFace)
                        if ($max = $this->getMaximumComparation($documentImagesFace->id))
                            $set[]= $max;
        return $set;
    }
    // Return face_id with maximum value of probability or empty string
    public function getMaximumComparation($origin_id)
    {
        if (!$faceComparation = FaceComparation::find()->where(['origin_id'=>$origin_id])->orderBy(['probability'=> SORT_DESC])->all()) {
            throw new NotFoundException('FaceComparation is not found.');
        }
        foreach ($faceComparation as $comparation)
            if ($comparation->origin->face_id != $comparation->face_id)
                return $comparation;
        return null;

    }

    public function findMax($origin_id, $face_id)
    {
        $comparation = null;
        $comparation = FaceComparation::find()->where(['origin_id' => $origin_id])->andWhere(['not', ['face_id' => $face_id]])->orderBy(['probability'=> SORT_DESC])->one();
        if ($comparation) {
            return $comparation;
        }
        return null;
    }

    public function save(FaceComparation $faceComparation): void
    {
        if (!$faceComparation->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(FaceComparation $faceComparation): void
    {
        if (!$faceComparation->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}