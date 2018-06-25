<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsTypesB2b;
use reception\repositories\NotFoundException;

class ObjectsRoomsTypesB2bRepository 
{
    public function get($id): ObjectsRoomsTypesB2b    {
         if (! $objectsRoomsTypesB2b = ObjectsRoomsTypesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsTypesB2b is not found.');
        }
    return  $objectsRoomsTypesB2b;
    }
    
    public function save(ObjectsRoomsTypesB2b  $objectsRoomsTypesB2b): void
    {
        if (! $objectsRoomsTypesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsTypesB2b  $objectsRoomsTypesB2b): void
    {
        if (! $objectsRoomsTypesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

