<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsNames;
use reception\repositories\NotFoundException;

class ObjectsNamesRepository 
{
    public function get($id): ObjectsNames    {
         if (! $objectsNames = ObjectsNames::findOne($id)) {
            throw new NotFoundException('ObjectsNames is not found.');
        }
    return  $objectsNames;
    }
    
    public function save(ObjectsNames  $objectsNames): void
    {
        if (! $objectsNames->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsNames  $objectsNames): void
    {
        if (! $objectsNames->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

