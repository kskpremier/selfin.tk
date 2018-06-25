<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsDistancesUnits;
use reception\repositories\NotFoundException;

class ObjectsDistancesUnitsRepository 
{
    public function get($id): ObjectsDistancesUnits    {
         if (! $objectsDistancesUnits = ObjectsDistancesUnits::findOne($id)) {
            throw new NotFoundException('ObjectsDistancesUnits is not found.');
        }
    return  $objectsDistancesUnits;
    }
    
    public function save(ObjectsDistancesUnits  $objectsDistancesUnits): void
    {
        if (! $objectsDistancesUnits->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsDistancesUnits  $objectsDistancesUnits): void
    {
        if (! $objectsDistancesUnits->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

