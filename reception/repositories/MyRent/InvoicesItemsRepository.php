<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesItems;
use reception\repositories\NotFoundException;

class InvoicesItemsRepository 
{
    public function get($id): InvoicesItems    {
         if (! $invoicesItems = InvoicesItems::findOne($id)) {
            throw new NotFoundException('InvoicesItems is not found.');
        }
    return  $invoicesItems;
    }
    
    public function save(InvoicesItems  $invoicesItems): void
    {
        if (! $invoicesItems->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesItems  $invoicesItems): void
    {
        if (! $invoicesItems->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

