<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Items;
use reception\repositories\NotFoundException;

class ItemsRepository 
{
    public function get($id): Items    {
         if (! $items = Items::findOne($id)) {
            throw new NotFoundException('Items is not found.');
        }
    return  $items;
    }
    
    public function save(Items  $items): void
    {
        if (! $items->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Items  $items): void
    {
        if (! $items->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

