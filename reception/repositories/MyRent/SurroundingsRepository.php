<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Surroundings;
use reception\repositories\NotFoundException;

class SurroundingsRepository 
{
    public function get($id): Surroundings    {
         if (! $surroundings = Surroundings::findOne($id)) {
            throw new NotFoundException('Surroundings is not found.');
        }
    return  $surroundings;
    }
    
    public function save(Surroundings  $surroundings): void
    {
        if (! $surroundings->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Surroundings  $surroundings): void
    {
        if (! $surroundings->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

