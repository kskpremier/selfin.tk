<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 8/16/17
 * Time: 9:13 AM
 */


namespace reception\forms;

use reception\entities\Booking\Document;
use reception\forms\CompositeForm;
use reception\forms\PhotosForm;
use reception\entities\Booking\Booking;

/**
 * @property SelfyForm $selfyForm
 * 
 * @property integer $id
* @property String $date
* @property integer $camera_id
* @property integer $album_id
* @property String $file_name
* @property integer $booking_id
* @property integer $user_id
* @property integer $size
* @property String $uploaded
* @property String $type
* @property String $dimensions
* @property integer $facematika_id
* @property integer $status
* @property float $altitude
* @property float $longitude
* @property float $latitude
 * @property string $document_number
 * 

 * 
 */
class GuestPhotoForm extends CompositeForm
{
    public $id;
    public $date;
    public $camera_id;
    public $album_id;
    public $file_name;
    public $booking_id;
    public $user_id;
    public $size;
    public $uploaded;
    public $type;
    public $dimensions;
    public $facematika_id;
    public $status;
    public $altitude;
    public $longitude;
    public $latitude;
    public $document_number;

    public $booking;

    public function __construct(array $config = [])
    {
        $this->SelfyForm = new SelfyForm();

        parent::__construct($config);

    }

    public function rules(): array
    {
        return [

            [['date','file_name','size','uploaded','type',"document_number",
            'dimensions','facematika_id','status','altitude',
            'longitude','latitude','album_id','id','user_id'],'safe'],
          //  [['id','user_id',],'integer'],
            [['booking_id'],'validateBooking','message'=>'Booking with this ID should exist'],
            [['document_number'],'validateDocument','message'=>'Document with this number does\'t exist']
        ];
    }
    protected function internalForms(): array
    {
        return ['SelfyForm'];
    }
    public function validateBooking(){
        if (!isset($this->booking_id)){
            return $this->addError('Booking ID should be set');
        }
        $booking = Booking::find()->where(['external_id'=>$this->booking_id])->orWhere(['id'=>$this->booking_id])->one();
        if (!isset($booking)){
            return $this->addError('Wrong ID of Booking');
        }
        return $this->booking = $booking;
    }
    public function validateDocument(){
        if (!isset($this->document_number)){
            return $this->addError('Document number should be set');
        }
        $doc_number = substr($this->document_number,0,-1);
        $this->document_number = substr ($doc_number,1);
        $document = Document::find()->where(['number'=>$this->document_number])->one();
        if (!isset($document)){
            return $this->addError('Wrong number of Document');
        }
       return $this->document_number = $document->id;
    }
}