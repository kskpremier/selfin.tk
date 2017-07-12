<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:37
 */

namespace reception\repositories\DoorLock;

use reception\entities\DoorLock\Key;
use reception\repositories\NotFoundException;

class KeyRepository
{
    public function get($id): Key
    {
        if (!$key = Key::findOne($id)) {
            throw new NotFoundException('Key is not found.');
        }
        return $key;
    }
    public function findAllByUser($userId): array
    {
        //return DoorLock::findOne(['lock_mac' => $lockMac]);
        if (!$key = Key::find(['user_id' => $userId])->all()) {
            throw new NotFoundException('Key is not found.');
        }
        return $key;
    }

    public function save(Key $key): void
    {
        if (!$key->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Key $key): void
    {
        if (!$key->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}