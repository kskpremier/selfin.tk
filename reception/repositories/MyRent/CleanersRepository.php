<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Cleaners;
use reception\repositories\NotFoundException;

class CleanersRepository 
{
    public function get($id): Cleaners    {
         if (! $cleaners = Cleaners::findOne($id)) {
            throw new NotFoundException('Cleaners is not found.');
        }
    return  $cleaners;
    }
    
    public function save(Cleaners  $cleaners): void
    {
        if (! $cleaners->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Cleaners  $cleaners): void
    {
        if (! $cleaners->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

