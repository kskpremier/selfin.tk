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
class DoorLockInstallForm extends Model
{

    public $lockAlias;
    public $apartmentId;
    public $id;
    public $lock_alias;
    public $apartmentList;


    public function rules(): array
    {
        return [


            [['lockAlias','lock_alias'], 'string', 'max' => 255],
            [['id'], 'integer'],
            [['id'], 'required'],
            [['apartmentId'], 'validateApartment', 'skipOnError' => true, 'message'=>'Invalid apartmentId'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['id' => 'id']],
            [['apartmentList'],'safe']

        ];
    }

    protected function internalForms(): array
    {
        return ['lockVersion'];
    }

    public function validateApartment()
    {
        if (!isset($this->apartmentId)) {
            $apartment = Apartment::find()->where(['id' => $this->apartmentId])->one();
            if (!isset($apartment)) {
                $this->addError('Wrong ID of apartment');
            }
        }
    }
}