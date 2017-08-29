<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 02.08.17
 * Time: 17:51
 */

namespace reception\entities\Booking;

use backend\models\Citizenship;
use backend\models\DocumentType;
use backend\models\PhotoImage;
use reception\entities\User\User;
use reception\entities\Booking\Guest;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\Booking\DocumentPhoto;
use Yii;

/**
 * This is the model class for table "guest".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $number
 * @property integer $country_id
 *
 * @property string $type
 * @property string $gender
 * @property string $city
 * @property integer $country_of_birth_id
 * @property integer $citizenship_of_birth_id
 * @property string $city_of_birth
 * @property string $date_of_birth
 * @property integer $document_type_id
 *
 * @property PhotoImage $photo
 * @property integer $guest_id
 *
 *

 */
class Document extends \yii\db\ActiveRecord
{
    public static function create(  $firstName, $secondName, 
                                    $identityData,
                                    $numberOfDocument, $gender,
                                    $country,  $city,
                                    $countryOfBirth,$citizenshipOfBirth,
                                    $cityOfBirth, $dateOfBirth) :self
    {

            $document = new static();

            $document->document_type_id = $identityData;
            $document->gender = $gender;
            $document->city = $city;
            $document->country_of_birth_id = $countryOfBirth;
            $document->citizenship_of_birth_id = $citizenshipOfBirth;
            $document->city_of_birth = $cityOfBirth;
            $document->date_of_birth = $dateOfBirth;
            $document->first_name = $firstName;
            $document->second_name = $secondName;
            $document->number = $numberOfDocument;
            $document->country_id = $country;

        return $document;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    public function fields(){
        return [
            "b2b_id"=> 146,
           // "object_id"=> 6269,
           // "date_from"=>  date("Y-m-d",  strtotime($this->date_of_birth)),
           // "date_until"=> date("Y-m-d",  strtotime($this->date_of_birth)),
           // "rent_id"=> 611338,

            "erp_id"=>"01_01_01",

            "name_first"=>$this->first_name,
            "name_last"=> $this->second_name,
            "email"=>$this->guest->contact_email,
            "terrace"=> "Y",
            "tel"=> "+38511234567",
            "citizenship"=> $this->citizenship->code,
            "birth_country"=>$this->birthCountry->code,
            "gender"=>$this->gender,
            "birth_city"=>$this->city_of_birth,
            "residence_city"=>$this->city_of_birth,
            "birth_date"=> date("Y-m-d",  strtotime($this->date_of_birth)),
            "document_number"=>$this->number,
            "document_type"=>$this->documentType->code
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
    public function getCitizenship()
    {
        return $this->hasOne(Citizenship::className(), ['id' => 'country_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBirthCitizenship()
    {
        return $this->hasOne(Citizenship::className(), ['id' => 'citizenship_of_birth_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBirthCountry()
    {
        return $this->hasOne(Citizenship::className(), ['id' => 'country_of_birth_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(DocumentPhoto::className(), ['document_id' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['guest','documentType','citizenship','birthCitizenship','birthCountry','images'],
            ],
        ];
    }

}
