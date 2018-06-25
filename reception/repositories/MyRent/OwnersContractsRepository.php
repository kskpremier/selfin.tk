<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\OwnersContracts;
use reception\repositories\NotFoundException;

class OwnersContractsRepository 
{
    public function get($id): OwnersContracts    {
         if (! $ownersContracts = OwnersContracts::findOne($id)) {
            throw new NotFoundException('OwnersContracts is not found.');
        }
    return  $ownersContracts;
    }
    
    public function save(OwnersContracts  $ownersContracts): void
    {
        if (! $ownersContracts->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(OwnersContracts  $ownersContracts): void
    {
        if (! $ownersContracts->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

