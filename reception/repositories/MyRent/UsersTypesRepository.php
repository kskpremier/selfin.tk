<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersTypes;
use reception\repositories\NotFoundException;

class UsersTypesRepository 
{
    public function get($id): UsersTypes    {
         if (! $usersTypes = UsersTypes::findOne($id)) {
            throw new NotFoundException('UsersTypes is not found.');
        }
    return  $usersTypes;
    }
    
    public function save(UsersTypes  $usersTypes): void
    {
        if (! $usersTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersTypes  $usersTypes): void
    {
        if (! $usersTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

