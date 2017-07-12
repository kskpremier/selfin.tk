<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 7:26
 */
namespace reception\repositories\DoorLock;

use reception\entities\DoorLock\LockVersion;
use reception\repositories\NotFoundException;

class LockVersionRepository
{
    public function get($id): LockVersion
    {
        if (!$lockVersion= LockVersion::findOne($id)) {
            throw new NotFoundException('Order is not found.');
        }
        return $lockVersion;
    }

    public function save(LockVersion $lockVersion): void
    {
        if (!$lockVersion->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(LockVersion $lockVersion): void
    {
        if (!$lockVersion->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}