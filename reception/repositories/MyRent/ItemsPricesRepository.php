<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ItemsPrices;
use reception\repositories\NotFoundException;

class ItemsPricesRepository 
{
    public function get($id): ItemsPrices    {
         if (! $itemsPrices = ItemsPrices::findOne($id)) {
            throw new NotFoundException('ItemsPrices is not found.');
        }
    return  $itemsPrices;
    }
    
    public function save(ItemsPrices  $itemsPrices): void
    {
        if (! $itemsPrices->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ItemsPrices  $itemsPrices): void
    {
        if (! $itemsPrices->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

