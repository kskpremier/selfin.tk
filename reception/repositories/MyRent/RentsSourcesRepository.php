<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsSources;
use reception\repositories\NotFoundException;

class RentsSourcesRepository 
{
    public function get($id): RentsSources    {
         if (! $rentsSources = RentsSources::findOne($id)) {
            throw new NotFoundException('RentsSources is not found.');
        }
    return  $rentsSources;
    }
    
    public function save(RentsSources  $rentsSources): void
    {
        if (! $rentsSources->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsSources  $rentsSources): void
    {
        if (! $rentsSources->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

