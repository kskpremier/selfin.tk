<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 8/16/17
 * Time: 9:13 AM
 */


namespace reception\forms;

use reception\forms\CompositeForm;
use reception\forms\PhotosForm;
use reception\forms\eVisitorForm;
use reception\entities\Booking\Booking;

/**
 * @property LockVersionForm $lockVersion
 */
class GuestDocumentAddForm extends CompositeForm
{
//    public $firstName;
//    public $secondName;
//    public $identityData;
//    public $numberOfDocument;
//    public $gender;
//    public $country;
//    public $city;
//    public $countryOfBirth;
//    public $cityOfBirth;
//    public $dateOfBirth;
//    public $citizenshipOfBirth;
//    public $bookingId;


    public function __construct(array $config = [])
    {
        $this->eVisitorForm = new eVisitorForm();
        $this->PhotosForm = new PhotosForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
//            [['firstName', 'secondName','country','city',
//                'identityData','numberOfDocument','gender','countryOfBirth','cityOfBirth','dateOfBirth','citizenshipOfBirth'], 'string'],
//
//            [['bookingId'],'validateBooking','message'=>'Booking with this ID should exist']
        ];
    }
    protected function internalForms(): array
    {
        return ['PhotosForm','eVisitorForm'];
    }
    public function validateBooking(){
        if (!isset($this->bookingId)){
            $this->addError('Booking ID should be set');
        }
        $booking = Booking::find()->where(['external_id'=>$this->bookingId])->orWhere(['id'=>$this->bookingId])->one();
        if (!isset($booking)){
            $this->addError('Wrong ID of Booking');
        }
    }
}