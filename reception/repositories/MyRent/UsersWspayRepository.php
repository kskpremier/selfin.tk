<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersWspay;
use reception\repositories\NotFoundException;

class UsersWspayRepository 
{
    public function get($id): UsersWspay    {
         if (! $usersWspay = UsersWspay::findOne($id)) {
            throw new NotFoundException('UsersWspay is not found.');
        }
    return  $usersWspay;
    }
    
    public function save(UsersWspay  $usersWspay): void
    {
        if (! $usersWspay->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersWspay  $usersWspay): void
    {
        if (! $usersWspay->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

