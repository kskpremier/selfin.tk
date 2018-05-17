<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 1/18/18
 * Time: 4:13 PM
 */

namespace reception\forms\MyRent;

use yii\base\Model                                                           ;

/**
 * @property integer $id;
 * @property integer $user_id;
 * @property integer $rent_id;
 * @property string $name_first;            
 * @property string $name_last;             
 * @property string $vaucher;               
 * @property string $note;                  
 * @property string $email;                 
 * @property string $telephone;             
 * @property string $picture;               
 * @property string $picture_preview;       
 * @property string $picture_document_first;
 * @property string $picture_document_second
 * @property float $picture_comparison;
 * @property string $date_from;             
 * @property string $date_until;            
 * @property string $visible_on_invoice;    
 * @property string $city_tax;              
 * @property string $type;                  
 * @property string $option1;               
 * @property string $option2;               
 * @property string $request;               
 * @property string $created;               
 * @property string $changed;               
 * @property integer $id1;
 * @property integer $user_id1;
 * @property integer $guest_id;
 * @property string $guid;                  
 * @property string $document_type;         
 * @property string $document_number;       
 * @property string $gender;                
 * @property string $birth_country;         
 * @property string $birth_city;            
 * @property string $birth_date;            
 * @property string $birth_date_date;       
 * @property string $citizenship;           
 * @property string $visa_validity_date;    
 * @property string $visa_type;             
 * @property string $visa_number;           
 * @property string $residence_country;     
 * @property string $residence_city;        
 * @property string $residence_adress;      
 * @property string $passage_date;          
 * @property string $border_crossing;       
 * @property string $tt_payment_category;   
 * @property string $arrival_organisation;  
 * @property string $offered_service_type;  
 * @property string $checkin;               
 * @property string $checkout;              
 * @property string $verified;              
 * @property string $created1;              
 * @property string $changed1;              
 * @property string $object_name;           
 * @property string $from_date;             
 * @property string $until_date;            
 * @property string $country_citizenship;   
 * @property string $country_birth;         
 * @property string $country_code;          
 * @property integer $years;
 * @property string $birth_date1;           
 * @property string $city_tax_generated;    
*/
    
    class GuestForm extends Model
    {
        public $id;                                                // 9849,
        public $user_id;                                                // 837,
        public $rent_id;                                                // 653471,
        public $name_first;                                                // "Sergey",
        public $name_last;                                                // "Rybin",
        public $vaucher;                                                // null,
        public $note;                                                // null,
        public $email;                                                // null,
        public $telephone;                                                // null,
        public $picture;                                                // null,
        public $picture_preview;                                                // null,
        public $picture_document_first;                                                // null,
        public $picture_document_second;                                                // null,
        public $picture_comparison;                                                // 100.0,
        public $date_from;                                                // "2018-01-01T00                                                           ;                                                //00                                                           ;                                                //00",
        public $date_until;                                                // "2018-06-30T00                                                           ;                                                //00                                                           ;                                                //00",
        public $visible_on_invoice;                                                // "Y",
        public $city_tax;                                                // "Y",
        public $type;                                                // null,
        public $option1;                                                // null,
        public $option2;                                                // null,
        public $request;                                                // "{\"rent_id\                                                           ;                                                //\"653471\",\"eVisitor\                                                           ;                                                //true,\"name_first\                                                           ;                                                //\"Sergey\",\"name_last\                                                           ;                                                //\"Rybin\",\"citizenship\                                                           ;                                                //\"rus\",\"birth_country\                                                           ;                                                //\"rus\",\"gender\                                                           ;                                                //\"muu0161ki\",\"birth_city\                                                           ;                                                //null,\"residence_city\                                                           ;                                                //\"Opatija\",\"birth_date\                                                           ;                                                //\"1972-10-27\",\"document_number\                                                           ;                                                //\"530675118\",\"document_type\                                                           ;                                                //\"002\",\"residence_country\                                                           ;                                                //\"rus\",\"residence_adress\                                                           ;                                                //null,\"arrival_organisation\                                                           ;                                                //\"I\",\"offered_service_type\                                                           ;                                                //\"nou0107enje\",\"tt_payment_category\                                                           ;                                                //\"14\"}",
        public $created;                                                // "2018-01-11T16                                                           ;                                                //05                                                           ;                                                //02",
        public $changed;                                                // "2018-01-11T16                                                           ;                                                //05                                                           ;                                                //02",
        public $id1;                                                // 9854,
        public $user_id1;                                                // 611,
        public $guest_id;                                                // 9849,
        public $guid;                                                // "cc942fd5-f6e0-11e7-b893-0050563c3009",
        public $document_type;                                                // "002",
        public $document_number;                                                // "530675118",
        public $gender;                                                // "muški",
        public $birth_country;                                                // "rus",
        public $birth_city;                                                // "",
        public $birth_date;                                                // "1972-10-27",
        public $birth_date_date;                                                // "1972-10-27T00                                                           ;                                                //00                                                           ;                                                //00",
        public $citizenship;                                                // "rus",
        public $visa_validity_date;                                                // null,
        public $visa_type;                                                // null,
        public $visa_number;                                                // null,
        public $residence_country;                                                // "rus",
        public $residence_city;                                                // "Opatija",
        public $residence_adress;                                                // "",
        public $passage_date;                                                // null,
        public $border_crossing;                                                // null,
        public $tt_payment_category;                                                // "14",
        public $arrival_organisation;                                                // "I",
        public $offered_service_type;                                                // "noćenje",
        public $checkin;                                                // "N",
        public $checkout;                                                // "N",
        public $verified;                                                // "N",
        public $created1;                                                // "2018-01-11T16                                                           ;                                                //05                                                           ;                                                //02",
        public $changed1;                                                // "2018-01-11T16                                                           ;                                                //05                                                           ;                                                //02",
        public $object_name;                                                // "SRC apartment",
        public $from_date;                                                // "2018-01-01T00                                                           ;                                                //00                                                           ;                                                //00",
        public $until_date;                                                // "2018-06-30T00                                                           ;                                                //00                                                           ;                                                //00",
        public $country_citizenship;                                                // "Russian Federation",
        public $country_birth;                                                // "Russian Federation",
        public $country_code;                                                // "RU",
        public $years;                                                // 45,
        public $birth_date1;                                                // "1972-10-27",
        public $city_tax_generated;                                                // 0Ω


        public function __construct(array $config = [])
        {
            parent::__construct($config);
        }

        public function rules(): array
        {
            $rules = array_merge(
                parent::rules(), [
                    [['id', 'user_id', 'rent_id','id1', 'user_id1', 'guest_id','years','city_tax_generated'] , 'integer'],
                    [['picture_comparison'],'safe'],
                    [['name_first', 'name_last', 'vaucher', 'note', 'email', 'telephone', 'picture', 'picture_preview', 'picture_document_first', 'picture_document_second',
                    'date_from', 'date_until', 'visible_on_invoice', 'city_tax', 'type', 'option1', 'option2', 'request', 'created', 'changed', 'guid',
                    'document_type', 'document_number', 'gender', 'birth_country', 'birth_city', 'birth_date', 'birth_date_date', 'citizenship',
                    'visa_validity_date', 'visa_type', 'visa_number', 'residence_country', 'residence_city', 'residence_adress', 'passage_date', 'border_crossing', 'tt_payment_category', 'arrival_organisation',
                    'offered_service_type', 'checkin', 'checkout', 'verified', 'created1', 'changed1', 'object_name', 'from_date', 'until_date',
                    'country_citizenship', 'country_birth', 'country_code', 'birth_date1'], 'string']
                    ]
            );
            return $rules;
        }
    }