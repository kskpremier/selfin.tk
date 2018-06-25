<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Guests;
use reception\repositories\NotFoundException;

class GuestsRepository 
{
    public function get($id): Guests    {
         if (! $guests = Guests::findOne($id)) {
            throw new NotFoundException('Guests is not found.');
        }
    return  $guests;
    }
    
    public function save(Guests  $guests): void
    {
        if (! $guests->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Guests  $guests): void
    {
        if (! $guests->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

