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
 */



use reception\forms\CompositeForm;
use reception\forms\MyRent\ApartmentForm;
use reception\forms\MyRent\WorkerForm;
use reception\forms\MyRent\OwnerForm;
use reception\entities\User\User;
use yii\base\Model;

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

    /**
     * BookingForm constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->apartments = new ApartmentForm();
//        $this->workers = new WorkerForm();
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

            [['contact_tel','contact_name','country_id'], 'string'],
            ['role','string'],
            ['role','required'],

            ['user_id', 'required'],
            [['user_id'],'validateUser','skipOnError' => true,'message'=>'There is no one User for creating Owner. Check user_id']
        ];
    }

    protected function internalForms(): array
    {
        //return ['apartments','owners','workers'];
        return ['apartments'];
    }

    public function validateUser(){
        if ($this->role === "owner") {
            $owner = User::find()->where(['external_id' => $this->user_id])->one();
            if (!isset($owner)) {
                $this->addError('No one User with id='.$this->user_id);
            }
        }
    }
}
