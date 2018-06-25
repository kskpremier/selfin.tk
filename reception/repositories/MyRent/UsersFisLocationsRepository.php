<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersFisLocations;
use reception\repositories\NotFoundException;

class UsersFisLocationsRepository 
{
    public function get($id): UsersFisLocations    {
         if (! $usersFisLocations = UsersFisLocations::findOne($id)) {
            throw new NotFoundException('UsersFisLocations is not found.');
        }
    return  $usersFisLocations;
    }
    
    public function save(UsersFisLocations  $usersFisLocations): void
    {
        if (! $usersFisLocations->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersFisLocations  $usersFisLocations): void
    {
        if (! $usersFisLocations->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

