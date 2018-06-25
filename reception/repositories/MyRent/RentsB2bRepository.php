<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsB2b;
use reception\repositories\NotFoundException;

class RentsB2bRepository 
{
    public function get($id): RentsB2b    {
         if (! $rentsB2b = RentsB2b::findOne($id)) {
            throw new NotFoundException('RentsB2b is not found.');
        }
    return  $rentsB2b;
    }
    
    public function save(RentsB2b  $rentsB2b): void
    {
        if (! $rentsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsB2b  $rentsB2b): void
    {
        if (! $rentsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

