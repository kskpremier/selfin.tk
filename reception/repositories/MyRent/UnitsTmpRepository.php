<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitsTmp;
use reception\repositories\NotFoundException;

class UnitsTmpRepository 
{
    public function get($id): UnitsTmp    {
         if (! $unitsTmp = UnitsTmp::findOne($id)) {
            throw new NotFoundException('UnitsTmp is not found.');
        }
    return  $unitsTmp;
    }
    
    public function save(UnitsTmp  $unitsTmp): void
    {
        if (! $unitsTmp->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitsTmp  $unitsTmp): void
    {
        if (! $unitsTmp->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

