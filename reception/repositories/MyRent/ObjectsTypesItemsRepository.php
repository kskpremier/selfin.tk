<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsTypesItems;
use reception\repositories\NotFoundException;

class ObjectsTypesItemsRepository 
{
    public function get($id): ObjectsTypesItems    {
         if (! $objectsTypesItems = ObjectsTypesItems::findOne($id)) {
            throw new NotFoundException('ObjectsTypesItems is not found.');
        }
    return  $objectsTypesItems;
    }
    
    public function save(ObjectsTypesItems  $objectsTypesItems): void
    {
        if (! $objectsTypesItems->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsTypesItems  $objectsTypesItems): void
    {
        if (! $objectsTypesItems->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

