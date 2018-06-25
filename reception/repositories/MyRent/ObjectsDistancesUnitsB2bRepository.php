<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsDistancesUnitsB2b;
use reception\repositories\NotFoundException;

class ObjectsDistancesUnitsB2bRepository 
{
    public function get($id): ObjectsDistancesUnitsB2b    {
         if (! $objectsDistancesUnitsB2b = ObjectsDistancesUnitsB2b::findOne($id)) {
            throw new NotFoundException('ObjectsDistancesUnitsB2b is not found.');
        }
    return  $objectsDistancesUnitsB2b;
    }
    
    public function save(ObjectsDistancesUnitsB2b  $objectsDistancesUnitsB2b): void
    {
        if (! $objectsDistancesUnitsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsDistancesUnitsB2b  $objectsDistancesUnitsB2b): void
    {
        if (! $objectsDistancesUnitsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

