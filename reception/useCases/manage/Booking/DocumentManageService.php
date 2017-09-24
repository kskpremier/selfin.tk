<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 10:20
 */


namespace reception\useCases\manage\Booking;


use backend\models\Country;
use reception\entities\Booking\Guest;
use reception\entities\Booking\Document;
use reception\entities\Booking\Booking;
use reception\forms\GuestDocumentAddForm;
use reception\repositories\Booking\DocumentRepository;
use backend\models\DocumentType;
use reception\entities\Booking\DocumentPhoto;
use yii\web\UploadedFile;


class DocumentManageService
{
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;

    }

    public function addDocument($form): Document
    {

        $booking = Booking::findByBookingIdentity($form->bookingId);
        $guest = Guest::find()->where([
            'first_name' => $form->firstName,
            'second_name' => $form->secondName,
        ])->one();
        if (!$guest) {
            $guest = Guest::addToBookingGuestList(
                $form->firstName,
                $form->secondName,
                $booking
            );
        }
        $document = $this->documentRepository->isDocumentExist($form->firstName, $form->secondName, $form->numberOfDocument, $form->country, $form->dateOfBirth);
        if (!$document) {
            $country=Country::find()->where(['code'=>$form->country])->one();
            $citizen = ($country !=null) ? $country->id : 237; ///по умолчанию Зимбабве
            $countryOfBirth=(Country::find()->where(['code'=>$form->countryOfBirth])->one());
            $birthCountry = ($countryOfBirth !=null)? $countryOfBirth->id : $citizen;
            $citizenshipOfBirth=(Country::find()->where(['code'=>$form->citizenshipOfBirth])->one());
            $birthCitizenship = ($citizenshipOfBirth !=null)? $citizenshipOfBirth->id : $citizen;
            $document = Document::create($form->firstName,
                                        $form->secondName,
                                        (DocumentType::find()->where(['code'=>$form->identityData])->one())->id,
                                        $form->numberOfDocument, $form->gender,
                                        $citizen,
                                        $form->city,
                                        $birthCountry,
                                        $birthCitizenship,
                                        $form->cityOfBirth,
                                        $form->dateOfBirth,
                                        $form->validBefore,
                                        $form->address);
        }

        $document->guest = $guest;
        $this->documentRepository->save($document);

        return $document;
    }

    public function addGuest(GuestDocumentAddForm $form): Document
    {
        //обработка и добавление семантики документа гостя
        $document = $this->addDocument($form->eVisitorForm);
        //обработка и добавление фотографий
        foreach ($form->PhotosForm->files as $image){
            $photo = new DocumentPhoto();
            $photo=$photo->create($image, $document->id);
            $images[]=$photo;
        }
        $document->images = $images;
        $this->documentRepository->save($document);
        return $document;
    }

    public function addGuestWithOnePageDocument(GuestDocumentAddForm $form): Document
    {
        //обработка и добавление семантики документа гостя
        $document = $this->addDocument($form->eVisitorForm);
        //обработка и добавление фотографий
        foreach ($form->PhotosForm->files as $image){
            $photo = new DocumentPhoto();
            $photo=$photo->create($image, $document->id);
            $images[]=$photo;
        }
        $document->images = $images;
        $this->documentRepository->save($document);
        return $document;
    }
}
    