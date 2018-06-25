<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsDistances;
use reception\repositories\NotFoundException;

class ObjectsDistancesRepository 
{
    public function get($id): ObjectsDistances    {
         if (! $objectsDistances = ObjectsDistances::findOne($id)) {
            throw new NotFoundException('ObjectsDistances is not found.');
        }
    return  $objectsDistances;
    }
    
    public function save(ObjectsDistances  $objectsDistances): void
    {
        if (! $objectsDistances->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsDistances  $objectsDistances): void
    {
        if (! $objectsDistances->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

