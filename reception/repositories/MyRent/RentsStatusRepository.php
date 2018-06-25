<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsStatus;
use reception\repositories\NotFoundException;

class RentsStatusRepository 
{
    public function get($id): RentsStatus    {
         if (! $rentsStatus = RentsStatus::findOne($id)) {
            throw new NotFoundException('RentsStatus is not found.');
        }
    return  $rentsStatus;
    }
    
    public function save(RentsStatus  $rentsStatus): void
    {
        if (! $rentsStatus->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsStatus  $rentsStatus): void
    {
        if (! $rentsStatus->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

