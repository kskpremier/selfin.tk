<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Offices;
use reception\repositories\NotFoundException;

class OfficesRepository 
{
    public function get($id): Offices    {
         if (! $offices = Offices::findOne($id)) {
            throw new NotFoundException('Offices is not found.');
        }
    return  $offices;
    }
    
    public function save(Offices  $offices): void
    {
        if (! $offices->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Offices  $offices): void
    {
        if (! $offices->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

