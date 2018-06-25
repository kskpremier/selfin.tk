<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesFis;
use reception\repositories\NotFoundException;

class InvoicesFisRepository 
{
    public function get($id): InvoicesFis    {
         if (! $invoicesFis = InvoicesFis::findOne($id)) {
            throw new NotFoundException('InvoicesFis is not found.');
        }
    return  $invoicesFis;
    }
    
    public function save(InvoicesFis  $invoicesFis): void
    {
        if (! $invoicesFis->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesFis  $invoicesFis): void
    {
        if (! $invoicesFis->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

