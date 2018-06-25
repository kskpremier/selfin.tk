<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesPayments;
use reception\repositories\NotFoundException;

class InvoicesPaymentsRepository 
{
    public function get($id): InvoicesPayments    {
         if (! $invoicesPayments = InvoicesPayments::findOne($id)) {
            throw new NotFoundException('InvoicesPayments is not found.');
        }
    return  $invoicesPayments;
    }
    
    public function save(InvoicesPayments  $invoicesPayments): void
    {
        if (! $invoicesPayments->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesPayments  $invoicesPayments): void
    {
        if (! $invoicesPayments->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

