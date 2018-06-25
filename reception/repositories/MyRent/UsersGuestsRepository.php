<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersGuests;
use reception\repositories\NotFoundException;

class UsersGuestsRepository 
{
    public function get($id): UsersGuests    {
         if (! $usersGuests = UsersGuests::findOne($id)) {
            throw new NotFoundException('UsersGuests is not found.');
        }
    return  $usersGuests;
    }
    
    public function save(UsersGuests  $usersGuests): void
    {
        if (! $usersGuests->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersGuests  $usersGuests): void
    {
        if (! $usersGuests->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

