<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsPricesDays;
use reception\repositories\NotFoundException;

class RentsPricesDaysRepository 
{
    public function get($id): RentsPricesDays    {
         if (! $rentsPricesDays = RentsPricesDays::findOne($id)) {
            throw new NotFoundException('RentsPricesDays is not found.');
        }
    return  $rentsPricesDays;
    }
    
    public function save(RentsPricesDays  $rentsPricesDays): void
    {
        if (! $rentsPricesDays->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsPricesDays  $rentsPricesDays): void
    {
        if (! $rentsPricesDays->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

