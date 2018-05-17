<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:37
 */

namespace reception\repositories\DoorLock;

use reception\dispatchers\EventDispatcher;
use reception\entities\DoorLock\Key;
use reception\repositories\NotFoundException;

class KeyRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

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
        if (!$key = Key::find()->where(['user_id' => $userId])->all()) {
            return [];
        }
        return $key;
    }
    public function findAdminKeyAllByUser($userId,$doorLock)
    {
        //return DoorLock::findOne(['lock_mac' => $lockMac]);
        if (!$key = Key::find()->where(['user_id' => $userId, 'type'=>99,'door_lock_id'=>$doorLock->id])->one()) {
            return null;
        }
        return $key;
    }



    public function save(Key $key): void
    {
        if (!$key->save()) {
            throw new \RuntimeException('Saving error.');
        }
        $this->dispatcher->dispatchAll($key->releaseEvents());
    }


    public function remove(Key $key): void
    {
        if (!$key->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        $this->dispatcher->dispatchAll($key->releaseEvents());
    }

}