<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsGroupsB2b;
use reception\repositories\NotFoundException;

class ObjectsGroupsB2bRepository 
{
    public function get($id): ObjectsGroupsB2b    {
         if (! $objectsGroupsB2b = ObjectsGroupsB2b::findOne($id)) {
            throw new NotFoundException('ObjectsGroupsB2b is not found.');
        }
    return  $objectsGroupsB2b;
    }
    
    public function save(ObjectsGroupsB2b  $objectsGroupsB2b): void
    {
        if (! $objectsGroupsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsGroupsB2b  $objectsGroupsB2b): void
    {
        if (! $objectsGroupsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

