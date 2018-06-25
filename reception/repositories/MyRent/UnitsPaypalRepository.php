<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitsPaypal;
use reception\repositories\NotFoundException;

class UnitsPaypalRepository 
{
    public function get($id): UnitsPaypal    {
         if (! $unitsPaypal = UnitsPaypal::findOne($id)) {
            throw new NotFoundException('UnitsPaypal is not found.');
        }
    return  $unitsPaypal;
    }
    
    public function save(UnitsPaypal  $unitsPaypal): void
    {
        if (! $unitsPaypal->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitsPaypal  $unitsPaypal): void
    {
        if (! $unitsPaypal->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

