<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:36
 */


namespace reception\repositories\Booking;

use reception\entities\Booking\Booking;
use reception\repositories\NotFoundException;

class BookingRepository
{
    public function get($id): Booking
    {
        if (!$booking = Booking::findOne($id)) {
            throw new NotFoundException('Booking is not found.');
        }
        return $booking;
    }
    public function getByExternalId($externalId): Booking
    {
        if (!$booking = Booking::find()->where(['external_id'=>$externalId])->one()) {
            throw new NotFoundException('Booking is not found.');
        }
        return $booking;
    }
    public function isBookingExist($externalId, $startDate,$endDate,$status,$apartmentId)
    {
        if ($booking = Booking::find()->where([
                    'external_id' => $externalId,
                    'start_date'=>$startDate,
                    'end_date'=>$endDate,
                    'status'=>$status,
                    'apartment_id'=>$apartmentId
                    ])
//                    ->joinWith('apartment')
//                    ->andWhere( ['apartment.external_id'=>$externalApartmentId])
                    ->one()
            )
            return $booking;
        return false;
    }

    public function save(Booking $booking): void
    {
        if (!$booking->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Booking $booking): void
    {
        if (!$booking->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}