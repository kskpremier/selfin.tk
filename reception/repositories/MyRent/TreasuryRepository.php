<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Treasury;
use reception\repositories\NotFoundException;

class TreasuryRepository 
{
    public function get($id): Treasury    {
         if (! $treasury = Treasury::findOne($id)) {
            throw new NotFoundException('Treasury is not found.');
        }
    return  $treasury;
    }
    
    public function save(Treasury  $treasury): void
    {
        if (! $treasury->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Treasury  $treasury): void
    {
        if (! $treasury->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

