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
 * @property string $first_name
 * @property string $second_name
 * @property string $number
 * @property integer $country_id
 * @property string $valid_before
 * @property integer $updatedTime
 * @property string $type
 * @property string $gender
 * @property string $city
 * @property integer $country_of_birth_id
 * @property integer $citizenship_of_birth_id
 * @property string $city_of_birth
 * @property string $date_of_birth
 * @property string $address
 * @property integer $document_type_id
 *
 *
 * @property PhotoImage $photo
 * @property integer $guest_id
 *
 *

 */
class Document extends \yii\db\ActiveRecord
{
    public const DOCUMENT_CREATED = 10;
    public const DOCUMENT_FACE_DETECTED = 11;
    public const SELFY_FACE_DETECTED = 12;
    public const FACED_MATCHED = 13;
    public const DOCUMENT_REGISTERED_MATCHED = 23;
    public const DOCUMENT_REGISTERED = 20;

    use EventTrait;

    /**
     * @param $firstName
     * @param $secondName
     * @param $identityData
     * @param $numberOfDocument
     * @param $gender
     * @param $country
     * @param $city
     * @param $countryOfBirth
     * @param $citizenshipOfBirth
     * @param $cityOfBirth
     * @param $dateOfBirth
     * @param $address
     * @param null $validBefore
     * @param null $updatedTime
     * @return Document
     */
    public static function create($firstName, $secondName,
                                  $identityData,
                                  $numberOfDocument, $gender,
                                  $country, $city,
                                  $countryOfBirth, $citizenshipOfBirth,
                                  $cityOfBirth, $dateOfBirth, $address, $validBefore=null, $updatedTime=null) :self
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
            $document->address = $address;
            $document->valid_before = date("Y-m-d",$validBefore/1000);
            $document->updated_at = ($updatedTime)?$updatedTime:time();

        return $document;
    }

    /**
     * @param $identityData
     * @param $gender
     * @param $country
     * @param $city
     * @param $countryOfBirth
     * @param $citizenshipOfBirth
     * @param $dateOfBirth
     * @param $documentNumber
     * @param $address
     * @param $firstName
     * @param $secondName
     * @param null $validBefore
     * @param null $updatedTime
     * @return Document
     */
    public function edit($identityData, $gender, $country, $city, $countryOfBirth, $citizenshipOfBirth, $dateOfBirth,
                         $documentNumber, $address, $firstName, $secondName, $validBefore = null, $updatedTime=null) :self

    {
        $this->document_type_id = $identityData;
        $this->gender = $gender;
        $this->city = $city;
        $this->first_name = $firstName;
        $this->second_name = $secondName;
        $this->country_of_birth_id = $countryOfBirth;
        $this->citizenship_of_birth_id = $citizenshipOfBirth;
        $this->country_id = $country;
        $this->number = $documentNumber;
        $this->address = $address;
        $this->date_of_birth = $dateOfBirth;
        $this->valid_before = ($validBefore)?$this->valid_before : date("Y-m-d",$validBefore/1000);
        $this->updated_at = ($updatedTime)?$updatedTime:time();

        return $this;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @return array
     */
    public function fields(){
        return [
            "name_first"=>$this->first_name,
            "name_last"=> $this->second_name,
            "citizenship"=> $this->citizenship->code,
            "birth_country"=>$this->birthCountry->code,
            "gender"=>(($this->gender=="male")||($this->gender=="M"))?  "muški":"ženski",
            "birth_city"=>$this->city_of_birth,
            "residence_city"=>$this->city_of_birth,
            "birth_date"=> $this->date_of_birth,
            "document_number"=>$this->number,
            "document_type"=>$this->documentType->code,
            "residence_country" => $this->citizenship->code,
            "residence_adress"  =>$this->address,
            "residence_city"=> $this->city,
            "arrival_organisation" => "I",
            "offered_service_type" => "noćenje",
            "tt_payment_category"  => "14"
        ];
    }

    /**
     * @return array
     */
    public function fieldsForMyRent(){
        $urls=[];
        foreach($this->documentImages as $image){
            $urls[]=$image->getUploadedFileUrl('file_name');
        }
        $face_url=[];
        foreach($this->faceImages as $face){
            $face_url[]=$face->getFaceFileUrl();
        }

        return [
            "name_first"=>$this->first_name,
            "name_last"=> $this->second_name,
            "citizenship"=> $this->citizenship->code,
            "birth_country"=>$this->birthCountry->code,
            "gender"=>(($this->gender=="male")||($this->gender=="M"))?  "M":"F",
            "birth_city"=>$this->city_of_birth,
            "residence_city"=>$this->city_of_birth,
            "birth_date"=> $this->date_of_birth,
            "document_number"=>$this->number,
            "document_type"=>$this->documentType->code,
            "residence_country" => $this->citizenship->code,
            "residence_adress"  =>$this->address,
            "residence_city"=> $this->city,
            "arrival_organisation" => "I",
            "offered_service_type" => "noćenje",
            "tt_payment_category"  => "14",
            "url_face"=> $face_url,
            "url_document"=> $urls

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
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBirthCitizenship()
    {
        return $this->hasOne(Country::className(), ['id' => 'citizenship_of_birth_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBirthCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_of_birth_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }
    /**
     * Return all images, connected with this Document
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(AbstractImage::className(), ['document_id' => 'id']);
    }
    /**
     * * Return all face selfy or camera images, connected with this Document
     * @return \yii\db\ActiveQuery
     */
    public function getSelfys()
    {
        return $this->hasMany(AbstractImage::className(), ['document_id' => 'id'])->andWhere(["album_id"=>AbstractImage::ALBUM_IMAGES]);
    }
    /**
     * * Return all document images, connected with this Document
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentImages()
    {
        return $this->hasMany(AbstractImage::className(), ['document_id' => 'id'])->andWhere(["album_id"=>AbstractImage::ALBUM_DOCUMENT]);
    }
    /**
     * * Return all document images, connected with this Document
     * @return \yii\db\ActiveQuery
     */
    public function getFaceImages()
    {
        return $this->hasMany(AbstractImage::className(), ['document_id' => 'id'])->andWhere(["album_id"=>AbstractImage::ALBUM_FACES]);
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

    /**
     * @param $image
     * @param $repositoryComparation
     * @return int
     */
    public function  getTheMostSimilarFaceMatchedProbability($image, $repositoryComparation) {
        $probability = 0;$comparation=null;
        foreach ($this->images as $documentImages)
            foreach ($documentImages->faces as $documentFace){
                foreach ($image->faces as $imageFace)
                    $comparation = $repositoryComparation->findMax($documentFace->id, $imageFace->face_id);
                    if ($comparation && $comparation->probability < $probability)
                        $probability = $comparation->probability;
        }
        return $probability;
    }

}
