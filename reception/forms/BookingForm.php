<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:06
 */

/**
 * @property string $apartmentId
 * @property string $externalApartmentId
 * @property string $firstName
 * @property string $secondName
 * @property string $contactEmail
 * @property string $externalApartmentId
 * @property integer $apartmentId
 * @property integer $numberOfTourist
 * @property string $apartmentName
 * @property integet $status
 */
namespace reception\forms;

use reception\entities\Booking\Guest;
use reception\entities\Apartment\Apartment;
use reception\entities\User\User;
use yii\helpers\ArrayHelper;


/**
 * @property LockVersionForm $lockVersion
 */
class BookingForm extends FormWithDates
{
    const STATUS_CANCELLED = 20;
    const STATUS_ACTIVE = 10;

    public $apartmentId;
    public $externalApartmentId;
    public $apartmentName;
    public $firstName;
    public $secondName;
    public $contactEmail;
    public $numberOfTourist;
    public $externalId;
    public $status;
    public $owner;


    /**
     * BookingForm constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->guests = new GuestForm();
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @inheritdoc
     */
    public function rules() : array
    {
        $rules = array_merge(
            parent::rules(),[
            [['firstName', 'secondName'], 'string', 'max'=>50],
            [['contactEmail'],'email'],
            [['externalApartmentId','externalId','apartmentName','owner'],'safe'],
            [['apartmentId', 'numberOfTourist','status'], 'integer'],
//            [['externalApartmentId','apartmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(),
//                'targetAttribute' => ['externalApartmentId'=>'external_id'],'message'=>'Apartment internal or external ID should exist'],
           // [['externalApartmentId','apartmentId'],'validateApartment','message'=>'Apartment internal or external ID should exist']
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
            'numberOfTourist' => 'Number Of Tourist',
            'status'=>'Status'
        ];
    }

    public function getApartmentId(){
        return (Apartment::find()->where(['or', ['external_id'=>$this->externalApartmentId], ['id' => $this->apartmentId]])->one())->id;
    }
    public function getGuestId(){
        return Guest::find()->where(['external_id'=>$this->externalApartmentId])->one();
    }

    public function validateApartment(){
        if (!isset($this->apartmentId) && !isset($this->externalApartmentId)){
            $this->addError('One of apartment Id should be set');
        }
        $apartment = Apartment::find()->where(['external_id'=>$this->externalApartmentId])->orWhere(['id'=>$this->apartmentId])->one();
        if (!isset($apartment)){
                $this->addError('Wrong ID of apartment');
        }
    }

    protected function internalForms(): array
    {
        return ['guests'];
    }


}