<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsFloors;
use reception\repositories\NotFoundException;

class ObjectsRoomsFloorsRepository 
{
    public function get($id): ObjectsRoomsFloors    {
         if (! $objectsRoomsFloors = ObjectsRoomsFloors::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsFloors is not found.');
        }
    return  $objectsRoomsFloors;
    }
    
    public function save(ObjectsRoomsFloors  $objectsRoomsFloors): void
    {
        if (! $objectsRoomsFloors->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsFloors  $objectsRoomsFloors): void
    {
        if (! $objectsRoomsFloors->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

