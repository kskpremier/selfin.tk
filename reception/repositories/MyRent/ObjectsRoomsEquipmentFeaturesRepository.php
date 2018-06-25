<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsEquipmentFeatures;
use reception\repositories\NotFoundException;

class ObjectsRoomsEquipmentFeaturesRepository 
{
    public function get($id): ObjectsRoomsEquipmentFeatures    {
         if (! $objectsRoomsEquipmentFeatures = ObjectsRoomsEquipmentFeatures::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsEquipmentFeatures is not found.');
        }
    return  $objectsRoomsEquipmentFeatures;
    }
    
    public function save(ObjectsRoomsEquipmentFeatures  $objectsRoomsEquipmentFeatures): void
    {
        if (! $objectsRoomsEquipmentFeatures->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsEquipmentFeatures  $objectsRoomsEquipmentFeatures): void
    {
        if (! $objectsRoomsEquipmentFeatures->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

