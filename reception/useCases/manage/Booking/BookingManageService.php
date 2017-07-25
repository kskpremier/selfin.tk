<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:49
 */



namespace reception\useCases\manage\Booking;

use reception\entities\Booking\Booking;
use reception\entities\Booking\Guest;
use reception\forms\BookingForm;
use reception\helpers\TTLHelper;
use reception\repositories\Booking\BookingRepository;
use reception\entities\DoorLock\KeyboardPwd;
use reception\useCases\BusinessException;

use reception\entities\User\User;
use reception\useCases\manage\TTL\TTL;
use yii\web\ServerErrorHttpException;


class BookingManageService
{
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function create(BookingForm $form): Booking
    {
        if ($booking = $this->bookingRepository->isBookingExist($form->externalId, $form->startDate, $form->endDate, $form->apartmentId)){
            return $booking;
        }
        else {
            //сначала проверяем - есть ли юзер
            $user = User::findByEmail($form->contactEmail);
            if (!isset($user)){
                $password = User::generatePassword(6);
                $user= User::create(
                    $form->secondName.'_'.$form->firstName,
                    $form->contactEmail,
                    $password
                );
            }
            //теперь проверяем был ли такой автор заявки на букинг
            $author = Guest::create(
                $form->firstName,
                $form->secondName,
                $form->contactEmail,
                $user
            );

            $booking = Booking::create(
                $form->startDate,
                $form->endDate,
                $form->getApartmentId(), //договариваемся, что апартаменты с таким  ID должны быть
                $author,
                $form->numberOfTourist,
                $form->externalId,
                $form->status
            );

            $this->bookingRepository->save($booking);
            $this->generateKeyboardPwdForBooking($booking);
            return $booking;
        }

    }
    
    public function generateKeyboardPwdForBooking($booking) {
        foreach ($booking->apartment->doorLocks as $doorLock) {
            $keyboardPwd = KeyboardPwd::create(
                strtotime($booking->start_date),
                strtotime($booking->end_date), //ключ на весь период действия букинга
                TTLHelper::TTL_KEYBOARD_PERIOD_TYPE,
                4,//пока так, потом из модели $doorLock->keyboard_pwd_version,
                $booking->id,
                $doorLock->id
            );
            //получаем значение с китайского сервера для этого замка
            $data = json_decode($keyboardPwd->getKeyboardPwdFromChina(), true);
            //проверяем, что ответ корректен
            if (!is_array($data) || !$data['success']) {
                throw new BusinessException('Can not get keyboard password for this door lock identity: ' . $doorLock->id);
            }
        }
    }

}