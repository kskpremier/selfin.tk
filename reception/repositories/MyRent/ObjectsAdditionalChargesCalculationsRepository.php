<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsAdditionalChargesCalculations;
use reception\repositories\NotFoundException;

class ObjectsAdditionalChargesCalculationsRepository 
{
    public function get($id): ObjectsAdditionalChargesCalculations    {
         if (! $objectsAdditionalChargesCalculations = ObjectsAdditionalChargesCalculations::findOne($id)) {
            throw new NotFoundException('ObjectsAdditionalChargesCalculations is not found.');
        }
    return  $objectsAdditionalChargesCalculations;
    }
    
    public function save(ObjectsAdditionalChargesCalculations  $objectsAdditionalChargesCalculations): void
    {
        if (! $objectsAdditionalChargesCalculations->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsAdditionalChargesCalculations  $objectsAdditionalChargesCalculations): void
    {
        if (! $objectsAdditionalChargesCalculations->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

