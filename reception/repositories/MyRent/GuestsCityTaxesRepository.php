<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\GuestsCityTaxes;
use reception\repositories\NotFoundException;

class GuestsCityTaxesRepository 
{
    public function get($id): GuestsCityTaxes    {
         if (! $guestsCityTaxes = GuestsCityTaxes::findOne($id)) {
            throw new NotFoundException('GuestsCityTaxes is not found.');
        }
    return  $guestsCityTaxes;
    }
    
    public function save(GuestsCityTaxes  $guestsCityTaxes): void
    {
        if (! $guestsCityTaxes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(GuestsCityTaxes  $guestsCityTaxes): void
    {
        if (! $guestsCityTaxes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

