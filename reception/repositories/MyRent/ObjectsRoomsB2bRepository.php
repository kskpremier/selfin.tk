<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsB2b;
use reception\repositories\NotFoundException;

class ObjectsRoomsB2bRepository 
{
    public function get($id): ObjectsRoomsB2b    {
         if (! $objectsRoomsB2b = ObjectsRoomsB2b::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsB2b is not found.');
        }
    return  $objectsRoomsB2b;
    }
    
    public function save(ObjectsRoomsB2b  $objectsRoomsB2b): void
    {
        if (! $objectsRoomsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsB2b  $objectsRoomsB2b): void
    {
        if (! $objectsRoomsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

