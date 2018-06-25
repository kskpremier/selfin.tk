<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsCards;
use reception\repositories\NotFoundException;

class RentsCardsRepository 
{
    public function get($id): RentsCards    {
         if (! $rentsCards = RentsCards::findOne($id)) {
            throw new NotFoundException('RentsCards is not found.');
        }
    return  $rentsCards;
    }
    
    public function save(RentsCards  $rentsCards): void
    {
        if (! $rentsCards->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsCards  $rentsCards): void
    {
        if (! $rentsCards->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

