<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsAmenites;
use reception\repositories\NotFoundException;

class ObjectsAmenitesRepository 
{
    public function get($id): ObjectsAmenites    {
         if (! $objectsAmenites = ObjectsAmenites::findOne($id)) {
            throw new NotFoundException('ObjectsAmenites is not found.');
        }
    return  $objectsAmenites;
    }
    
    public function save(ObjectsAmenites  $objectsAmenites): void
    {
        if (! $objectsAmenites->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsAmenites  $objectsAmenites): void
    {
        if (! $objectsAmenites->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

