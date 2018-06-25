<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Users;
use reception\repositories\NotFoundException;

class UsersRepository 
{
    public function get($id): Users    {
         if (! $users = Users::findOne($id)) {
            throw new NotFoundException('Users is not found.');
        }
    return  $users;
    }
    
    public function save(Users  $users): void
    {
        if (! $users->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Users  $users): void
    {
        if (! $users->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

