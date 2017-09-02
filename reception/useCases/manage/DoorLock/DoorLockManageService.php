<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 7:21
 */

namespace reception\useCases\manage\DoorLock;

use reception\entities\DoorLock\DoorLock;
use reception\forms\DoorLockForm;
use reception\repositories\DoorLock\DoorLockRepository;
use reception\entities\DoorLock\LockVersion;
use reception\useCases\manage\TTL\TTL;
use yii\httpclient\Client;

//use reception\repositories\DoorLock\LockVersionRepository;

class DoorLockManageService
{
    private $doorLockRepository;

    public function __construct(DoorLockRepository $doorLockRepository)
    {
        $this->doorLockRepository = $doorLockRepository;

    }
    public function init(DoorLockForm $form, $userId): DoorLock
    {

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
            $form->date
        );

        $this->doorLockRepository->save($doorLock);
        if ($this->initDoorLock($doorLock,$userId)) {
            return $doorLock;
        }
        return false;
    }

    private function initDoorLock($doorLock,$userId){
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
                'date'=>$doorLock->date//time()*1000
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

    public function installInApartment($id, Apartment $apartment){
        $doorLock = $this->doorLockRepository->get($id);
        $doorLock->setApartment($apartment);
        $this->doorLockRepository->save($doorLock);
    }

}