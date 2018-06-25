<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRooms;
use reception\repositories\NotFoundException;

class ObjectsRoomsRepository 
{
    public function get($id): ObjectsRooms    {
         if (! $objectsRooms = ObjectsRooms::findOne($id)) {
            throw new NotFoundException('ObjectsRooms is not found.');
        }
    return  $objectsRooms;
    }
    
    public function save(ObjectsRooms  $objectsRooms): void
    {
        if (! $objectsRooms->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRooms  $objectsRooms): void
    {
        if (! $objectsRooms->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

