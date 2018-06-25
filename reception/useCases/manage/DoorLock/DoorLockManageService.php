<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 7:21
 */

namespace reception\useCases\manage\DoorLock;

use function array_merge;
use function in_array;
use function isEmpty;
use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\DoorLock;
use reception\entities\DoorLock\Key;
use reception\forms\DoorLockForm;
use reception\repositories\DoorLock\DoorLockRepository;
use reception\entities\DoorLock\LockVersion;
use reception\repositories\DoorLock\KeyboardPwdRepository;
use reception\repositories\DoorLock\KeyRepository;
use reception\repositories\DoorLock\LockVersionRepository;
use reception\useCases\manage\TTL\TTL;
use Yii;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\web\ServerErrorHttpException;

//use reception\repositories\DoorLock\LockVersionRepository;

/**
 * Class DoorLockManageService
 * @package reception\useCases\manage\DoorLock
 */
class DoorLockManageService
{
    /**
     * @var DoorLockRepository
     */
    private $doorLockRepository;
    /**
     * @var LockVersionRepository
     */
    private $lockVersionRepository;

    /**
     * @var KeyRepository
     */
    private $keyRepository;
    private $keyboardPwdRepository;

    /**
     * DoorLockManageService constructor.
     * @param DoorLockRepository $doorLockRepository
     * @param LockVersionRepository $lockVersionRepository
     */
    public function __construct(DoorLockRepository $doorLockRepository, LockVersionRepository $lockVersionRepository, KeyRepository $keyRepository, KeyboardPwdRepository $keyboardPwdRepository )
    {
        $this->doorLockRepository = $doorLockRepository;
        $this->lockVersionRepository = $lockVersionRepository;
        $this->keyRepository = $keyRepository;
        $this->keyboardPwdRepository = $keyboardPwdRepository;

    }

    /**
     * @param DoorLockForm $form
     * @param int $userId
     * @return null|DoorLock
     */
    public function init(DoorLockForm $form,int  $userId)
    {

        $doorLock = $this->doorLockRepository->findByMac($form->lockMac);
            //если такой замоу уже был нами инициализирован - update
        if ($doorLock) {
             $this->edit($doorLock, $form,  $userId);
        }
        else {
            $lockVersion = LockVersion::create(
                $form->lockVersion->protocolType,
                $form->lockVersion->protocolVersion,
                $form->lockVersion->scene,
                $form->lockVersion->groupId,
                $form->lockVersion->orgId
            );

            $doorLock = DoorLock::create(
                $form->lockName,
                $form->lockAlias,
                $form->lockMac,
                $form->lockKey,
                $form->lockFlagPos,
                $form->aesKeyStr,
                $form->adminPwd,
                $form->noKeyPwd,
                $form->deletePwd,
                $form->pwdInfo,
                $form->timestamp,
                $form->specialValue,
                $form->timezoneRawOffset,
                $lockVersion,
                $form->modelNumber,
                $form->hardwareRevision,
                $form->firmwareRevision,
                $form->electricQuantity,
                $form->date,
                $userId
            );
        }
        $this->doorLockRepository->save($doorLock);
        //Send door lock info to Chiness
        if ($this->initDoorLock($doorLock, $userId)) {
            foreach($doorLock->keyboardPwds as $passcode) {
                $this->keyboardPwdRepository->remove($passcode);
            }
            $adminKey = $this->keyRepository->findAdminKeyAllByUser($userId,$doorLock);
                //Создаем админский ключ для юзера, если его нет
                if (!$adminKey) {
                    $adminKey = Key::create(0, 0, 99, null, $doorLock->id, $userId, "initialization admin key");
                    $this->keyRepository->save($adminKey);
                }
                return $doorLock;
            }
        else  {
            return null;
        }
    }

