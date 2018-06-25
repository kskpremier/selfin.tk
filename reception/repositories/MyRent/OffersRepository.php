<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Offers;
use reception\repositories\NotFoundException;

class OffersRepository 
{
    public function get($id): Offers    {
         if (! $offers = Offers::findOne($id)) {
            throw new NotFoundException('Offers is not found.');
        }
    return  $offers;
    }
    
    public function save(Offers  $offers): void
    {
        if (! $offers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Offers  $offers): void
    {
        if (! $offers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

