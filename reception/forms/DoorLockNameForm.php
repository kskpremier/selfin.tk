<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 04.07.17
 * Time: 22:30
 */

namespace reception\forms;

use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\DoorLock;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class DoorLockNameForm extends Model
{

    public $lockAlias;
    public $lock_alias;
    public $id;

    public function rules(): array
    {
        return [

            [['lockAlias','lock_alias'], 'string', 'max' => 255],
            [['id'], 'integer'],
            [['id'], 'required'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

}