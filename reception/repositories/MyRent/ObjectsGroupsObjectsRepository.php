<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsGroupsObjects;
use reception\repositories\NotFoundException;

class ObjectsGroupsObjectsRepository 
{
    public function get($id): ObjectsGroupsObjects    {
         if (! $objectsGroupsObjects = ObjectsGroupsObjects::findOne($id)) {
            throw new NotFoundException('ObjectsGroupsObjects is not found.');
        }
    return  $objectsGroupsObjects;
    }
    
    public function save(ObjectsGroupsObjects  $objectsGroupsObjects): void
    {
        if (! $objectsGroupsObjects->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsGroupsObjects  $objectsGroupsObjects): void
    {
        if (! $objectsGroupsObjects->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

