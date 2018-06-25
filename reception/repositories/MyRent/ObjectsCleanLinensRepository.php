<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsCleanLinens;
use reception\repositories\NotFoundException;

class ObjectsCleanLinensRepository 
{
    public function get($id): ObjectsCleanLinens    {
         if (! $objectsCleanLinens = ObjectsCleanLinens::findOne($id)) {
            throw new NotFoundException('ObjectsCleanLinens is not found.');
        }
    return  $objectsCleanLinens;
    }
    
    public function save(ObjectsCleanLinens  $objectsCleanLinens): void
    {
        if (! $objectsCleanLinens->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsCleanLinens  $objectsCleanLinens): void
    {
        if (! $objectsCleanLinens->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

