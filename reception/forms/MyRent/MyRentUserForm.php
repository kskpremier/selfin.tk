<?php
namespace reception\forms\MyRent;

/**
 * @property string $username
 * @property string $contact_name
 * @property string $contact_tel
 * @property string $id
 * @property string $role
 * @property string $password
 * @property string $contact_email
 * @property string $created
 * @property string $changed
 * @property string $guid
 * @property string $country_id
 * @property string $user_id
 *
 * @property RentForm $rent
 * @property ApartmentForm $apartments
 */



use reception\forms\BookingForm;
use reception\forms\BookingFormForNewApartments;
use reception\forms\CompositeForm;
use reception\forms\MyRent\ApartmentForm;
use reception\forms\MyRent\WorkerForm;
use reception\forms\MyRent\OwnerForm;
use reception\entities\User\User;
use reception\services\MyRent\MyRent;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class MyRentUserForm extends CompositeForm
{
    public $username;
    public $contact_name;
    public $contact_tel;
    public $id;
    public $role;
    public $password;
    public $contact_email;
    public $created;
    public $changed;
    public $guid;
    public $country_id;
    public $user_id; //при добавлении Ownera  требуется
    public $rent_id; //при добавлении Tourist требуется
    /**
     * BookingForm constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->apartments = new ApartmentForm();
      //  if ($this->role === "tourist")
   //         $this->rent = new RentForm();
//        $this->owners = new OwnerForm();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['contact_email', 'trim'],
//            ['email', 'required'],
            ['contact_email', 'email'],
            ['contact_email', 'string', 'max' => 255],
            [['created', 'changed', 'guid'], 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['id'],'integer'],
            ['id', 'required'],
            [['id'],'validateUser','skipOnError' => true,'message'=>'There is some problem with parameters user_id or rent_id.'],

            [['contact_tel','contact_name','country_id'], 'string'],
            //['role','string'],
            ['role','required'],

            //['user_id', 'required'],
            [['user_id'],'validateUser','skipOnError' => true,'message'=>'There is no one User for creating Owner. Check user_id'],
            [['rent_id'],'string','skipOnError' => true,'message'=>'There is no one Rent for creating Tourist. Check rent_id']
        ];
    }

    protected function internalForms(): array
    {
        //return ['apartments','owners','workers'];
        return ['apartments', 'rent'];
    }

    public function validateUser()
    {
        if ($this->role === "owner") {
            $owner = User::find()->where(['external_id' => $this->user_id])->one();
            if (!isset($owner)) {
                $this->addError('No one User with id=' . $this->user_id);
            }
        }
        if ($this->role === "tourist") {

            $bookingData = MyRent::getRent($this->rent_id);
            if (count($bookingData) == 0) {
                $this->addError('No one Rent with id=' . $this->rent_id);
            } else {
                $this->rent = new RentForm($bookingData[0]);
                $this->rent->load($bookingData[0], '');
            }
        }
    }
    public function rolesList(): array
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'name');
    }
}
