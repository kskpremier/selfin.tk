<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 04.07.17
 * Time: 22:30
 */

namespace reception\forms\MyRent;

use reception\entities\DoorLock\DoorLock;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class DoorLockInstallForm extends Model
{
//    public  $lockVersion;

    public $name;	//String	Y	Lockname
    public $id;	//external_id

    public $doorLock;
    //for keyboard password parameters

    public function __construct(array $config = [], $id=null)
    {
        parent::__construct($config);
        if ($id) {
            $this->doorLock = DoorLock::find()->where(['id'=>$id])->one();
        }
    }

    public function rules(): array
    {
        return [


            [['name'],'string', 'max' => 255],
            [['id'], 'integer'],
            //[['id'], 'integer'],
        ];
    }
//    protected function internalForms(): array
//    {
//        return [];
//    }
}