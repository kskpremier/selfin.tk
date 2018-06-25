<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsApartments;
use reception\repositories\NotFoundException;

class RentsApartmentsRepository 
{
    public function get($id): RentsApartments    {
         if (! $rentsApartments = RentsApartments::findOne($id)) {
            throw new NotFoundException('RentsApartments is not found.');
        }
    return  $rentsApartments;
    }
    
    public function save(RentsApartments  $rentsApartments): void
    {
        if (! $rentsApartments->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsApartments  $rentsApartments): void
    {
        if (! $rentsApartments->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

