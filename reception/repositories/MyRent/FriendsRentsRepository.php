<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\FriendsRents;
use reception\repositories\NotFoundException;

class FriendsRentsRepository 
{
    public function get($id): FriendsRents    {
         if (! $friendsRents = FriendsRents::findOne($id)) {
            throw new NotFoundException('FriendsRents is not found.');
        }
    return  $friendsRents;
    }
    
    public function save(FriendsRents  $friendsRents): void
    {
        if (! $friendsRents->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(FriendsRents  $friendsRents): void
    {
        if (! $friendsRents->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

