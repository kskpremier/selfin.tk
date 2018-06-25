<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealstatesPropertyTypes;
use reception\repositories\NotFoundException;

class ObjectsRealstatesPropertyTypesRepository 
{
    public function get($id): ObjectsRealstatesPropertyTypes    {
         if (! $objectsRealstatesPropertyTypes = ObjectsRealstatesPropertyTypes::findOne($id)) {
            throw new NotFoundException('ObjectsRealstatesPropertyTypes is not found.');
        }
    return  $objectsRealstatesPropertyTypes;
    }
    
    public function save(ObjectsRealstatesPropertyTypes  $objectsRealstatesPropertyTypes): void
    {
        if (! $objectsRealstatesPropertyTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealstatesPropertyTypes  $objectsRealstatesPropertyTypes): void
    {
        if (! $objectsRealstatesPropertyTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

