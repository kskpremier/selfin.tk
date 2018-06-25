<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsTypes;
use reception\repositories\NotFoundException;

class ObjectsTypesRepository 
{
    public function get($id): ObjectsTypes    {
         if (! $objectsTypes = ObjectsTypes::findOne($id)) {
            throw new NotFoundException('ObjectsTypes is not found.');
        }
    return  $objectsTypes;
    }
    
    public function save(ObjectsTypes  $objectsTypes): void
    {
        if (! $objectsTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsTypes  $objectsTypes): void
    {
        if (! $objectsTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

