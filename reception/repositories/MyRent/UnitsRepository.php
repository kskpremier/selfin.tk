<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Units;
use reception\repositories\NotFoundException;

class UnitsRepository 
{
    public function get($id): Units    {
         if (! $units = Units::findOne($id)) {
            throw new NotFoundException('Units is not found.');
        }
    return  $units;
    }
    
    public function save(Units  $units): void
    {
        if (! $units->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Units  $units): void
    {
        if (! $units->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

