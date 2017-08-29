<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:45
 */

namespace reception\repositories\DoorLock;

use reception\entities\DoorLock\KeyboardPwd;
use reception\repositories\NotFoundException;

class KeyboardPwdRepository
{
    public function get($id): KeyboardPwd
    {
        if (!$keyboardPwd = KeyboardPwd::findOne($id)) {
            throw new NotFoundException('KeyboardPwd is not found.');
        }
        return $keyboardPwd;
    }
//    public function findAllByUser($userId): array
//    {
//        //return DoorLock::findOne(['lock_mac' => $lockMac]);
//        if (!$keyboardPwd = KeyboardPwd::find(['user_id' => $userId])->all()) {
//            throw new NotFoundException('KeyboardPwd is not found.');
//        }
//        return $keyboardPwd;
//    }

    public function save(KeyboardPwd $keyboardPwd): void
    {
        if (!$keyboardPwd->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(KeyboardPwd $keyboardPwd): void
    {
        if (!$keyboardPwd->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}