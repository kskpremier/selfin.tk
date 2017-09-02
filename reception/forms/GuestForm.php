<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:33
 */


namespace reception\forms;

//use reception\entities\Booking\Guest;
//use reception\entities\User\User;
//use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class GuestForm extends Model
{
    public $firstName;
    public $secondName;
    public $contactEmail;
    public $applicationId;
    public $userId;
    public $documentId;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['first_name','second_name'],'string'],
            [['applicationId', 'documentId','userId'],'integer'],
        ];
    }

}