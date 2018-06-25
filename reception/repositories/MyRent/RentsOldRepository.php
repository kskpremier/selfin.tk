<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsOld;
use reception\repositories\NotFoundException;

class RentsOldRepository 
{
    public function get($id): RentsOld    {
         if (! $rentsOld = RentsOld::findOne($id)) {
            throw new NotFoundException('RentsOld is not found.');
        }
    return  $rentsOld;
    }
    
    public function save(RentsOld  $rentsOld): void
    {
        if (! $rentsOld->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsOld  $rentsOld): void
    {
        if (! $rentsOld->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

