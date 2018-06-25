<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsAdditionalChargesB2b;
use reception\repositories\NotFoundException;

class ObjectsAdditionalChargesB2bRepository 
{
    public function get($id): ObjectsAdditionalChargesB2b    {
         if (! $objectsAdditionalChargesB2b = ObjectsAdditionalChargesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsAdditionalChargesB2b is not found.');
        }
    return  $objectsAdditionalChargesB2b;
    }
    
    public function save(ObjectsAdditionalChargesB2b  $objectsAdditionalChargesB2b): void
    {
        if (! $objectsAdditionalChargesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsAdditionalChargesB2b  $objectsAdditionalChargesB2b): void
    {
        if (! $objectsAdditionalChargesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

