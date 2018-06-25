<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsAdditionalCharges;
use reception\repositories\NotFoundException;

class ObjectsAdditionalChargesRepository 
{
    public function get($id): ObjectsAdditionalCharges    {
         if (! $objectsAdditionalCharges = ObjectsAdditionalCharges::findOne($id)) {
            throw new NotFoundException('ObjectsAdditionalCharges is not found.');
        }
    return  $objectsAdditionalCharges;
    }
    
    public function save(ObjectsAdditionalCharges  $objectsAdditionalCharges): void
    {
        if (! $objectsAdditionalCharges->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsAdditionalCharges  $objectsAdditionalCharges): void
    {
        if (! $objectsAdditionalCharges->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

