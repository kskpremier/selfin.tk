<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 8:27
 */
namespace reception\entities\DoorLock;

use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property integer $id
 * @property String $lock_name
 * @property String $lock_alias
 * @property String $lock_mac
 * @property String $lock_key
 * @property integer $flag_pos
 * @property String $aes_key_str
 * @property String $admin_pwd
 * @property String $no_key_pwd
 * @property String $delete_pwd
 * @property String $pwd_info
 * @property String $timezone_raw_offset
 * @property String $timestamp
 * @property integer $special_value
 * @property String $last_update_date
 * @property int $lock_id
 * @property int $key_id
 * @property int $electric_quantity
 * @property int $apartment_id
 * @property String $hardware_revision
 * @property String  $firmware_revision
 * @property String $model_number
 * @property string $external_id
 * @property int $date
 * @property int $user_id
 * @property int $myrent_update
 *
 * @property LockVersion $lockVersion
 * @property Apartment $apartment

 */
class DoorLock extends ActiveRecord
{

    public static function create( $lockName, $lockAlias, $lockMac, $lockKey,
                                  $lockFlagPos, $aesKeyStr, $adminPwd, $noKeyPwd,
                                  $deletePwd, $pwdInfo, $timestamp, $specialValue,
                                  $timezoneRawOffset,
                                   $lockVersion, $modelNumber,
                                   $hardwareRevision, $firmwareRevision, $electricQuantity, $date, $user_id=null) :self
    {
        $doorLock = new static();
        $doorLock->lock_name = $lockName;
        $doorLock->lock_alias = $lockAlias;
        $doorLock->lock_mac = $lockMac;
        $doorLock->lock_key = $lockKey;
        $doorLock->flag_pos = $lockFlagPos;
        $doorLock->aes_key_str = $aesKeyStr;
        $doorLock->admin_pwd = $adminPwd;
        $doorLock->no_key_pwd = $noKeyPwd;
        $doorLock->delete_pwd = $deletePwd;
        $doorLock->pwd_info = $pwdInfo;
        $doorLock->timestamp = $timestamp;
        $doorLock->special_value = $specialValue;
        $doorLock->timezone_raw_offset = $timezoneRawOffset;
        $doorLock->lockVersion = $lockVersion;
        $doorLock->model_number = $modelNumber;
        $doorLock->hardware_revision = $hardwareRevision;
        $doorLock->firmware_revision = $firmwareRevision;
        $doorLock->electric_quantity = $electricQuantity;
        $doorLock->date = $date;
        $doorLock->user_id = $user_id;


        return $doorLock;
    }

    public function edit( $lockName, $lockAlias, $lockMac, $lockKey,
                         $lockFlagPos, $aesKeyStr, $adminPwd, $noKeyPwd,
                         $deletePwd, $pwdInfo, $timestamp, $specialValue,
                         $timezoneRawOffset, $modelNumber, $hardwareRevision, $firmwareRevision, $electricQuantity,$user_id=null)
    {
        $this->lock_name = $lockName;
        $this->lock_alias = $lockAlias;
        $this->lock_mac = $lockMac;
        $this->lock_key = $lockKey;
        $this->flag_pos = $lockFlagPos;
        $this->aes_key_str = $aesKeyStr;
        $this->admin_pwd = $adminPwd;
        $this->no_key_pwd = $noKeyPwd;
        $this->delete_pwd = $deletePwd;
        $this->pwd_info = $pwdInfo;
        $this->timestamp = $timestamp;
        $this->special_value = $specialValue;
        $this->timezone_raw_offset = $timezoneRawOffset;
        $this->last_update_date = time();
        $this->model_number = $modelNumber;
        $this->hardware_revision = $hardwareRevision;
        $this->firmware_revision = $firmwareRevision;
        $this->electric_quantity = $electricQuantity;
        $this->user_id = $user_id;

    }

    public function changeLockVersion($lockVersion): void
    {
        $this->lockVersion = $lockVersion;
    }
    public function setElectricQuantity($electricQuantity){
        $this->electric_quantity = $electricQuantity;
    }
    public function setApartment(Apartment $apartment, $user_id){
        $this->apartment = $apartment;
        $this->user_id = $user_id;
    }
    public function installInApartment($apartmentId, $name, $id, $user_id,$updateTime){
        $this->apartment_id = $apartmentId;
        $this->lock_alias = $name;
        $this->external_id = $id;
        $this->user_id = $user_id;
        $this->myrent_update = $updateTime;
    }

    public static function tableName(): string
    {
        return '{{%door_lock}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['lockVersion','apartment'],
            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLockVersion() {
        return $this->hasOne(LockVersion::className(), ['id' => 'lock_version_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartment()
    {
        return $this->hasOne(\backend\models\Apartment::className(), ['id' => 'apartment_id']);
    }
}