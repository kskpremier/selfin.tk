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
 * @property boolean $eKey
 *
 * @property Apartment $apartment
 */
namespace reception\forms;

use reception\entities\Booking\Guest;
use reception\entities\Apartment\Apartment;
use reception\entities\User\User;
use yii\helpers\ArrayHelper;


/**
 * @property LockVersionForm $lockVersion
 */
class BookingFormForNewApartments extends FormWithDates
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
    public $eKey;

    public $apartment;


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
                [['externalApartmentId','externalId','apartmentName','owner','apartmentId','numberOfTourist','eKey'],'safe'],
                [[ 'status'], 'integer'],
//            [['externalApartmentId','apartmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(),
//                'targetAttribute' => ['externalApartmentId'=>'external_id'],'message'=>'Apartment internal or external ID should exist'],
//                [['externalApartmentId','apartmentId'],'validateApartment','message'=>'Apartment internal or external ID should exist']
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
        return Guest::find()->joinWith('bookings')->where(['booking.external_id'=>$this->externalId])->one();
    }

    public function validateApartment(){
        if (!isset($this->apartmentId) && !isset($this->externalApartmentId)){
            $this->addError('One of apartment Id should be set');
            return ;
        }
        $apartment = Apartment::find()->where(['external_id'=>$this->externalApartmentId])->orWhere(['id'=>$this->apartmentId])->one();
        if (!isset($apartment)){
            $this->addError('Wrong ID of apartment');
        }
        $this->apartment = $apartment;
    }

    protected function internalForms(): array
    {
        return ['guests'];
    }


}