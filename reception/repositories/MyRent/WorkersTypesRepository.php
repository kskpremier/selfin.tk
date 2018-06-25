<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\WorkersTypes;
use reception\repositories\NotFoundException;

class WorkersTypesRepository 
{
    public function get($id): WorkersTypes    {
         if (! $workersTypes = WorkersTypes::findOne($id)) {
            throw new NotFoundException('WorkersTypes is not found.');
        }
    return  $workersTypes;
    }
    
    public function save(WorkersTypes  $workersTypes): void
    {
        if (! $workersTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(WorkersTypes  $workersTypes): void
    {
        if (! $workersTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

