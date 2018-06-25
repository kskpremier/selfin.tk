<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsDistancesPlaces;
use reception\repositories\NotFoundException;

class ObjectsDistancesPlacesRepository 
{
    public function get($id): ObjectsDistancesPlaces    {
         if (! $objectsDistancesPlaces = ObjectsDistancesPlaces::findOne($id)) {
            throw new NotFoundException('ObjectsDistancesPlaces is not found.');
        }
    return  $objectsDistancesPlaces;
    }
    
    public function save(ObjectsDistancesPlaces  $objectsDistancesPlaces): void
    {
        if (! $objectsDistancesPlaces->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsDistancesPlaces  $objectsDistancesPlaces): void
    {
        if (! $objectsDistancesPlaces->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

