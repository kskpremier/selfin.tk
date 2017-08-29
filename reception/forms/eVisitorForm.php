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

 * @property string bookingId
 *
 */
namespace reception\forms;

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
    //public $files;

    public $bookingId;

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
                [['firstName', 'secondName','country','city',
                    'identityData','numberOfDocument','gender','countryOfBirth','cityOfBirth','dateOfBirth','citizenshipOfBirth'], 'string'],
                //['files', 'each', 'rule' => ['image']],
                [['bookingId'],'validateBooking','message'=>'Booking with this ID should exist']
            ]
        );
        return $rules;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'startDate' => 'Arrival Date',
            'endDate' => 'Depature Date',
            'apartmentId' => 'Apartment ID',
            'numberOfTourist' => 'Number Of Tourists',
            'status'=>'Status'
        ];
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
//    public function beforeValidate(): bool
//    {
//        if (parent::beforeValidate()) {
//            $this->files = UploadedFile::getInstances($this, 'files');
//            return true;
//        }
//        return false;
//    }
//    public function load($data, $formName = null)
//    {
//        parent::load($data,$formName);
//        $scope = $formName === null ? $this->formName() : $formName;
//        if ($scope === '' && !empty($data)) {
//            $this->setAttributes($data);
//
//            return true;
//        } elseif (isset($data[$scope])) {
//            $this->setAttributes($data[$scope]);
//
//            return true;
//        }
//        return false;
//    }
//    public function setAttributes($values, $safeOnly = true)
//    {
//        if (is_array($values)) {
//            $attributes = array_flip($safeOnly ? $this->safeAttributes() : $this->attributes());
//            foreach ($values as $name => $value) {
//                if (isset($attributes[$name])) {
//                    $this->$name = $value;
//                } elseif ($safeOnly) {
//                    $this->onUnsafeAttribute($name, $value);
//                }
//            }
//        }
//        else if (is_string($values)){
//            $result = json_decode($values,true);
//            $attributes = array_flip($safeOnly ? $this->safeAttributes() : $this->attributes());
//            foreach ($result as $name => $value) {
//                if (isset($attributes[$name])) {
//                    $this->$name = $value;
//                } elseif ($safeOnly) {
//                    $this->onUnsafeAttribute($name, $value);
//                }
//            }
//        }
//    }


}


