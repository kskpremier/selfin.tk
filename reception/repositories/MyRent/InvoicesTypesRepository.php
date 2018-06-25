<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesTypes;
use reception\repositories\NotFoundException;

class InvoicesTypesRepository 
{
    public function get($id): InvoicesTypes    {
         if (! $invoicesTypes = InvoicesTypes::findOne($id)) {
            throw new NotFoundException('InvoicesTypes is not found.');
        }
    return  $invoicesTypes;
    }
    
    public function save(InvoicesTypes  $invoicesTypes): void
    {
        if (! $invoicesTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesTypes  $invoicesTypes): void
    {
        if (! $invoicesTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

