<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsMaintenance;
use reception\repositories\NotFoundException;

class ObjectsMaintenanceRepository 
{
    public function get($id): ObjectsMaintenance    {
         if (! $objectsMaintenance = ObjectsMaintenance::findOne($id)) {
            throw new NotFoundException('ObjectsMaintenance is not found.');
        }
    return  $objectsMaintenance;
    }
    
    public function save(ObjectsMaintenance  $objectsMaintenance): void
    {
        if (! $objectsMaintenance->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsMaintenance  $objectsMaintenance): void
    {
        if (! $objectsMaintenance->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

