<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersSuper;
use reception\repositories\NotFoundException;

class UsersSuperRepository 
{
    public function get($id): UsersSuper    {
         if (! $usersSuper = UsersSuper::findOne($id)) {
            throw new NotFoundException('UsersSuper is not found.');
        }
    return  $usersSuper;
    }
    
    public function save(UsersSuper  $usersSuper): void
    {
        if (! $usersSuper->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersSuper  $usersSuper): void
    {
        if (! $usersSuper->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

