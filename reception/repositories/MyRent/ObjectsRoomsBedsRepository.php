<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsBeds;
use reception\repositories\NotFoundException;

class ObjectsRoomsBedsRepository 
{
    public function get($id): ObjectsRoomsBeds    {
         if (! $objectsRoomsBeds = ObjectsRoomsBeds::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsBeds is not found.');
        }
    return  $objectsRoomsBeds;
    }
    
    public function save(ObjectsRoomsBeds  $objectsRoomsBeds): void
    {
        if (! $objectsRoomsBeds->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsBeds  $objectsRoomsBeds): void
    {
        if (! $objectsRoomsBeds->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

