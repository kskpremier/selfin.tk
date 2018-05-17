<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:49
 */



namespace reception\useCases\manage\Booking;


use backend\models\Country;
use DomainException;
use function is_array;
use reception\entities\Apartment\Apartment;
use reception\entities\Booking\Booking;
use reception\entities\Booking\Document;
use reception\entities\Booking\FaceComparation;
use reception\entities\Booking\DocumentPhoto;
use reception\entities\Booking\Guest;
use reception\entities\Booking\Registration;
use reception\forms\BookingForm;
use reception\forms\eVisitorForm;
use reception\forms\MyRent\ApartmentForm;
use reception\forms\MyRent\GuestForm;
use reception\forms\MyRent\RentForm;
use reception\helpers\TTLHelper;
use reception\repositories\Apartment\ApartmentRepository;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\BookingRepository;
use reception\entities\DoorLock\KeyboardPwd;
use reception\repositories\Booking\DocumentRepository;
use reception\repositories\Booking\FaceComparationRepository;
use reception\repositories\Booking\FaceRepository;
use reception\repositories\Booking\GuestRepository;
use reception\repositories\Booking\RegistrationRepository;
use reception\repositories\DoorLock\DoorLockRepository;
use reception\repositories\UserRepository;
use reception\services\MyRent\MyRent;
use reception\services\TransactionManager;
use reception\services\TTL\DoorLockChinaService;
use reception\useCases\BusinessException;

use reception\entities\User\User;
use reception\useCases\manage\TTL\TTL;
use yii\base\ErrorHandler;

class BookingManageService
{
    private $bookingRepository;
    private $imageRepository;
    private $faceRepository;
    private $faceCompareRepository;
    private $guestRepository;
    private $apartmentRepository;
    private $transaction;
    private $userRepository;
    private $registrationRepository;
    private $documentRepository;
    private $errorHandler;
    private $doorLockRepository;
    private $doorLockChinaService;


    public function __construct(BookingRepository $bookingRepository,
                                AbstractImageRepository $imageRepository,
                                FaceRepository $faceRepository,
                                FaceComparationRepository $faceCompareRepository,
                                DocumentRepository $documentRepository,
                                GuestRepository $guestRepository,
                                ApartmentRepository $apartmentRepository,
                                RegistrationRepository $registrationRepository,
                                UserRepository $userRepository,
                                TransactionManager $transaction,
                                ErrorHandler $errorHandler,
                                DoorLockRepository $doorLockRepository,
                                DoorLockChinaService $doorLockChinaService

    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->imageRepository = $imageRepository;
        $this->faceRepository = $faceRepository;
        $this->faceCompareRepository = $faceCompareRepository;
        $this->guestRepository = $guestRepository;
        $this->apartmentRepository = $apartmentRepository;
        $this->transaction = $transaction;
        $this->userRepository = $userRepository;
        $this->registrationRepository = $registrationRepository;
        $this->documentRepository = $documentRepository;
        $this->errorHandler = $errorHandler;
        $this->doorLockRepository = $doorLockRepository;
        $this->doorLockChinaService = $doorLockChinaService;
    }


