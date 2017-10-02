<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:49
 */



namespace reception\useCases\manage\Booking;

use reception\entities\Apartment\Apartment;
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

    public function create($form,$needToSendConfirmationLetter=null, $needToMakeUser=null, $needToMakeKeyboardPassword=null): Booking
    {
        $needToSendConfirmationLetter = ($needToSendConfirmationLetter==null)?false:$needToSendConfirmationLetter;

        $needToMakeUser = ($needToMakeUser==null)?false:$needToMakeUser;
        $user = null;
        if ($needToMakeUser) {
            //сначала проверяем - есть ли юзер
            $user = User::findByEmail($form->contactEmail);
            if (isset($user) && $user->email === "info@my-rent.net") {
                $user = User::create(
                    strtolower(str_replace(" ", "_", trim($form->firstName))),
                    strtolower("mail_" . User::generatePassword(6) . "_") . $form->contactEmail, //генерим "случайный" адрес
                    $form->externalId //пароль - это значение номера букинга
                );
                $needToSendConfirmationLetter = false;
            } elseif (!isset($user)) {
                $password = User::generatePassword(6);
                $user = User::create(
                    $form->secondName . '_' . $form->firstName,
                    ($form->contactEmail)?$form->contactEmail:$password."@test.test",
                    $password //пароль - это случайная строка
                );
            }
        }
        $author = null;
        if( $form->firstName|| $form->secondName|| $form->contactEmail) {
            //теперь проверяем был ли такой автор заявки на букинг и делаем для него запись
            $author = Guest::create(
                ($form->firstName) ? $form->firstName : "",
                ($form->secondName) ? $form->secondName : "",
                (!$form->contactEmail) ? (($user == null) ? '' : $user->email) : $form->contactEmail,
                $user
            );
        }
            //если в заявке есть список гостей - их надо добавить в список гостей букинга
        $guestList = ($form->guests->isEmpty())?  $author : Guest::createGuestList($form->guests);
        //ищем, есть ли такие апартаменты
        $apartment = Apartment::find()->where(['external_id'=>$form->externalApartmentId])->one();
        if (!isset($apartment)){
            $apartment = Apartment::create("",$form->apartmentName,$form->externalApartmentId,$form->owner);
        }
        //ищем , есть ли уже такой букинг

        $booking = $this->bookingRepository->isBookingExist($form->externalId, $form->startDate, $form->endDate, $form->status, $apartment->id) ;
        if (!$booking) {
            $booking = Booking::create(
                $form->startDate,
                $form->endDate,
                $apartment, //$form->getApartmentId(), //договариваемся, что апартаменты с таким  ID должны быть
                $author,
                $form->numberOfTourist,
                $form->externalId,
                Booking::STATUS_ACTIVE, //$form->status,
                $guestList
            );
        }
        else {
            $booking->guests = $guestList;
        }
        $this->bookingRepository->save($booking);
        if ($needToMakeKeyboardPassword) {
             $this->generateKeyboardPwdForBooking($booking);
        }
        if($needToSendConfirmationLetter) {
            $booking->sendEmail($form->contactEmail, $password);
        }
        return $booking;
    }
    
    public function generateKeyboardPwdForBooking($booking) {
        foreach ($booking->apartment->doorLocks as $doorLock) {
            $keyboardPwd = KeyboardPwd::create(
                strtotime($booking->start_date),
                strtotime($booking->end_date), //ключ на весь период действия букинга
                TTLHelper::TTL_KEYBOARD_PERIOD_TYPE,
                4,//пока так, потом из модели $doorLock->keyboard_pwd_version,

                $doorLock->id,
                $booking->id
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