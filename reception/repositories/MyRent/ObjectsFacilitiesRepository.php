<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsFacilities;
use reception\repositories\NotFoundException;

class ObjectsFacilitiesRepository 
{
    public function get($id): ObjectsFacilities    {
         if (! $objectsFacilities = ObjectsFacilities::findOne($id)) {
            throw new NotFoundException('ObjectsFacilities is not found.');
        }
    return  $objectsFacilities;
    }
    
    public function save(ObjectsFacilities  $objectsFacilities): void
    {
        if (! $objectsFacilities->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsFacilities  $objectsFacilities): void
    {
        if (! $objectsFacilities->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

