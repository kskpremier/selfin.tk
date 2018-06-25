<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersB2b;
use reception\repositories\NotFoundException;

class UsersB2bRepository 
{
    public function get($id): UsersB2b    {
         if (! $usersB2b = UsersB2b::findOne($id)) {
            throw new NotFoundException('UsersB2b is not found.');
        }
    return  $usersB2b;
    }
    
    public function save(UsersB2b  $usersB2b): void
    {
        if (! $usersB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersB2b  $usersB2b): void
    {
        if (! $usersB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

