<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsEquipment;
use reception\repositories\NotFoundException;

class ObjectsRoomsEquipmentRepository 
{
    public function get($id): ObjectsRoomsEquipment    {
         if (! $objectsRoomsEquipment = ObjectsRoomsEquipment::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsEquipment is not found.');
        }
    return  $objectsRoomsEquipment;
    }
    
    public function save(ObjectsRoomsEquipment  $objectsRoomsEquipment): void
    {
        if (! $objectsRoomsEquipment->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsEquipment  $objectsRoomsEquipment): void
    {
        if (! $objectsRoomsEquipment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

