<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 1/10/18
 * Time: 3:02 PM
 */

namespace reception\services\eVisitor;


use reception\entities\Booking\Booking;
use reception\entities\Booking\Document;

class CheckIn
{
    public $ID;                              //"12345678-1234-1234-1234-123456789012"public $
    public $Facility;                              //"0000022"
    public $StayFrom;                              //"20171208"
    public $TimeStayFrom;                              //"12:44"
    public $ForeseenStayUntil;                              //"20171210"
    public $TimeEstimatedStayUntil;                              //"11:32"
    public $DocumentType;                              //"008"
    public $DocumentNumber;                              //"n1"
    public $TouristName;                              //"Ime1"
    public $TouristMiddleName;                              //""
    public $TouristSurname;                              //"Prezime1"
    public $Gender;                              //"ženski"
    public $CountryOfBirth;                              //"RUS"
    public $CityOfBirth;                              //"Moskva"
    public $Citizenship;                              //"RUS"
    public $VisaValidityDate;                              //"20150309"
    public $VisaType;                              //"Putna viza"
    public $VisaNumber;                              //"0001"
    public $CountryOfResidence;                              //"RUS"
    public $CityOfResidence;                              //"Moskva"
    public $ResidenceAddress;                              //"aa1"
    public $PassageDate;                              //"20150309"
    public $BorderCrossing;                              //"053"
    public $TTPaymentCategory;                              //"12"
    public $ArrivalOrganisation;                              //"I"
    public $OfferedServiceType;                              //"noćenje"
    public $DateOfBirth;                        //"20150309"

    public function __construct(Document $document, Booking $booking)
    {
        $this->TouristName = $document->first_name;
        $this->TouristSurname = $document->second_name;
        
        $this->ID = $this->generate_guid();//uniqid($booking->apartment->eVisitor_id."-".$document->id."-");
        
        $this->Facility = "0034643";//$booking->apartment->eVisitor_id ;
        $this->StayFrom = date("Ymd",strtotime($booking->start_date)) ;
        $this->TimeStayFrom = date("H:i",strtotime($booking->from_time)) ;
        $this->ForeseenStayUntil = date("Ymd",strtotime($booking->end_date));;
        $this->TimeEstimatedStayUntil = date("H:i",strtotime($booking->until_time)) ;
        $this->DocumentType = $document->documentType->code ; //$this->documentType->code,
        $this->DocumentNumber = $document->number ;
        $this->DateOfBirth = date("Ymd",strtotime($document->date_of_birth)) ;
//        $this->TouristMiddleName = $document-> ;

        $this->Gender = ($document->gender == "M")? "muški":"ženski";
        $this->CountryOfBirth = $document->birthCountry->code ;
        $this->CityOfBirth = $document->city_of_birth ;
        $this->Citizenship = $document->citizenship->code ;
//        $this->VisaValidityDate = $document-> ;
//        $this->VisaType = $document-> ;
//        $this->VisaNumber = $document-> ;

        $this->CityOfResidence = $document->city ;
        $this->ResidenceAddress = $document->address ;
        //время пересечения границы для граждан не EC
//        $this->PassageDate = $document-> ;
//        $this->BorderCrossing = $document-> ;


        //с этими полями надо еще разбираться

        $this->TTPaymentCategory = "12";//$document-> ;

        $this->ArrivalOrganisation = "I";
        $this->OfferedServiceType = "noćenje" ;
        $this->CountryOfResidence = $this->Citizenship ;


    }


    public function asArray(){
        return [
            
'ID'=>$this->ID,                    
'Facility'=>$this->Facility ,              
'StayFrom'=>$this->StayFrom ,              
'TimeStayFrom'=>$this->TimeStayFrom ,          
'ForeseenStayUntil'=>$this->ForeseenStayUntil ,
'TimeEstimatedStayUntil'=>$this->TimeEstimatedStayUntil ,
'DocumentType'=>$this->DocumentType ,
'DocumentNumber'=>$this->DocumentNumber ,
'TouristName'=>$this-> TouristName,
'TouristMiddleName'=>$this->TouristMiddleName,
'TouristSurname'=>$this->TouristSurname ,
'Gender'=>$this->Gender ,
'CountryOfBirth'=>$this->CountryOfBirth ,
'CityOfBirth'=>$this->CityOfBirth ,
'Citizenship'=>$this->Citizenship ,
//'VisaValidityDate'=>$this->VisaValidityDate ,
//'VisaType'=>$this->VisaType ,
//'VisaNumber'=>$this->VisaNumber ,
'CountryOfResidence'=>$this->CountryOfResidence,
'CityOfResidence'=>$this->CityOfResidence ,
'ResidenceAddress'=>$this->ResidenceAddress ,
'PassageDate'=>$this->PassageDate ,
'BorderCrossing'=>$this->BorderCrossing ,
'TTPaymentCategory'=>$this->TTPaymentCategory ,
'ArrivalOrganisation'=>$this->ArrivalOrganisation ,
'OfferedServiceType'=>$this->OfferedServiceType ,
'DateOfBirth'=>$this->DateOfBirth
            
        ];
    }

    private function generate_guid(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return $uuid;
        }
    }

}