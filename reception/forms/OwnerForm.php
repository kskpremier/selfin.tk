<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:33
 */


namespace reception\forms;

use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class OwnerForm extends Model
{
    public $firstName;
    public $secondName;
    public $contactEmail;
    public $externalId;
    public $apartments;
    public $password;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['firstName','secondName','password','externalId'],'string'],
            [['contactEmail'],'email'],
        ];
    }
    public function isEmpty(){
        if (isset( $this->firstName) && isset( $this->firstName) && isset( $this->contactEmail) )
            return false;
        return true;
    }

}