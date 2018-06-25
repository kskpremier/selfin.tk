<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsBedsType;
use reception\repositories\NotFoundException;

class ObjectsRoomsBedsTypeRepository 
{
    public function get($id): ObjectsRoomsBedsType    {
         if (! $objectsRoomsBedsType = ObjectsRoomsBedsType::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsBedsType is not found.');
        }
    return  $objectsRoomsBedsType;
    }
    
    public function save(ObjectsRoomsBedsType  $objectsRoomsBedsType): void
    {
        if (! $objectsRoomsBedsType->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsBedsType  $objectsRoomsBedsType): void
    {
        if (! $objectsRoomsBedsType->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

