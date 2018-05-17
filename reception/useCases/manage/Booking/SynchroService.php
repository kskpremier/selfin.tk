<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 4/29/18
 * Time: 1:25 PM
 */

namespace reception\useCases\manage\Booking;

use backend\models\DocumentType;
use reception\entities\User\User;
use reception\forms\MyRent\ContactForm;
use reception\services\MyRent\MyRent;
use backend\models\Country;
use reception\entities\Apartment\Apartment;
use reception\entities\Booking\Booking;
use reception\entities\Booking\Document;
use reception\entities\Booking\Guest;
use reception\entities\Booking\Registration;
use reception\forms\MyRent\ApartmentForm;
use reception\forms\MyRent\GuestForm;
use reception\forms\MyRent\RentForm;
use reception\repositories\Apartment\ApartmentRepository;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\BookingRepository;
use reception\repositories\Booking\DocumentRepository;
use reception\repositories\Booking\FaceComparationRepository;
use reception\repositories\Booking\FaceRepository;
use reception\repositories\Booking\GuestRepository;
use reception\repositories\Booking\RegistrationRepository;
use reception\repositories\DoorLock\DoorLockRepository;
use reception\repositories\UserRepository;
use reception\services\TransactionManager;
use reception\services\TTL\DoorLockChinaService;
use yii\base\ErrorHandler;
use yii\helpers\ArrayHelper;


class SynchroService {

    /**
     * @var BookingRepository
     */
    private $bookingRepository;
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
    private $faceCompareRepository;
    /**
     * @var GuestRepository
     */
    private $guestRepository;
    /**
     * @var ApartmentRepository
     */
    private $apartmentRepository;
    /**
     * @var TransactionManager
     */
    private $transaction;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RegistrationRepository
     */
    private $registrationRepository;
    /**
     * @var DocumentRepository
     */
    private $documentRepository;
    /**
     * @var ErrorHandler
     */
    private $errorHandler;
    /**
     * @var DoorLockRepository
     */
    private $doorLockRepository;
    /**
     * @var DoorLockChinaService
     */
    private $doorLockChinaService;


    /**
     * SynchroService constructor.
     * @param BookingRepository $bookingRepository
     * @param AbstractImageRepository $imageRepository
     * @param FaceRepository $faceRepository
     * @param FaceComparationRepository $faceCompareRepository
     * @param DocumentRepository $documentRepository
     * @param GuestRepository $guestRepository
     * @param ApartmentRepository $apartmentRepository
     * @param RegistrationRepository $registrationRepository
     * @param UserRepository $userRepository
     * @param TransactionManager $transaction
     * @param ErrorHandler $errorHandler
     * @param DoorLockRepository $doorLockRepository
     * @param DoorLockChinaService $doorLockChinaService
     */
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

    /**
     * Get all Property for User from MyRent and synchronize them with existing one or build new
     * @param int $user_id
     * @param int $updateTime
     * @param $owner_id
     * @return array
     */
    public function synchroApartmentsForUser(User $user, int $updateTime, $owner_id) {
        $existingApartments = $user->apartments;
        $list =  MyRent::getApartmentsForUser($user->external_id);
        $apartmentsList=[];
        foreach ($list as $property) {
            $apartmentsList[] =  $this->updateApartment($property['id'],$user->id, $updateTime, $owner_id);
        }
        $apartmentForUnset = array_diff(ArrayHelper::getColumn($existingApartments,'id'),ArrayHelper::getColumn($apartmentsList,'id'));
        foreach ($apartmentForUnset as $id) {
                $apartment= $this->apartmentRepository->get($id);
                $apartment->user_id = null;
                $this->apartmentRepository->save($apartment);
        }
        $user->updated_at = $updateTime;
        $this->userRepository->save($user);
        return $apartmentsList;
    }

    /**
     * @param $apartment_external_id
     * @param $user_id
     * @param $updateTime
     * @param $owner_id
     * @return Apartment
     */
    public function updateApartment($apartment_external_id, $user_id, $updateTime, $owner_id) :Apartment {
        $apartment = $this->apartmentRepository->findByMyRentId($apartment_external_id);
        $apartmentInfo = MyRent::getApartmentsById($apartment_external_id);
        $form = new ApartmentForm();
        $form->load($apartmentInfo[0],'');
        if (!$apartment) {
            $apartment = Apartment::createProperty($form, $user_id, $updateTime, $owner_id);
        }
        else $apartment->edit($form, $user_id, $updateTime, $owner_id);
        $this->apartmentRepository->save($apartment);
        return $apartment;
    }

