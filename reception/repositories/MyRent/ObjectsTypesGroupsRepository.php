<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsTypesGroups;
use reception\repositories\NotFoundException;

class ObjectsTypesGroupsRepository 
{
    public function get($id): ObjectsTypesGroups    {
         if (! $objectsTypesGroups = ObjectsTypesGroups::findOne($id)) {
            throw new NotFoundException('ObjectsTypesGroups is not found.');
        }
    return  $objectsTypesGroups;
    }
    
    public function save(ObjectsTypesGroups  $objectsTypesGroups): void
    {
        if (! $objectsTypesGroups->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsTypesGroups  $objectsTypesGroups): void
    {
        if (! $objectsTypesGroups->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

