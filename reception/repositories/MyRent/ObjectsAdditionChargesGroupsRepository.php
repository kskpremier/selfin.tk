<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsAdditionChargesGroups;
use reception\repositories\NotFoundException;

class ObjectsAdditionChargesGroupsRepository 
{
    public function get($id): ObjectsAdditionChargesGroups    {
         if (! $objectsAdditionChargesGroups = ObjectsAdditionChargesGroups::findOne($id)) {
            throw new NotFoundException('ObjectsAdditionChargesGroups is not found.');
        }
    return  $objectsAdditionChargesGroups;
    }
    
    public function save(ObjectsAdditionChargesGroups  $objectsAdditionChargesGroups): void
    {
        if (! $objectsAdditionChargesGroups->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsAdditionChargesGroups  $objectsAdditionChargesGroups): void
    {
        if (! $objectsAdditionChargesGroups->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

