<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Prices;
use reception\repositories\NotFoundException;

class PricesRepository 
{
    public function get($id): Prices    {
         if (! $prices = Prices::findOne($id)) {
            throw new NotFoundException('Prices is not found.');
        }
    return  $prices;
    }
    
    public function save(Prices  $prices): void
    {
        if (! $prices->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Prices  $prices): void
    {
        if (! $prices->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

