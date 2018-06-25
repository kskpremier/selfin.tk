<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LocationsAreas;
use reception\repositories\NotFoundException;

class LocationsAreasRepository 
{
    public function get($id): LocationsAreas    {
         if (! $locationsAreas = LocationsAreas::findOne($id)) {
            throw new NotFoundException('LocationsAreas is not found.');
        }
    return  $locationsAreas;
    }
    
    public function save(LocationsAreas  $locationsAreas): void
    {
        if (! $locationsAreas->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LocationsAreas  $locationsAreas): void
    {
        if (! $locationsAreas->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

