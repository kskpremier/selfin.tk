<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitsIban;
use reception\repositories\NotFoundException;

class UnitsIbanRepository 
{
    public function get($id): UnitsIban    {
         if (! $unitsIban = UnitsIban::findOne($id)) {
            throw new NotFoundException('UnitsIban is not found.');
        }
    return  $unitsIban;
    }
    
    public function save(UnitsIban  $unitsIban): void
    {
        if (! $unitsIban->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitsIban  $unitsIban): void
    {
        if (! $unitsIban->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

