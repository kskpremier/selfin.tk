<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 11:54
 */
namespace reception\repositories\DoorLock;

use reception\entities\DoorLock\DoorLock;
use reception\repositories\NotFoundException;

class DoorLockRepository
{
    public function get($id): DoorLock
    {
        if (!$doorLock = DoorLock::findOne($id)) {
            throw new NotFoundException('DoorLock is not found.');
        }
        return $doorLock;
    }
    public function findByMac($lockMac): DoorLock
    {
        //return DoorLock::findOne(['lock_mac' => $lockMac]);
        if (!$doorLock = DoorLock::findOne(['lock_mac' => $lockMac])) {
            throw new NotFoundException('DoorLock is not found.');
        }
        return $doorLock;
    }

    public function findByExternalId($id): DoorLock
    {
        if (!$doorLock = DoorLock::findOne(['external_id' => $id])) {
            throw new NotFoundException('DoorLock is not found.');
        }
        return $doorLock;
    }

    public function findByMyrRentId($id)
    {
        if (!$doorLock = DoorLock::findOne(['external_id' => $id])) {
            return null;
        }
        return $doorLock;
    }

    public function save(DoorLock $doorLock): void
    {
        if (!$doorLock->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(DoorLock $doorLock): void
    {
        if (!$doorLock->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}