<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ItemsPeriod;
use reception\repositories\NotFoundException;

class ItemsPeriodRepository 
{
    public function get($id): ItemsPeriod    {
         if (! $itemsPeriod = ItemsPeriod::findOne($id)) {
            throw new NotFoundException('ItemsPeriod is not found.');
        }
    return  $itemsPeriod;
    }
    
    public function save(ItemsPeriod  $itemsPeriod): void
    {
        if (! $itemsPeriod->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ItemsPeriod  $itemsPeriod): void
    {
        if (! $itemsPeriod->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