    /**
     * @param DoorLock $doorlock
     * @param DoorLockForm $form
     * @param int $userId
     * @return null|DoorLock
     */
    public function edit(DoorLock $doorlock, DoorLockForm $form, int $userId)
    {
//вношу изменения в версию замка
        $lockVersion = $doorlock->lockVersion->edit(
            $form->lockVersion->protocolType,
            $form->lockVersion->protocolVersion,
            $form->lockVersion->scene,
            $form->lockVersion->groupId,
            $form->lockVersion->orgId
        );
//вношу изменения в сам замок
        $doorlock->edit(
            $form->lockName,
            $form->lockAlias,
            $form->lockMac,
            $form->lockKey,
            $form->lockFlagPos,
            $form->aesKeyStr,
            $form->adminPwd,
            $form->noKeyPwd,
            $form->deletePwd,
            $form->pwdInfo,
            $form->timestamp,
            $form->specialValue,
            $form->timezoneRawOffset,
            $form->modelNumber,
            $form->hardwareRevision,
            $form->firmwareRevision,
            $form->electricQuantity,
            $form->date,
            $userId
           );
        //сохраняем сделанные изменения
        if ($this->lockVersionRepository->save($lockVersion) && $this->doorLockRepository->save($doorlock)) {

            $adminKey = $this->keyRepository->findAdminKeyAllByUser($userId,$doorlock);
            //Создаем админский ключ для юзера, если его нет
            if (!$adminKey) {
                $adminKey = Key::create(0, 0, 99, null, $doorlock->id, $userId, "initialization admin key");
                $this->keyRepository->save($adminKey);
            }
            return $doorlock;
        }
       else  return null;
    }


    /**
     * Asking Chiness API for built new door Lock and registered it in system
     * @param $doorLock
     * @param $userId
     * @return bool
     * @throws \yii\web\ServerErrorHttpException
     */
    private function initDoorLock($doorLock, $userId){
        $client = $client = new Client();
        $token = TTL::getToken($userId);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(TTL::TTL_URL_TO_INIT_DOOR_LOCK)
            ->setData([
                'accessToken' => $token->access_token,
                'clientId'=>$token->client_id,
                'lockName'=> $doorLock->lock_name,
                'lockAlias'=> $doorLock->lock_alias,
                'lockMac'=> $doorLock->lock_mac,
                'lockKey'=> $doorLock->lock_key,
                'lockFlagPos'=> $doorLock->flag_pos,
                'aesKeyStr'=> $doorLock->aes_key_str,
                'adminPwd'=> $doorLock->admin_pwd,
                'noKeyPwd'=> $doorLock->no_key_pwd,
                'deletePwd'=> $doorLock->delete_pwd,
                'pwdInfo'=> $doorLock->pwd_info,
                'timestamp'=> $doorLock->timestamp,
                'specialValue'=> $doorLock->special_value,
                'timezoneRawOffset'=> $doorLock->timezone_raw_offset,
                'lockVersion'=> $doorLock->lockVersion->lockVersionJson(),
                'date'=>$doorLock->date
                ])
            ->send();
        $data = json_decode($response->getContent(),true);
        if (is_array($data)) {
            if (array_key_exists('lockId', $data)) {
                $doorLock->lock_id = $data["lockId"];
                $doorLock->key_id = $data["keyId"];
                $this->doorLockRepository->save($doorLock);

                return true;
            }

            throw new ServerErrorHttpException("Can not init door lock with provider!");
        }
    }

    /**
     * @param $id
     * @param $apartment
     * @param $name
     * @param $user_id
     * @return bool
     */
    public function installInApartment($id, $apartment, $name, $user_id){
        $doorLock = $this->doorLockRepository->get($id);

        //к старым апартаментам добавляем еще одни - в которые надо поставить
//        $apartmentList = array_push($apartmentList,$apartment);
        $doorLock->setApartment($apartment);
        $doorLock->lock_alias = $name;
        $doorLock->user_id = $user_id;
        return $this->doorLockRepository->save($doorLock);
    }

