<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ItemsB2b;
use reception\repositories\NotFoundException;

class ItemsB2bRepository 
{
    public function get($id): ItemsB2b    {
         if (! $itemsB2b = ItemsB2b::findOne($id)) {
            throw new NotFoundException('ItemsB2b is not found.');
        }
    return  $itemsB2b;
    }
    
    public function save(ItemsB2b  $itemsB2b): void
    {
        if (! $itemsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ItemsB2b  $itemsB2b): void
    {
        if (! $itemsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

