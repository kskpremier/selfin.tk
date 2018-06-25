<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsCleaning;
use reception\repositories\NotFoundException;

class RentsCleaningRepository 
{
    public function get($id): RentsCleaning    {
         if (! $rentsCleaning = RentsCleaning::findOne($id)) {
            throw new NotFoundException('RentsCleaning is not found.');
        }
    return  $rentsCleaning;
    }
    
    public function save(RentsCleaning  $rentsCleaning): void
    {
        if (! $rentsCleaning->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsCleaning  $rentsCleaning): void
    {
        if (! $rentsCleaning->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

