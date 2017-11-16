<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:06
 */

namespace reception\forms\MyRent;

/**
 * @property integer $id
 * @property string $guid         
 * @property string $created      
 * @property string $changed      
 * @property float $price
 * @property float $exchange
 * @property float $price_local
 * @property string $paid         
 * @property string $from_date    
 * @property string $from_time    
 * @property string $until_date   
 * @property string $until_time   
 * @property string $rent_status  
 * @property string $currency_id  
 * @property string $label        
 * @property integer $rent_adults
 * @property integer $rent_children
 * @property integer $total_guests
 * @property string $active       
 * @property string $note         
 * @property float $in_advance
 * @property float $local_price
 *
 * @property ApartmentForm $property
 * @property ContactForm $contact
 **/


use reception\forms\CompositeForm;



/**
 * @property LockVersionForm $lockVersion
 */
class RentForm extends CompositeForm
{
    public $id;
    public $guid;
    public $created;
    public $changed;
    public $price;
    public $exchange;
    public $price_local;
    public $paid;
    public $from_date;
    public $from_time;
    public $until_date;
    public $until_time;
    public $rent_status;
    public $currency_id;
    public $label;
    public $rent_adults;
    public $rent_children;
    public $total_guests;
    public $active;
    public $note;
    public $in_advance;
    public $local_price;
   //public $user_id;

    
    /**
     * BookingForm constructor.
     * @param array $config
     */
    public function __construct(array $rentInfo, array $config = [])
    {
        parent::__construct($config);

        $this->property = new ApartmentForm([],$rentInfo);
        $this->contact = new ContactForm([],$rentInfo);
//
//            $config['status'] = ($rentInfo["active"]==="Y")?Booking::STATUS_ACTIVE: Booking::STATUS_NONE;
//
//        $this->guests = new GuestForm();
        // $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @inheritdoc
     */
    public function rules() : array
    {
        $rules = [
                [["guid","created","changed", "paid","from_date", "from_time", "until_date", "until_time",
                    "rent_status",  "label", "active", "note"  ],'string'],
                [[ "rent_adults", "rent_children","total_guests","id","currency_id", ], 'integer'],
                [[ "in_advance", "local_price","price_local","price","exchange" ], 'double'],
                ];
        return $rules;
    }

//    public function getApartmentId(){
//        return (Apartment::find()->where(['or', ['external_id'=>$this->externalApartmentId], ['id' => $this->apartmentId]])->one())->id;
//    }
//    public function getGuestId(){
//        return Guest::find()->joinWith('bookings')->where(['booking.external_id'=>$this->externalId])->one();
//    }
//
//    public function validateApartment(){
//        if (!isset($this->apartmentId) && !isset($this->externalApartmentId)){
//            $this->addError('One of apartment Id should be set');
//            return ;
//        }
//        $apartment = Apartment::find()->where(['external_id'=>$this->externalApartmentId])->orWhere(['id'=>$this->apartmentId])->one();
//        if (!isset($apartment)){
//            $this->addError('Wrong ID of apartment');
//        }
//        $this->apartment = $apartment;
//    }

    protected function internalForms(): array
    {
        return ['contact','property'];
    }


}