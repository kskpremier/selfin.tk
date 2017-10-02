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
use reception\entities\Booking\Booking;

/**
 * @property PhotosForm $PhotosForm
 * 
 * * @property integer $id;
* @property String $date;
* @property integer $camera_id;
* @property integer $album_id;
* @property String $file_name;
* @property integer $booking_id;
* @property integer $user_id;
* @property integer $size;
* @property String $uploaded;
* @property String $type;
* @property String $dimensions;
* @property integer $facematika_id;
* @property integer $status;
* @property float $altitude;
* @property float $longitude;
* @property float $latitude;
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

    public function __construct(array $config = [])
    {
        $this->PhotosForm = new PhotosForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [

            [['date','file_name','size','uploaded','type',
            'dimensions','facematika_id','status','altitude',
            'longitude','latitude','album_id','id','user_id'],'safe'],
          //  [['id','user_id',],'integer'],
            [['booking_id'],'validateBooking','message'=>'Booking with this ID should exist']
        ];
    }
    protected function internalForms(): array
    {
        return ['PhotosForm'];
    }
    public function validateBooking(){
        if (!isset($this->booking_id)){
            $this->addError('Booking ID should be set');
        }
        $booking = Booking::find()->where(['external_id'=>$this->booking_id])->orWhere(['id'=>$this->booking_id])->one();
        if (!isset($booking)){
            $this->addError('Wrong ID of Booking');
        }
    }
}