    public function create($form, $needToSendConfirmationLetter=null, $needToMakeUser=null, $needToMakeKeyboardPassword=null): Booking
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
        //ищем , есть ли уже такой букинг
        $booking = $this->bookingRepository->findByMyRentId($form->externalId);
        if (!$booking && $form->externalId) {
           
            $rentInfo = MyRent::getRent($form->externalId);
            $formBooking = new RentForm($rentInfo);
            //ищем, есть ли такие апартаменты
            $apartment = (isset($form->aparmnent)) ? $form->apartment : $this->apartmentRepository->findByMyRentId($form->externalApartmentId);
            if (!isset($apartment)) {
                $myRentResponse = MyRent::getApartmentsById($form->externalApartmentId);
                if (count($myRentResponse)==1) {
                    $apartmentForm = new ApartmentForm();
                    $apartmentForm->load($myRentResponse[0], '');
                    if ($apartmentForm->validate()) {
                        $apartment = Apartment::create('', $formBooking->name, $form->externalId, $form->owner, $form->latitude,
                            $form->longitude, $form->city_name, $form->adress, $form->object_color, $form->guid,
                            $form->user->user_id, '', $form->country, $form->doorlocks);
                    }
                }
                else throw new DomainException("wrong answer from Myrent");
            }
            $booking = Booking::create(
               $formBooking->from_date, $formBooking->until_date, $apartment, $author,
               $formBooking->total_guests,$formBooking->id,Booking::STATUS_ACTIVE,
               $guestList,
               $formBooking->guid,$formBooking->rent_status,$formBooking->from_time,$formBooking->until_time,$formBooking->price,$formBooking->exchange,
               $formBooking->label,$formBooking->price_local,$formBooking->paid,$formBooking->created,$formBooking->changed);
        }
        else {
            $booking->updateEdit($form->startDate, $form->endDate, $form->numberOfTourist);
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


    public function getKeys(BookingForm $form){

            $rentInfo = MyRent::getRent($form->externalId);
            if (count($rentInfo)==1) {
                $formBooking = new RentForm($rentInfo);
                $formBooking->load($rentInfo[0],'');
                if ($formBooking->validate()) {
                    $user = $this->userRepository->getByExternalId($formBooking->user_id);
                    $this->updateBookings($formBooking, $user->id, time());
                }
                else { throw new \DomainException(" No correct validation ".json_encode ($formBooking->getErrors()) ) ;}
            }
            else {throw new \DomainException("wrong answer from Myrent");}

        $booking = $this->bookingRepository->findByMyRentId($form->externalId);
        if ($booking) {
             $this->generateKeyboardPwdForBooking($booking);
             return $booking;
        }
    }

    public function updateBookings(RentForm $form, $user_id, $updateTime, $owner_id=null)
    {
        //здесь по хорошему надо бы делать транзакцию
        $this->transaction->wrap(function () use ($form, $user_id, $updateTime, $owner_id){
            try {
                $user = $this->userRepository->get($user_id);
            } catch (\NotFoundException $e) {
                $this->errorHandler->logException($e);
            }
        if ($form->active === "Y") {
            //ищем апартамент
            $apartment = $this->apartmentRepository->findByMyRentId($form->object_id);
            $apartmentInfo = MyRent::getApartmentsById($form->object_id);
            $form->property->load($apartmentInfo[0],'');
            if (!$apartment) {
                $apartment = Apartment::createProperty($form->property, $user_id, $updateTime, $owner_id);
            }
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
            else {
                $booking->edit($form, $updateTime, $apartment->id, $author->id);
                //список гостей
                $guestList= MyRent::getGuestsForBooking($booking);
                $existingGuests = $booking->getGuests()->all();
                $existingDocuments = $booking->getAllExistingDocuments();
                $existingRegistrations = $booking->getRegistrations()->all();
                $currentGuests=[];
                $currentDocuments=[];
                $currentRegistrations=[];
                if ($guestList!="NoContent") {
                    foreach (\GuzzleHttp\json_decode($guestList, true) as $element) {
                        $form = new GuestForm();
                        $form->load($element, '');
                        if ($form->validate()) {
                            $guest = $this->guestRepository->isGuestExist($form->name_first, $form->name_last, $form->email);
                            if ($guest==false) $guest = Guest::create($form->name_first, $form->name_last, $form->email);
                            else $guest->editGuest($form->name_first, $form->name_last, $form->email, $booking, $form->telephone, time(), $form->guid);
                            $this->guestRepository->save($guest);
                            $document = $this->documentRepository->isDocumentExist($form->name_first, $form->name_last, $form->document_number, $form->citizenship, $form->birth_date, $form->residence_city);
                            //для документа
                            $country = Country::find()->where(['code' => $form->citizenship])->one();
                            $citizen = ($country != null) ? $country->id : 237; ///по умолчанию Зимбабве
                            $countryOfBirth = (Country::find()->where(['code' => $form->birth_country])->one());
                            $birthCountry = ($countryOfBirth != null) ? $countryOfBirth->id : $citizen;
                            $citizenshipOfBirth = (Country::find()->where(['code' => $form->birth_country])->one());
                            $birthCitizenship = ($citizenshipOfBirth != null) ? $citizenshipOfBirth->id : $citizen;
                            if ($document==false) $document = Document::create($form->name_first, $form->name_last, ($form->document_type==null)?3:$form->document_type, $form->document_number,
                                ($form->gender == "muški") ? "M" : "F", $citizen, $form->residence_city,
                                $birthCountry, $birthCitizenship, $birthCountry, $form->birth_date, $form->residence_adress);
                            else $document->edit(($form->document_type==null)?3:$form->document_type, ($form->gender == "muški") ? "M" : "F", $citizen, $form->residence_city, $birthCountry, $birthCitizenship,
                                $form->birth_date, $form->document_number, $form->residence_adress, $form->name_first, $form->name_last);
                            $document->guest = $guest;
                            $booking->guests = $guest;
                            $this->documentRepository->save($document);
                            //ищем уже существующую регистрацию
                            $registration = $this->registrationRepository->findByMyRentId($form->id);
                            if ($registration==false) {
                                //если не найдена - создаем новую
                                $registration = Registration::create($form->id, $form->date_from, $form->date_until, $booking->from_time, $booking->until_time, $document, $booking, $guest, $form->guid, $form->checkin, $form->checkout);
                            } else $registration->edit($form->id, $form->date_from, $form->date_until, $booking->from_time, $booking->until_time, $document, $booking, $guest, $form->guid, $form->checkin, $form->checkout);
                            $this->registrationRepository->save($registration);
                            $currentGuests[] = $guest;
                            $currentDocuments[] = $document;
                            $currentRegistrations[] = $registration;
                        }
                    }
                }
                foreach ($existingRegistrations as $registration) {
                    if (!array_search($registration, $currentRegistrations)) {
                        $registration->delete();
                    }
                }
                foreach ($existingDocuments as $document) {
                    if (!array_search($document, $currentDocuments)) {
                        $document->delete();
                    }
                }
                foreach ($existingGuests as $guest) {
                    if (!array_search($guest, $currentGuests)) {
                        $guest->delete();
                    }
                }

            }
            $this->bookingRepository->save($booking);
            return $booking;
        } elseif ($form->active === "N") {
            //букинг ищем
            $booking = $this->bookingRepository->findByMyRentId($form->id);
            if ($booking) {
                $booking->deleteBooking($booking);
                $this->bookingRepository->save($booking);
                return $booking;
            }
        }
//        if ($user) {
//            $user->setUpdateTime($updateTime);
//            $this->userRepository->save($user);
//        }
        });
    }

    public function getGuestBooking($guestId) {
        return $this->bookingRepository->getByGuestId($guestId);
    }

    
    public function generateKeyboardPwdForBooking($booking) {
        foreach ($booking->apartment->doorLocks as $doorLock) {
            $keyboardPwd = KeyboardPwd::create(
                strTotime(date ("Y-m-d", strTotime($booking->start_date))." ".$booking->from_time),
                strTotime(date ("Y-m-d", strTotime($booking->end_date))." ".$booking->until_time), //ключ на весь период действия букинга
                TTLHelper::TTL_KEYBOARD_PERIOD_TYPE,
                4,//пока так, потом из модели $doorLock->keyboard_pwd_version,
                $doorLock->id,
                $booking->id
            );
            if (!$keyboardPwd->value) {
//
                //получаем значение с китайского сервера для этого замка
                $data = json_decode($this->doorLockChinaService->getKeyboardPwdFromChina($doorLock, $keyboardPwd), true);
                //проверяем, что ответ корректен
                if (!is_array($data) || !$data['success']) {
                    throw new BusinessException('Can not get keyboard password for this door lock identity: ' . $doorLock->id);
                }
                $keyboardPwd->save();
            }
        }
        return $booking->keyboardPwds;
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