<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 10:20
 */


namespace reception\useCases\manage\Booking;


use backend\models\Country;
use function isEmpty;
use reception\entities\Booking\events\DocumentAddRequested;
use reception\entities\Booking\Registration;
use reception\entities\Image\AbstractImage;
use reception\entities\Booking\Guest;
use reception\entities\Booking\Document;
use reception\entities\Booking\Booking;
use reception\entities\User\User;
use reception\forms\eVisitorForm;
use reception\forms\GuestDocumentAddForm;
use reception\repositories\Booking\AbstractImageRepository;
use reception\repositories\Booking\DocumentRepository;
use reception\repositories\Booking\GuestRepository;
use backend\models\DocumentType;
use reception\entities\Booking\DocumentPhoto;
use reception\repositories\Booking\RegistrationRepository;
use reception\services\MyRent\MyRent;
use reception\useCases\manage\Image\ImageProcessManagement;
use yii\web\UploadedFile;


class DocumentManageService
{
    private $documentRepository;
    private $guestRepository;
    private $imageRepository;
    private $imageProcessManagement;
    private $registrationRepository;

    public function __construct(DocumentRepository $documentRepository, GuestRepository $guestRepository,
                                AbstractImageRepository $imageRepository, ImageProcessManagement $imageProcessManagement,
                                RegistrationRepository $registrationRepository)
    {
        $this->documentRepository = $documentRepository;
        $this->registrationRepository = $registrationRepository;
        $this->guestRepository = $guestRepository;
        $this->imageRepository = $imageRepository;
        $this->imageProcessManagement = $imageProcessManagement;

    }

    public function addDocumentDataWithPhoto(GuestDocumentAddForm $form, User $user): Document
    {

        //обработка и добавление семантики документа гостя
        $document = $this->addDocumentData($form->eVisitorForm, $user);
//        $document->recordEvent(new DocumentAddRequested($document, $form->PhotosForm, $form->SelfyForm));
        $this->instantRecognise(new DocumentAddRequested($document, $form->PhotosForm, $form->SelfyForm));
        $this->documentRepository->save($document);

//        $this->instantRecognise(new DocumentAddRequested($document, $form->PhotosForm, $form->SelfyForm));

        return $document;
    }


    public function addDocumentData(eVisitorForm $form, User $user): Document

    {
        $guest = $this->GuestManageService->isGuest($form->firstName,$form->secondName,$form->contact_country);
        if (!$guest)
            $guest = $this->GuestManageService->addToBookingGuestList( $form->firstName,$form->secondName, $booking );





        $this->guestRepository->save($guest);

        $document = $this->documentRepository->isDocumentExist($form->firstName, $form->secondName, $form->numberOfDocument, $form->country, $form->dateOfBirth, $form->city);

            $country=Country::find()->where(['code'=>$form->country])->one();
            $citizen = ($country !=null) ? $country->id : 237; ///по умолчанию Зимбабве
            $countryOfBirth=(Country::find()->where(['code'=>$form->countryOfBirth])->one());
            $birthCountry = ($countryOfBirth !=null)? $countryOfBirth->id : $citizen;
            $citizenshipOfBirth=(Country::find()->where(['code'=>$form->citizenshipOfBirth])->one());
            $birthCitizenship = ($citizenshipOfBirth !=null)? $citizenshipOfBirth->id : $citizen;
            if (!$document) {
                $document = Document::create($form->firstName, $form->secondName,
                    (DocumentType::find()->where(['code' => $form->identityData])->one())->id,
                    $form->numberOfDocument,
                    $form->gender, $citizen, $form->city, $birthCountry, $birthCitizenship,
                    $form->cityOfBirth, $form->dateOfBirth, $form->address,  $form->validBefore);
            } else $document->edit((DocumentType::find()->where(['code' => $form->identityData])->one())->id, $form->gender, $citizen, $form->city, $birthCountry,
                $birthCitizenship,  $form->dateOfBirth,$form->numberOfDocument, $form->address,$form->firstName,$form->secondName,$form->validBefore);
            $document->guest = $guest;
            $this->guestRepository->save($guest);
//            $document->recordEvent(new DocumentAddRequested($document, $form->PhotosForm, $form->SelfyForm));
            $this->documentRepository->save($document);
//добавляем факт регистрации
        $result = MyRent::addGuest($document, $form->booking_external_id, $form->eVisitor, $user);
        if ($result) {
            $registration = $this->registrationRepository->isRegistrationExist($result, $form->from, $form->to, $form->time_from, $form->time_to, $document->id, $guest->id, $form->booking->id);
            if (!$registration) $registration = Registration::create($result, $form->from, $form->to, $form->time_from, $form->time_to, $document, $form->booking, $guest);
            else $registration->edit($result, $form->from, $form->to, $form->time_from, $form->time_to, $document, $form->booking, $guest);
            $this->registrationRepository->save($registration);
        }
        return $document;
    }

    public function checkin(Document $document, Booking $booking){
        $registration = $this->registratonRepository->getByBookingDocument($booking, $document);
        $registration->checkin();
        return $this->registrationRepository->save();
    }

public function updateRegistration($result) {

}

    public function instantRecognise(DocumentAddRequested $event): void
    {
        //обработка и добавление фотографий
        if (isset($event->photos)) {
            foreach ($event->photos->files as $photoDoc) {
                $image = AbstractImage::create($photoDoc, AbstractImage::ALBUM_DOCUMENT, $event->document,null);
                $this->imageRepository->save($image);
                $facesFromDoc = $this->imageProcessManagement->getDetectedFaces($image);
            }
        }
        if (isset($event->selfy)) {
            foreach ($event->selfy->files as $image) {
                $image = AbstractImage::create($image, AbstractImage::ALBUM_IMAGES, $event->document,null);
                $this->imageRepository->save($image);
                $facesFromSelfy = $this->imageProcessManagement->getDetectedFaces($image);

            }
        }
        $array=$this->documentRepository->isDocumentReadyForMatching($event->document);
        if (!count($array["doc"])&&!count($array["face"]))
            $this->imageProcessManagement->processDocumentImages($event->document, $array);
    }
}
    