    /**
     * Get All Rents from Myrent for user_id from 1.1.1970 and and synchronize them with existing one or build new
     * @param int $user_id
     * @param $updateTime
     * @param $owner_id
     */
    public function synchroRentsForUser(User $user, $updateTime, $owner_id){
        $existingRents = $this->bookingRepository->getBookingsForApartmentsSet(ArrayHelper::getColumn($user->apartments,'id'));
        $list = Myrent::getBookingsUpdateForUser($user->external_id, 0);
        $rentsList = $this->updateRents($list, $updateTime, $user->id, $owner_id);
        $array = array_diff(ArrayHelper::getColumn($existingRents,'id'),ArrayHelper::getColumn($rentsList,'id'));
        foreach ($array as $id) {
            $this->bookingRepository->removeById($id);
        }
        return $rentsList;
    }

    /**
     *  Get All changes in Rents from Myrent for user_id from $lastUpdateTime and and synchronize them with existing one or build new
     * @param int $lastUpdateTime
     * @param int $user_id
     * @param $updateTime
     * @param $owner_id
     */
    public function synchroChangesRentsForUser(User $user, $lastUpdateTime, $updateTime, $owner_id){

        $list = Myrent::getBookingsUpdateForUser($user->external_id, $lastUpdateTime);
        $rentsList = $this->updateRents($list, $updateTime, $user->id, $owner_id);
        $user->myrent_update = $updateTime;
        $this->userRepository->save($user);

        return $rentsList;
    }

//    public function synchroRentsForApartment(int $apartment_id, $updateTime, $owner_id){
//        $list = Myrent::getBookingsUpdateForUser($user_id);
//        $this->synhroRents($list, $updateTime, $user_id, $owner_id);
//    }

    /**
     * @param array $list
     * @param int $updateTime
     * @param $user_id
     * @param $owner_id
     */
    public function updateRents(array $list, int $updateTime, $user_id, $owner_id)
    {
        $rentsList=[];
        foreach ($list as $rent) {
            $form = new RentForm($rent);
            $form->load($rent, '');
            $apartment = $this->updateApartment($form->property->object_id, $user_id, $updateTime, $owner_id);
            $this->apartmentRepository->save($apartment);
            $author = $this->updateAuthorOfRent($form->contact, $updateTime);
            $this->guestRepository->save($author);
            $booking = $this->bookingRepository->findByMyRentId($form->id);
            if (!$booking)
                $booking = Booking::createBooking($form, $updateTime, $apartment->id, $author->id);
            else
                $booking->edit($form, $updateTime, $apartment->id, $author->id);
            //список гостей
            $this->bookingRepository->save($booking);
            $this->updateGuestListForRent($booking, $updateTime);
            $this->bookingRepository->save($booking);
            $rentsList[] = $booking;
        }
        return $rentsList;
    }

    /**
     * @param ContactForm $form
     * @param $updateTime
     */
    public function updateAuthorOfRent(ContactForm $form, $updateTime){
        //ищем автора
        $author = $this->guestRepository->findByMyRent($form);
        if (!$author)
            $author = Guest::createContact($form, $updateTime);
        else $author->updateContact($form, $updateTime);
        $this->guestRepository->save($author);
        return $author;
    }

    /**
     * @param $list
     * @param Booking $booking
     */
    public function updateGuestsForBooking ($list, Booking $booking) {


    }

    /**
     * Create or Edit Guest entity and save it  without any connection with Booking
     * @param GuestForm $form
     * @param $updateTime
     * @param Booking $booking
     * @return bool|null|Guest|static
     */
    public function updateGuest(GuestForm $form, $updateTime, Booking $booking) {
        $guest = $this->guestRepository->isGuestExist($form->name_first, $form->name_last, $form->email);
        if ($guest==false)
            $guest = Guest::create($form->name_first, $form->name_last, $form->email, null, null, null, $updateTime, $guid=null);
        else $guest->editGuest($form->name_first, $form->name_last, $form->email, null, $form->telephone, $updateTime, $form->guid);
//        $booking->assignGuest($guest->id);
        $this->guestRepository->save($guest);
        return $guest;
    }


