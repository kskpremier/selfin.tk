<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsChecks;
use reception\repositories\NotFoundException;

class ObjectsChecksRepository 
{
    public function get($id): ObjectsChecks    {
         if (! $objectsChecks = ObjectsChecks::findOne($id)) {
            throw new NotFoundException('ObjectsChecks is not found.');
        }
    return  $objectsChecks;
    }
    
    public function save(ObjectsChecks  $objectsChecks): void
    {
        if (! $objectsChecks->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsChecks  $objectsChecks): void
    {
        if (! $objectsChecks->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

