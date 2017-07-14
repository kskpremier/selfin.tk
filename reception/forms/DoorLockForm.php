<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 04.07.17
 * Time: 22:30
 */

namespace reception\forms;

use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class DoorLockForm extends CompositeForm
{
//    public  $lockVersion;

    public $lockName;	//String	Y	Lockname
    public $lockAlias;	//String	N	Lock alias
    public $lockMac	;//String	Y	Lock mac address
    public $lockKey	;//String	Y	Critical information locked door, open the door of
    public $lockId;//Integer	Y	Lock id
    public $keyId;//Int	Administrator key id
    public $lockFlagPos	;//Int	Y	Lock flag
    public $aesKeyStr	;//String	Y	Aes encryption and decryption Key
    public $adminPwd	;//String	N	The administrator password lock, lock management related operations required to carry, check administrator privileges
    public $noKeyPwd	;//String	N	Keyboard administrator password, administrator password to open the door with the
    public $deletePwd	;//String	N	Clear codes, passwords for emptying locked
    public $pwdInfo	;//String	N	Password data, for generating the password, the SDK provides
    public $timestamp	;//String	N	Time stamp, used to initialize the password data, SDK provided
    public $specialValue	;//Int	N	Lock feature value that indicates the function of the lock support
    public $timezoneRawOffset	;//Long	N	When the lock area where the number of poor and UTC time zone, the unit milliseconds, default (China time zone) 28,800,000
    public $date	;//Long	Y	Current time (milliseconds)
    public $modelNumber	;//String	Y	Aes encryption and decryption Key
    public $hardwareRevision;//String	N	The administrator password lock, lock management related operations required to carry, check administrator privileges
    public $firmwareRevision;//String	N	Keyboard administrator password, administrator password to open the door with the
    public $electricQuantity;//String	N	Keyboard administrator password, administrator password to open the door with the

    //for keyboard password parameters

    public function __construct(array $config = [])
    {
        $this->lockVersion = new LockVersionForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [


            [['lockName', 'lockAlias','lockMac','lockKey','aesKeyStr','adminPwd','noKeyPwd'
                ,'modelNumber','hardwareRevision','firmwareRevision'],
                'string', 'max' => 255],
            [['pwdInfo','deletePwd','timestamp','date'],'safe'],
            [['lockFlagPos', 'specialValue','electricQuantity'],'integer'],
            [['date', 'timezoneRawOffset'], 'double'],
            [['lockName', 'lockMac','aesKeyStr','lockFlagPos','date','lockKey'], 'required'],
        ];
    }
    protected function internalForms(): array
    {
        return ['lockVersion'];
    }
}