    /**
     * Create new or edit existing Document and save it with connection with Guest
     * @param GuestForm $form
     * @param $updateTime
     * @param Guest $guest
     * @return bool|null|Document|static
     */
    public function updateDocument (GuestForm $form, $updateTime, Guest $guest) {
        $document = $this->documentRepository->isDocumentExist($form->name_first, $form->name_last, $form->document_number, $form->citizenship, $form->birth_date, $form->residence_city);
        $country = Country::find()->where(['code' => $form->citizenship])->one();
        $citizen = ($country != null) ? $country->id : 237; ///по умолчанию Зимбабве
        $countryOfBirth = (Country::find()->where(['code' => $form->birth_country])->one());
        $birthCountry = ($countryOfBirth != null) ? $countryOfBirth->id : $citizen;
        $citizenshipOfBirth = (Country::find()->where(['code' => $form->birth_country])->one());
        $birthCitizenship = ($citizenshipOfBirth != null) ? $citizenshipOfBirth->id : $citizen;
        $identityType = ($type=DocumentType::find()->where(['code'=>$form->document_type])->one())? $type->id: 3;
        if ($document==false)
            $document = Document::create($form->name_first, $form->name_last, $identityType, $form->document_number,
            ($form->gender == "muški") ? "M" : "F", $citizen, $form->residence_city,$birthCountry, $birthCitizenship, $birthCountry, $form->birth_date, $form->residence_adress, null, $updateTime, $guest);
        else
            $document->edit($identityType, ($form->gender == "muški") ? "M" : "F", $citizen, $form->residence_city, $birthCountry, $birthCitizenship,
            $form->birth_date, $form->document_number, $form->residence_adress, $form->name_first, $form->name_last, null, $updateTime, $guest);
        $this->documentRepository->save($document);
        return $document;
    }

    /**
     * Create new one or Edit existing Registration and save it with connection with Booking, Document and Guest
     * @param GuestForm $form
     * @param $updateTime
     * @param Booking $booking
     * @param Document $document
     * @param Guest $guest
     * @return array|bool|null|Registration|\yii\db\ActiveRecord
     */
    public function updateRegistration(GuestForm $form, $updateTime, Booking $booking, Document $document, Guest $guest) {
        $registration = $this->registrationRepository->findByMyRentId($form->id);
        if ($registration==false)
            //если не найдена - создаем новую
            $registration = Registration::create($form->id, $form->date_from, $form->date_until, $booking->from_time, $booking->until_time, $document, $booking, $guest, $form->guid, $form->checkin, $form->checkout, $updateTime);
         else $registration->edit($form->id, $form->date_from, $form->date_until, $booking->from_time, $booking->until_time, $document, $booking, $guest, $form->guid, $form->checkin, $form->checkout, $updateTime);
        $this->registrationRepository->save($registration);
        return $registration;
    }

    /**
     * @param Booking $booking
     * @param $updatedTime
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function updateGuestListForRent (Booking $booking, $updatedTime)
    {
        $guestList = MyRent::getGuestsForBooking($booking);
        $existingGuests = $booking->getGuests()->all();
        $existingDocuments = $booking->getAllExistingDocuments();
        $existingRegistrations = $booking->getRegistrations()->all();
        $currentGuests = [];
        $currentDocuments = [];
        $currentRegistrations = [];
        if ($guestList != "NoContent") {
            foreach (json_decode($guestList, true) as $element) {
                $form = new GuestForm();
                $form->load($element, '');
                $guest = $this->updateGuest($form, $updatedTime, $booking);
                $booking->assignGuest($guest->id);
                $currentGuests[] = $guest;
                $document = $this->updateDocument($form, $updatedTime, $guest);
                $currentDocuments[] = $document;
                $registration = $this->updateRegistration($form, $updatedTime, $booking, $document, $guest);
                $currentRegistrations[] = $registration;
            }
        }
            $array = array_diff(ArrayHelper::getColumn($existingRegistrations,'id'),ArrayHelper::getColumn($currentRegistrations,'id'));
            foreach ($array as $id) {
                $this->registrationRepository->removeById($id);
            }
            $array = array_diff(ArrayHelper::getColumn($existingDocuments,'id'),ArrayHelper::getColumn($currentDocuments,'id'));
            foreach ($array as $id) {
                    $this->documentRepository->removeById($id);
            }
            $array = array_diff(ArrayHelper::getColumn($existingGuests,'id'),ArrayHelper::getColumn($currentGuests,'id'));
            foreach ($array as $id) {
                $booking->revokeGuest($id);
            }
            $booking->myrent_update = $updatedTime;
            $this->bookingRepository->save($booking);

        return;
    }

}