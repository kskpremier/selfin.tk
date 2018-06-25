<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsItems;
use reception\repositories\NotFoundException;

class ObjectsItemsRepository 
{
    public function get($id): ObjectsItems    {
         if (! $objectsItems = ObjectsItems::findOne($id)) {
            throw new NotFoundException('ObjectsItems is not found.');
        }
    return  $objectsItems;
    }
    
    public function save(ObjectsItems  $objectsItems): void
    {
        if (! $objectsItems->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsItems  $objectsItems): void
    {
        if (! $objectsItems->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

