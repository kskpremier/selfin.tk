<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Locations;
use reception\repositories\NotFoundException;

class LocationsRepository 
{
    public function get($id): Locations    {
         if (! $locations = Locations::findOne($id)) {
            throw new NotFoundException('Locations is not found.');
        }
    return  $locations;
    }
    
    public function save(Locations  $locations): void
    {
        if (! $locations->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Locations  $locations): void
    {
        if (! $locations->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

