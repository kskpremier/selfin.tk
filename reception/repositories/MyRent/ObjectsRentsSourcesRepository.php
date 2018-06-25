<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRentsSources;
use reception\repositories\NotFoundException;

class ObjectsRentsSourcesRepository 
{
    public function get($id): ObjectsRentsSources    {
         if (! $objectsRentsSources = ObjectsRentsSources::findOne($id)) {
            throw new NotFoundException('ObjectsRentsSources is not found.');
        }
    return  $objectsRentsSources;
    }
    
    public function save(ObjectsRentsSources  $objectsRentsSources): void
    {
        if (! $objectsRentsSources->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRentsSources  $objectsRentsSources): void
    {
        if (! $objectsRentsSources->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

