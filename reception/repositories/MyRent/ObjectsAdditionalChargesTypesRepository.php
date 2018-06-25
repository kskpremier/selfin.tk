<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsAdditionalChargesTypes;
use reception\repositories\NotFoundException;

class ObjectsAdditionalChargesTypesRepository 
{
    public function get($id): ObjectsAdditionalChargesTypes    {
         if (! $objectsAdditionalChargesTypes = ObjectsAdditionalChargesTypes::findOne($id)) {
            throw new NotFoundException('ObjectsAdditionalChargesTypes is not found.');
        }
    return  $objectsAdditionalChargesTypes;
    }
    
    public function save(ObjectsAdditionalChargesTypes  $objectsAdditionalChargesTypes): void
    {
        if (! $objectsAdditionalChargesTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsAdditionalChargesTypes  $objectsAdditionalChargesTypes): void
    {
        if (! $objectsAdditionalChargesTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

