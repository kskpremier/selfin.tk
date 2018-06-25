<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\B2b;
use reception\repositories\NotFoundException;

class B2bRepository 
{
    public function get($id): B2b    {
         if (! $b2b = B2b::findOne($id)) {
            throw new NotFoundException('B2b is not found.');
        }
    return  $b2b;
    }
    
    public function save(B2b  $b2b): void
    {
        if (! $b2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(B2b  $b2b): void
    {
        if (! $b2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

