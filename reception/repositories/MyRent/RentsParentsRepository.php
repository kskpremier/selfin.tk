<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsParents;
use reception\repositories\NotFoundException;

class RentsParentsRepository 
{
    public function get($id): RentsParents    {
         if (! $rentsParents = RentsParents::findOne($id)) {
            throw new NotFoundException('RentsParents is not found.');
        }
    return  $rentsParents;
    }
    
    public function save(RentsParents  $rentsParents): void
    {
        if (! $rentsParents->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsParents  $rentsParents): void
    {
        if (! $rentsParents->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

