<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:41
 */

namespace reception\useCases\manage\DoorLock;

use reception\entities\DoorLock\Key;
use backend\models\Booking;
use reception\forms\KeyForm;
use reception\forms\KeyForBookingForm;
use reception\repositories\DoorLock\KeyRepository;
use reception\useCases\BusinessException;


class KeyManageService
{
    private $keyRepository;
    public function __construct(KeyRepository $keyRepository)
    {
        $this->keyRepository = $keyRepository;

    }
    public function generate(KeyForm $form): Key
    {
        $key = Key::create(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->bookingId,
            $form->doorLockId,
            $form->userId,
            $form->remarks
        );

        $this->keyRepository->save($key);
        return $key;
    }
    public function edit(KeyEditForm $form): void
    {
        $key = Key::edit(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->bookingId,
            $form->doorLockId,
            $form->userId,
            $form->remarks,
            $form->lastUpdateDate,
            $form->keyStatus,
            $form->keyId
        );
        $this->keyRepository->save($key);
    }
    public function generateForBooking(KeyForBookingForm $form): array
    {   $booking = Booking::findOne(['external_id'=>$form->bookingId]);
        if (!isset($booking))
            throw new BusinessException("Not found any booking with such Id");
        foreach($booking->apartment->doorLocks as $doorLock) {
            $key = Key::create(
                ($form->startDate) ? strtotime($form->startDate) : strtotime($booking->start_date),
                ($form->endDate) ? strtotime($form->endDate) : strtotime($booking->end_date),
                ($form->type) ? $form->type : 0,
                $booking->id,
                $doorLock->id,
                $booking->author->user->id,
                $form->remarks
            );
            $this->keyRepository->save($key);
            $result[]=$key->id;
        }
        return $result;
    }
}