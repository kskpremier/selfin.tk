<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\dispatchers\EventDispatcher;
use reception\entities\Booking\Booking;
use reception\entities\Booking\Document;
use reception\entities\Booking\Registration;

use reception\repositories\NotFoundException;
use function verify;


class RegistrationRepository
{   private $dispatcher;

    public function __construct(EventDispatcher $dispatcher) {
    $this->dispatcher = $dispatcher;
    }

    public function get($id): Registration
    {
        if (!$registration = Registration::findOne($id)) {
            throw new NotFoundException('Registration is not found.');
        }
        return $registration;
    }

    public function findByMyRentId($id){
        if (!$registration = Registration::find()->where(['external_id'=>$id])->one()) {
           return false;// throw new NotFoundException('Registration is not found.');
        }
        return $registration;
    }

    public function getByBookingDocument(Booking $booking, Document $document): Registration
    {
        if (!$registration = Registration::find()->where(['booking_id'=>$booking->id,'document_id'=>$document->id])->one()) {
            throw new NotFoundException('Registration is not found.');
        }
        return $registration;
    }

    public function isRegistrationExist($external_id, $from, $to, $time_from, $time_to, $registration, $guest, $booking)
    {
        if ($registration = Registration::findOne(['external_id'=>$external_id,'date_from' => $from,'date_to'=>$to,'time_from'=>$time_from,'time_to'=>$time_to, 'document_id'=>$registration,
            'booking_id'=>$booking,
            'guest_id'=>$guest,
            ])) {
            return $registration;
        }
        return false;
    }

    public function save(Registration $registration): void
    {
        if (!$registration->save()) {
            throw new \RuntimeException('Saving error.');
        }
        //return $registration;
       // $this->dispatcher->dispatchAll($registration->releaseEvents());
    }

    public function remove(Registration $registration): void
    {
        if (!$registration->delete()) {
            throw new \RuntimeException('Removing error.');
        }
     //   $this->dispatcher->dispatchAll($registration->releaseEvents());
    }

    public function removeById(int $id): void
    {
        $registration = $this->get ($id);
        if ($registration) {
            if (!$registration->delete()) {
                throw new \RuntimeException('Removing error.');
            }
        }
    }

}