<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsItems;
use reception\repositories\NotFoundException;

class RentsItemsRepository 
{
    public function get($id): RentsItems    {
         if (! $rentsItems = RentsItems::findOne($id)) {
            throw new NotFoundException('RentsItems is not found.');
        }
    return  $rentsItems;
    }
    
    public function save(RentsItems  $rentsItems): void
    {
        if (! $rentsItems->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsItems  $rentsItems): void
    {
        if (! $rentsItems->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

