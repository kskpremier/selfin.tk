<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitsFis;
use reception\repositories\NotFoundException;

class UnitsFisRepository 
{
    public function get($id): UnitsFis    {
         if (! $unitsFis = UnitsFis::findOne($id)) {
            throw new NotFoundException('UnitsFis is not found.');
        }
    return  $unitsFis;
    }
    
    public function save(UnitsFis  $unitsFis): void
    {
        if (! $unitsFis->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitsFis  $unitsFis): void
    {
        if (! $unitsFis->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

