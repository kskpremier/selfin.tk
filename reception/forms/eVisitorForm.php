<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:06
 */

/**
 * @property string $firstName
 * @property string $secondName
 * @property string $identityData
 * @property string $numberOfDocument
 * @property string $gender
 * @property string $country
 * @property string $city
 * @property string countryOfBirth
 * @property string cityOfBirth
 * @property string dateOfBirth
 * @property string citizenshipOfBirth
 * @property string $address

 * @property string bookingId
 *
 */
namespace reception\forms;

use backend\models\Country;
use backend\models\DocumentType;
use reception\entities\Booking\Booking;
use yii\base\Model;
//use yii\web\UploadedFile;
//
/**
 * @property LockVersionForm $lockVersion
 */
class eVisitorForm extends Model
{
    public $firstName;
    public $secondName;
    public $identityData;
    public $numberOfDocument;
    public $gender;
    public $country;
    public $city;
    public $countryOfBirth;
    public $cityOfBirth;
    public $dateOfBirth;
    public $citizenshipOfBirth;
    public $validBefore;
    public $address;

    public $bookingId;
    public $booking;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
    /**
     * @inheritdoc
     */
    public function rules() : array
    {
        $rules = array_merge(
            parent::rules(),[
                [['firstName', 'secondName','country','city','address',
                    'identityData','numberOfDocument','gender','countryOfBirth','cityOfBirth','dateOfBirth','citizenshipOfBirth'], 'string'],
                [['validBefore'],'integer'],
                [['firstName', 'secondName'], 'validateNames'],
                [['identityData'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['identityData'=>'code'],'message'=>'Type of  Document ID should exist'],
                [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country'=>'code']],
                 [['country'],'validateCountry','message'=>'Country set on default value - hrv'],
                [['identityData'],'validateType','message'=>'Type of document set on default value - 027'],
                [['bookingId'],'validateBooking','message'=>'Booking with this ID should exist']
            ]
        );
        return $rules;
    }

    public function validateCountry(){

        $country = Country::find()->where(['code'=>$this->country])->one();
        if (!isset($country)){
            $this->country = "hrv"; //Croatia byDefault
        }

    }
    public function validateType(){

        $type = DocumentType ::find()->where(['code'=>$this->identityData])->one();
        if (!isset($type)){
            $this->identityData = "027"; //Osobna iskaznica (strana) by default
        }

    }

    public function validateNames(){

        $this->firstName = str_replace('1', 'I',$this->firstName);
        $this->secondName = str_replace('1', 'I',$this->secondName);
        $this->firstName = str_replace('5', 'S',$this->firstName);
        $this->secondName = str_replace('5', 'S',$this->secondName);

    }

    public function validateBooking(){
        if (!isset($this->bookingId)){
            $this->addError('Booking ID should be set');
        }
        $booking = Booking::find()->where(['external_id'=>$this->bookingId])->orWhere(['id'=>$this->bookingId])->one();
        if (!isset($booking)){
            $this->addError('Wrong ID of Booking');
        }
        $this->booking= $booking;
    }

    public function getCountry(){
        return Country::find()->where(['code'=>$this->country])->one();
    }


}


