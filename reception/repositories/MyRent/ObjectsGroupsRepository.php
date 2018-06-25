<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsGroups;
use reception\repositories\NotFoundException;

class ObjectsGroupsRepository 
{
    public function get($id): ObjectsGroups    {
         if (! $objectsGroups = ObjectsGroups::findOne($id)) {
            throw new NotFoundException('ObjectsGroups is not found.');
        }
    return  $objectsGroups;
    }
    
    public function save(ObjectsGroups  $objectsGroups): void
    {
        if (! $objectsGroups->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsGroups  $objectsGroups): void
    {
        if (! $objectsGroups->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

