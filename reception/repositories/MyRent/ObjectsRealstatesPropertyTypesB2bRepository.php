<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealstatesPropertyTypesB2b;
use reception\repositories\NotFoundException;

class ObjectsRealstatesPropertyTypesB2bRepository 
{
    public function get($id): ObjectsRealstatesPropertyTypesB2b    {
         if (! $objectsRealstatesPropertyTypesB2b = ObjectsRealstatesPropertyTypesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsRealstatesPropertyTypesB2b is not found.');
        }
    return  $objectsRealstatesPropertyTypesB2b;
    }
    
    public function save(ObjectsRealstatesPropertyTypesB2b  $objectsRealstatesPropertyTypesB2b): void
    {
        if (! $objectsRealstatesPropertyTypesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealstatesPropertyTypesB2b  $objectsRealstatesPropertyTypesB2b): void
    {
        if (! $objectsRealstatesPropertyTypesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

