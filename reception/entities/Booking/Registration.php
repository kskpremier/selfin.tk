<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 02.08.17
 * Time: 17:51
 */

namespace reception\entities\Booking;

use backend\models\Country;
use backend\models\DocumentType;
use backend\models\Face;
use reception\entities\Booking\Photo;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\EventTrait;
use reception\entities\Booking\queries\DocumentQuery;
use reception\entities\Image\AbstractImage;
use yii\db\BaseActiveRecord;


/**
 * This is the model class for table "guest".
 *
 * @property integer $id
 * @property integer $external_id
 * @property string $guid
 * @property string  $date_from
 * @property string  $time_from
 * @property string  $date_to
 * @property string  $time_to
 * @property integer $document_id
 * @property integer $booking_id
 * @property integer $guest_id
 * @property integer $status
 * @property Booking $booking
 * @property Guest   $guest
 * @property Document $document
 *
 */
class Registration  extends \yii\db\ActiveRecord
{
    public const CREATED = 10;
    public const CHECKIN = 11;
    public const CHECKOUT = 12;
    public const CANCELLED = 13;
    
   

    public static function create(  $external_id, $from, $to, $time_from, $time_to,
                                    $document, $booking, $guest, $guid=null, $checkin=null , $checkout=null, $updatedTime=null) :self
    {
            $registration = new static();

            $registration->external_id = $external_id;
            $registration->date_from = $from;
            $registration->date_to = $to;
            $registration->time_from = $time_from;
            $registration->time_to = $time_to;
            $registration->document = $document;
            $registration->booking_id = $booking->id;
            $registration->guest = $guest;
            $registration->guid = $guid;
            $registration->updated_at = ($updatedTime)?$updatedTime:time();

        $registration->status = ($checkout=="Y")?self::CHECKOUT : ($checkin=="Y")? self::CHECKIN : self::CREATED;

        return $registration;
    }
    public function edit( $external_id, $from, $to, $time_from, $time_to,
                          $document, $booking, $guest, $guid=null, $checkin=null , $checkout=null, $updatedTime = null  ) :self
    {
        $this->external_id = $external_id;
        $this->date_from = $from;
        $this->date_to = $to;
        $this->time_from = $time_from;
        $this->time_to = $time_to;
        $this->document = $document;
        $this->booking_id = $booking->id;
        $this->guest = $guest;
        $this->guid = $guid;
        $this->status = ($checkout=="Y")?self::CHECKOUT : ($checkin=="Y")? self::CHECKIN : $this->status;
        $this->updated_at = ($updatedTime)?$updatedTime:time();

        return $this;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registration';
    }

    public function fields(){
        return [
            "name_first"=>$this->document->first_name,
            "name_last"=> $this->document->second_name,
            "citizenship"=> $this->document->citizenship->code,
            "birth_country"=>$this->document->birthCountry->code,
            "gender"=>(($this->document->gender=="male")||($this->document->gender=="M"))?  "muški":"ženski",
            "birth_city"=>$this->document->city_of_birth,
            "residence_city"=>$this->document->city_of_birth,
            "birth_date"=> $this->document->date_of_birth,
            "document_number"=>$this->document->number,
            "document_type"=>$this->document->documentType->code,
            "residence_country" => $this->document->citizenship->code,
            "residence_adress"  =>$this->document->address,
            "residence_city"=> $this->document->city,
            "arrival_organisation" => "I",
            "offered_service_type" => "noćenje",
            "tt_payment_category"  => "12",
            "date_from"=> strtotime ($this->date_from),
            "time_from"=> strtotime ($this->time_from.":00"),
            "date_to"=> strtotime ($this->date_to),
            "time_to"=> strtotime ($this->time_to.":00"),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' =>'booking_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }



    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['guest','document'],
            ],
        ];
    }

   public function checkin(){
        $this->status = self::CHECKIN;
   }
    public function cancell(){
        $this->status = self::CANCELLED;
    }
    public function checkout(){
        $this->status = self::CHECKOUT;
    }

}
