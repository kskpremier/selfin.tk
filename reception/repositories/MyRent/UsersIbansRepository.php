<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersIbans;
use reception\repositories\NotFoundException;

class UsersIbansRepository 
{
    public function get($id): UsersIbans    {
         if (! $usersIbans = UsersIbans::findOne($id)) {
            throw new NotFoundException('UsersIbans is not found.');
        }
    return  $usersIbans;
    }
    
    public function save(UsersIbans  $usersIbans): void
    {
        if (! $usersIbans->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersIbans  $usersIbans): void
    {
        if (! $usersIbans->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

