<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsGroups;
use reception\repositories\NotFoundException;

class RentsGroupsRepository 
{
    public function get($id): RentsGroups    {
         if (! $rentsGroups = RentsGroups::findOne($id)) {
            throw new NotFoundException('RentsGroups is not found.');
        }
    return  $rentsGroups;
    }
    
    public function save(RentsGroups  $rentsGroups): void
    {
        if (! $rentsGroups->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsGroups  $rentsGroups): void
    {
        if (! $rentsGroups->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

