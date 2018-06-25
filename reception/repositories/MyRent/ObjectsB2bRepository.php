<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsB2b;
use reception\repositories\NotFoundException;

class ObjectsB2bRepository 
{
    public function get($id): ObjectsB2b    {
         if (! $objectsB2b = ObjectsB2b::findOne($id)) {
            throw new NotFoundException('ObjectsB2b is not found.');
        }
    return  $objectsB2b;
    }
    
    public function save(ObjectsB2b  $objectsB2b): void
    {
        if (! $objectsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsB2b  $objectsB2b): void
    {
        if (! $objectsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

