<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesHeader;
use reception\repositories\NotFoundException;

class InvoicesHeaderRepository 
{
    public function get($id): InvoicesHeader    {
         if (! $invoicesHeader = InvoicesHeader::findOne($id)) {
            throw new NotFoundException('InvoicesHeader is not found.');
        }
    return  $invoicesHeader;
    }
    
    public function save(InvoicesHeader  $invoicesHeader): void
    {
        if (! $invoicesHeader->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesHeader  $invoicesHeader): void
    {
        if (! $invoicesHeader->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

