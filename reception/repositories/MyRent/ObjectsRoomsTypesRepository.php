<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRoomsTypes;
use reception\repositories\NotFoundException;

class ObjectsRoomsTypesRepository 
{
    public function get($id): ObjectsRoomsTypes    {
         if (! $objectsRoomsTypes = ObjectsRoomsTypes::findOne($id)) {
            throw new NotFoundException('ObjectsRoomsTypes is not found.');
        }
    return  $objectsRoomsTypes;
    }
    
    public function save(ObjectsRoomsTypes  $objectsRoomsTypes): void
    {
        if (! $objectsRoomsTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRoomsTypes  $objectsRoomsTypes): void
    {
        if (! $objectsRoomsTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

