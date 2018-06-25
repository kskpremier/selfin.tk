<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsOffers;
use reception\repositories\NotFoundException;

class RentsOffersRepository 
{
    public function get($id): RentsOffers    {
         if (! $rentsOffers = RentsOffers::findOne($id)) {
            throw new NotFoundException('RentsOffers is not found.');
        }
    return  $rentsOffers;
    }
    
    public function save(RentsOffers  $rentsOffers): void
    {
        if (! $rentsOffers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsOffers  $rentsOffers): void
    {
        if (! $rentsOffers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

