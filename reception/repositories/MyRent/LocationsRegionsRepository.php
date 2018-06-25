<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LocationsRegions;
use reception\repositories\NotFoundException;

class LocationsRegionsRepository 
{
    public function get($id): LocationsRegions    {
         if (! $locationsRegions = LocationsRegions::findOne($id)) {
            throw new NotFoundException('LocationsRegions is not found.');
        }
    return  $locationsRegions;
    }
    
    public function save(LocationsRegions  $locationsRegions): void
    {
        if (! $locationsRegions->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LocationsRegions  $locationsRegions): void
    {
        if (! $locationsRegions->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

