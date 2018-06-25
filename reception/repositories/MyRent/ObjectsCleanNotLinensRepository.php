<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsCleanNotLinens;
use reception\repositories\NotFoundException;

class ObjectsCleanNotLinensRepository 
{
    public function get($id): ObjectsCleanNotLinens    {
         if (! $objectsCleanNotLinens = ObjectsCleanNotLinens::findOne($id)) {
            throw new NotFoundException('ObjectsCleanNotLinens is not found.');
        }
    return  $objectsCleanNotLinens;
    }
    
    public function save(ObjectsCleanNotLinens  $objectsCleanNotLinens): void
    {
        if (! $objectsCleanNotLinens->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsCleanNotLinens  $objectsCleanNotLinens): void
    {
        if (! $objectsCleanNotLinens->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