    /**
     * @param $id
     * @param $apartment
     * @param $name
     * @param $user_id
     * @return bool
     */
    public function uninstallFromApartment($id, $apartment, $name, $user_id){
        $doorLock = $this->doorLockRepository->get($id);
        $apartmentList = $doorLock->getApartments()->select('id')->asArray()->all();
        $list=[];
        foreach($apartmentList as $key=>$value) {
            if ($value['id'] != $apartment->id)
                $list[]=$value['id'];
        }
        $doorLock->setApartment($list,  $user_id);
        $doorLock->lock_alias = $name;
        $doorLock->user_id = $user_id;
        return $this->doorLockRepository->save($doorLock);
    }

    /**
     * @param $doorLock
     * @param $apartmentIds
     * @param $name
     * @param $user_id
     * @return bool
     */
    public function unsetApartment($doorLock, $apartmentIds, $name, $user_id){
        $list=[];
        foreach ($doorLock->apartments as $apartment){
            // формируем список апартаментов, оставшихся в списке
            if (!in_array($apartment->id, $apartmentIds)) {
                $list=$apartment;
            }
        }
        $doorLock->setApartment($list,  $user_id);
        $doorLock->lock_alias = $name;
        if (count ($list)==0)
            $doorLock->user_id = $user_id;
        return $this->doorLockRepository->save($doorLock);
    }

    /**
     * Connect dorrlock with array of Apartments  (all previuose connections - will be deleted)
     * @param DoorLock $doorLock
     * @param array $apartmentId
     * @param string $name
     * @param int $user_id
     * @return bool
     */
    public function install(DoorLock $doorLock, array $apartmentId, string $name, int $user_id){
        $doorLock->apartments = $apartmentId;
        $doorLock->lock_alias = $name;
        $doorLock->user_id = $user_id;
        return $this->doorLockRepository->save($doorLock);
    }

    /**
     * Add one or more apartments to existing door lock
     * @param $door_lock_id
     * @param $apartmentId
     * @param string $name
     * @param int $user_id
     * @return bool
     */
    public function addApartment($door_lock_id, Apartment $apartment, string $name, int $user_id){
        $doorLock = $this->doorLockRepository->get($door_lock_id);
        //надо добавить к старым апартаментам новые
        if ($doorLock->apartments){
            $ids = ArrayHelper::getColumn($doorLock->apartments, 'id');
            $ids[] = $apartment->id;
            $doorLock->apartment_id = null; //если замок ставиться на несколько апартаментов, мы отвязываем его от "единственного апартамента"
        }
        else {
            $ids= $apartment->id;
            $doorLock->apartment_id = $apartment->id; //записываем в каком апартаменте стоит этот замок (то есть то, что он не общий для нескольких)
        }
        $doorLock->apartments = $ids;
        $doorLock->lock_alias = $name;
        $doorLock->user_id = $user_id;
        return $this->doorLockRepository->save($doorLock);
    }

    /**
     * Set door lock's name
     * @param $id
     * @param $lockAlias
     * @return bool
     */
    public function setName($id, $lockAlias) {
        $doorLock = $this->doorLockRepository->get($id);
        //надо добавить к старым апартаментам новые
        $doorLock->lock_alias = $lockAlias;
        return $this->doorLockRepository->save($doorLock);
    }

    /**
     * Remove apartment from list of conected apartments
     * @param $door_lock_id
     * @param $apartmentId
     * @param string $name
     * @param int $user_id
     * @return bool
     */
    public function removeApartment($door_lock_id, $apartmentId, string $name, int $user_id){
        $doorLock = $this->doorLockRepository->get($door_lock_id);
        //надо добавить к старым апартаментам новые
        $ids=[];$list=[];
        if ($doorLock->apartments){
            $ids = ArrayHelper::getColumn($doorLock->apartments, 'id');
            foreach ($ids as $id){
                // формируем список апартаментов, оставшихся в списке
                if ($id != $apartmentId) {
                    $list[]=$id;
                }
            }
        }
        $doorLock->apartments = $list;
        $doorLock->lock_alias = $name;
        $doorLock->user_id = $user_id;
        return $this->doorLockRepository->save($doorLock);
    }
}