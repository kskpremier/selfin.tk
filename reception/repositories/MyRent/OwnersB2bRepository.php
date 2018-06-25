<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\OwnersB2b;
use reception\repositories\NotFoundException;

class OwnersB2bRepository 
{
    public function get($id): OwnersB2b    {
         if (! $ownersB2b = OwnersB2b::findOne($id)) {
            throw new NotFoundException('OwnersB2b is not found.');
        }
    return  $ownersB2b;
    }
    
    public function save(OwnersB2b  $ownersB2b): void
    {
        if (! $ownersB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(OwnersB2b  $ownersB2b): void
    {
        if (! $ownersB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

