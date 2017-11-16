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
use reception\entities\Booking\FaceComparation;
use reception\entities\Booking\DocumentPhoto;
use reception\entities\Booking\Guest;
use reception\forms\BookingForm;
use reception\forms\MyRent\RentForm;
use reception\helpers\TTLHelper;
use reception\repositories\Apartment\ApartmentRepository;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\BookingRepository;
use reception\entities\DoorLock\KeyboardPwd;
use reception\repositories\Booking\FaceComparationRepository;
use reception\repositories\Booking\FaceRepository;
use reception\repositories\Booking\GuestRepository;
use reception\useCases\BusinessException;

use reception\entities\User\User;
use reception\useCases\manage\TTL\TTL;
use yii\web\ServerErrorHttpException;


class BookingManageService
{
    private $bookingRepository;
    private $imageRepository;
    private $faceRepository;
    private $faceCompareRepository;
    private $guestRepository;
    private $apartmentRepository;

    public function __construct(BookingRepository $bookingRepository,
                                AbstractImageRepository $imageRepository,
                                FaceRepository $faceRepository,
                                FaceComparationRepository $faceCompareRepository,
                                GuestRepository $guestRepository,
                                ApartmentRepository $apartmentRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->imageRepository = $imageRepository;
        $this->faceRepository = $faceRepository;
        $this->faceCompareRepository = $faceCompareRepository;
        $this->guestRepository = $guestRepository;
        $this->apartmentRepository = $apartmentRepository;
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
        if (!isset($apartment)) {
            $apartment = Apartment::create('',$form->name,$form->externalId,$form->owner,$form->latitude,$form->longitude, $form->city_name, $form->adress, $form->object_color,$form->guid,
                $form->user->user_id, '', $form->country, $form->doorlocks);
        }
        //ищем , есть ли уже такой букинг

        $booking = $this->bookingRepository->findByMyRentId($form->externalId);
        if (!$booking) {
            $booking = Booking::create(
               $form->startDate,$form->endDate,
               $apartment,
               $author,
               $form->numberOfGuest,$form->externalId,Booking::STATUS_ACTIVE,
               $guestList,
               $form->guid,$form->rent_status,$form->from_time,$form->until_time,$form->price,$form->exchange,
               $form->label,$form->price_local,$form->paid,$form->created,$form->changed);
        }
        else {
            $booking->edit($form->startDate,$form->endDate,$form->numberOfGuest,$form->status,
                $form->rent_status,$form->from_time,$form->until_time,$form->price,$form->exchange,
                $form->label,$form->price_local,$form->paid,$form->created,$form->changed=null);
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

    public function updateBookings(RentForm $form, $user_id, $updateTime, $owner_id=null)
    {

        if ($form->active ==="Y") {
            //ищем апартамент
            $apartment = $this->apartmentRepository->findByMyRentId($form->property->object_id);
            if (!$apartment)
                $apartment = Apartment::createProperty($form->property, $user_id, $updateTime, $owner_id);
            else $apartment->edit($form->property, $user_id, $updateTime, $owner_id);
            $this->apartmentRepository->save($apartment);
            //ищем автора
            $author = $this->guestRepository->findByMyRent($form->contact);
            if (!$author)
                $author = Guest::createContact($form->contact, $updateTime);
            else $author->updateContact($form->contact, $updateTime);
            $this->guestRepository->save($author);
            //букинг
            $booking = $this->bookingRepository->findByMyRentId($form->id);
            if (!$booking)
                $booking = Booking::createBooking($form, $updateTime, $apartment->id, $author->id);
            else $booking->edit($form, $updateTime, $apartment->id, $author->id);
            $this->bookingRepository->save($booking);
//            throw new \DomainException ('Failed to save booking object => ' . ($booking->external_id));
            return $booking;
        }
        elseif ($form->active ==="N"){
            //букинг ищем
            $booking = $this->bookingRepository->findByMyRentId($form->id);
            if ($booking) {
                $booking->deleteBooking($booking);
                $this->bookingRepository->save($booking);
                return $booking;
            }
        }
    }

    public function getGuestBooking($guestId) {
        return $this->bookingRepository->getByGuestId($guestId);
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

    /**
     * Making comparation all images from booking from one side with
     * all guest's document images from other side
     *
     * Return array of probabilities matching faces in compared sets
     * like this
     * [document_id][face_id]=0.97
     * [2][face-swbkozgnwkggcso]=>0,97,
     * [2][face-sz5r6zk78u804s4]=>0,64
     * @param $booking
     */

    public function compareFaces($booking)
    {
        $documentFaceList = [];
        $imageFaceList = [];
        $probabilityList =[[]];
        $comparation=[];
        //выполняем распознавание всех лиц с реальных фото, заносим их в $imageFaceList[]
        foreach ($booking->photoImages as $image) {
            $imageFaceList = array_merge($imageFaceList, $image->extractFace());
            $this->imageRepository->save($image);
        }
        //выполняем detect всех лиц с документов туристов, заносим их в $documentFaceList[]
        foreach ($booking->guests as $guest)
            foreach ($guest->documents as $document)
                foreach ($document->images as $documentPhoto) {
                    $documentFaceList = array_merge($documentFaceList,$documentPhoto->extractFace());
                    $this->imageRepository->save($documentPhoto);
                    foreach ($documentFaceList as $documentFace) {
                        //выполняем сравнение и поиск наиболее подходящей фото для фото с паспорта
                        $matchedFace = $documentFace->faceMatch($imageFaceList);
                        $this->faceRepository->save($documentFace); // сохраняем результаты сравнений
                        $comparation = $this->faceCompareRepository->get($documentFace->id,$matchedFace->face_id);
                    }
                }
        return $comparation;
    }

    public function analyzingResultOfComparing($booking)
    {
        $notMatchedDocumentList=[];
        $finalProbability=0;
        foreach ($booking->guests as $guest)
            foreach ($guest->documents as $document)
                foreach ($booking->photoImages as $image) {
                    $probability = $document->getTheMostSimilarFaceMatchedProbability($image, $this->faceCompareRepository);
                    if ($finalProbability < $probability)
                        $finalProbability = $probability;
                }
        return $finalProbability;
    }

}