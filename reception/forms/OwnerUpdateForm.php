<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:33
 */


namespace reception\forms;

use reception\entities\Apartment\Apartment;
use reception\entities\User\User;
use reception\forms\manage\ApartmentsForm;
use reception\forms\CompositeForm;
//use reception\forms\manage\MetaForm;/**/

use reception\entities\Apartment\Owner;


/**
 * @property String $firstName;
 * @property String $secondName;
 * @property String $contactEmail;
 * @property String $externalId;
 * @property Apartment[] $apartments;
 * @property String $password;
 * @property integer $id;
 */
class OwnerUpdateForm extends CompositeForm
{
    public $firstName;
    public $secondName;
    public $contactEmail;
    public $externalId;
   // public $apartments;
    public $password;
    public $id;
    private $userId ;

    public function __construct(Owner $owner, array $config = [])
    {
        $names = $pieces = explode("_", $owner->user->username);
        $this->firstName = (array_key_exists (1,$names) )? $names[1] : '';
        $this->secondName = (array_key_exists (0,$names) )? $names[0] : '';
        $this->contactEmail = $owner->user->email;
        $this->externalId = $owner->external_id;
        $this->apartments =  new ApartmentsForm($owner);
        $this->id = $owner->id;
        $this->userId = $owner->user->id;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['firstName','secondName','password','externalId'],'string'],
            [['id'],'integer'],
            [['contactEmail'],'email'],
            [['contactEmail'], 'validateEmail','message'=>'Contact email is already exist'],
        ];
    }
    public function isEmpty(){
        if (isset( $this->firstName) && isset( $this->firstName) && isset( $this->contactEmail) )
            return false;
        return true;
    }

    public function validateEmail()
    {
        $email = User::find()->where(['email' => $this->contactEmail])->andWhere(['not',['id' => $this->userId]])->one();
            if (isset($email)) {
                $this->addError('Contact email is already exist');
            }
            else return true;

    }
    public function apartmentsList(): array
    {
        return ArrayHelper::map(Apartment::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return [ 'apartments'];
    }

}