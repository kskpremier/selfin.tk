<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsDistancesPlacesB2b;
use reception\repositories\NotFoundException;

class ObjectsDistancesPlacesB2bRepository 
{
    public function get($id): ObjectsDistancesPlacesB2b    {
         if (! $objectsDistancesPlacesB2b = ObjectsDistancesPlacesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsDistancesPlacesB2b is not found.');
        }
    return  $objectsDistancesPlacesB2b;
    }
    
    public function save(ObjectsDistancesPlacesB2b  $objectsDistancesPlacesB2b): void
    {
        if (! $objectsDistancesPlacesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsDistancesPlacesB2b  $objectsDistancesPlacesB2b): void
    {
        if (! $objectsDistancesPlacesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

