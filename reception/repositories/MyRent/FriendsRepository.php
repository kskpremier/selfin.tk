<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Friends;
use reception\repositories\NotFoundException;

class FriendsRepository 
{
    public function get($id): Friends    {
         if (! $friends = Friends::findOne($id)) {
            throw new NotFoundException('Friends is not found.');
        }
    return  $friends;
    }
    
    public function save(Friends  $friends): void
    {
        if (! $friends->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Friends  $friends): void
    {
        if (! $friends->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

