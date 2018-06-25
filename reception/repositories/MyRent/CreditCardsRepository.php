<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CreditCards;
use reception\repositories\NotFoundException;

class CreditCardsRepository 
{
    public function get($id): CreditCards    {
         if (! $creditCards = CreditCards::findOne($id)) {
            throw new NotFoundException('CreditCards is not found.');
        }
    return  $creditCards;
    }
    
    public function save(CreditCards  $creditCards): void
    {
        if (! $creditCards->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CreditCards  $creditCards): void
    {
        if (! $creditCards->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

