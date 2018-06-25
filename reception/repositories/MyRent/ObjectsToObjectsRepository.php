<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsToObjects;
use reception\repositories\NotFoundException;

class ObjectsToObjectsRepository 
{
    public function get($id): ObjectsToObjects    {
         if (! $objectsToObjects = ObjectsToObjects::findOne($id)) {
            throw new NotFoundException('ObjectsToObjects is not found.');
        }
    return  $objectsToObjects;
    }
    
    public function save(ObjectsToObjects  $objectsToObjects): void
    {
        if (! $objectsToObjects->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsToObjects  $objectsToObjects): void
    {
        if (! $objectsToObjects->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

