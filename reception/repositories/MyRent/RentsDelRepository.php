<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsDel;
use reception\repositories\NotFoundException;

class RentsDelRepository 
{
    public function get($id): RentsDel    {
         if (! $rentsDel = RentsDel::findOne($id)) {
            throw new NotFoundException('RentsDel is not found.');
        }
    return  $rentsDel;
    }
    
    public function save(RentsDel  $rentsDel): void
    {
        if (! $rentsDel->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsDel  $rentsDel): void
    {
        if (! $rentsDel->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

