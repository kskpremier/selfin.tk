<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\DoorsLocks;
use reception\repositories\NotFoundException;

class DoorsLocksRepository 
{
    public function get($id): DoorsLocks    {
         if (! $doorsLocks = DoorsLocks::findOne($id)) {
            throw new NotFoundException('DoorsLocks is not found.');
        }
    return  $doorsLocks;
    }
    
    public function save(DoorsLocks  $doorsLocks): void
    {
        if (! $doorsLocks->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(DoorsLocks  $doorsLocks): void
    {
        if (! $doorsLocks->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

