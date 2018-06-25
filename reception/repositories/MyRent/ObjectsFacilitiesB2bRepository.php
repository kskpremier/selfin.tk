<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsFacilitiesB2b;
use reception\repositories\NotFoundException;

class ObjectsFacilitiesB2bRepository 
{
    public function get($id): ObjectsFacilitiesB2b    {
         if (! $objectsFacilitiesB2b = ObjectsFacilitiesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsFacilitiesB2b is not found.');
        }
    return  $objectsFacilitiesB2b;
    }
    
    public function save(ObjectsFacilitiesB2b  $objectsFacilitiesB2b): void
    {
        if (! $objectsFacilitiesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsFacilitiesB2b  $objectsFacilitiesB2b): void
    {
        if (! $objectsFacilitiesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

