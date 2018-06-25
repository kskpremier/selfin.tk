<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersMyrentContract;
use reception\repositories\NotFoundException;

class UsersMyrentContractRepository 
{
    public function get($id): UsersMyrentContract    {
         if (! $usersMyrentContract = UsersMyrentContract::findOne($id)) {
            throw new NotFoundException('UsersMyrentContract is not found.');
        }
    return  $usersMyrentContract;
    }
    
    public function save(UsersMyrentContract  $usersMyrentContract): void
    {
        if (! $usersMyrentContract->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersMyrentContract  $usersMyrentContract): void
    {
        if (! $usersMyrentContract->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

