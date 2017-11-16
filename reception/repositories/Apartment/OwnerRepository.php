<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 16:25
 */

namespace reception\repositories\apartment;

use reception\entities\Apartment\Owner;
use reception\entities\User\User;
use reception\repositories\NotFoundException;

class OwnerRepository
{
    public function get($id): Owner
    {
        if (!$owner = Owner::findOne($id)) {
            throw new NotFoundException('Order is not found.');
        }
        return $owner;
    }

    public function save(Owner $owner): void
    {
        if (!$owner->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function saveMyRentOwner(\reception\entities\MyRent\Owner $owner): void
    {
        if (!$owner->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Owner $owner): void
    {
        if (!$owner->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function isOwnerExist($externalId, $contactEmail = null)
    {

        $user = User::findByUsername($contactEmail);

        if ($owner = Owner::findOne(['external_id' => $externalId, 'user_id' => (isset($user)) ? $user->id : null])) {
            return $owner;
        }
        return false;
    }
}