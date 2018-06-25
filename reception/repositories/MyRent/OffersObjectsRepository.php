<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\OffersObjects;
use reception\repositories\NotFoundException;

class OffersObjectsRepository 
{
    public function get($id): OffersObjects    {
         if (! $offersObjects = OffersObjects::findOne($id)) {
            throw new NotFoundException('OffersObjects is not found.');
        }
    return  $offersObjects;
    }
    
    public function save(OffersObjects  $offersObjects): void
    {
        if (! $offersObjects->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(OffersObjects  $offersObjects): void
    {
        if (! $offersObjects->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

