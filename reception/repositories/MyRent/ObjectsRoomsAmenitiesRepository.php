<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsAmenities;
use reception\repositories\NotFoundException;

class ObjectsRoomsAmenitiesRepository 
{
    public function get($id): ObjectsRoomsAmenities    {
         if (! $objectsRoomsAmenities = ObjectsRoomsAmenities::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsAmenities is not found.');
        }
    return  $objectsRoomsAmenities;
    }
    
    public function save(ObjectsRoomsAmenities  $objectsRoomsAmenities): void
    {
        if (! $objectsRoomsAmenities->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsAmenities  $objectsRoomsAmenities): void
    {
        if (! $objectsRoomsAmenities->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

