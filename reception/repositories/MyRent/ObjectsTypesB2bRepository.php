<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsTypesB2b;
use reception\repositories\NotFoundException;

class ObjectsTypesB2bRepository 
{
    public function get($id): ObjectsTypesB2b    {
         if (! $objectsTypesB2b = ObjectsTypesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsTypesB2b is not found.');
        }
    return  $objectsTypesB2b;
    }
    
    public function save(ObjectsTypesB2b  $objectsTypesB2b): void
    {
        if (! $objectsTypesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsTypesB2b  $objectsTypesB2b): void
    {
        if (! $objectsTypesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

