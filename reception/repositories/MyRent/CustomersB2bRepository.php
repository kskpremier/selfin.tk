<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CustomersB2b;
use reception\repositories\NotFoundException;

class CustomersB2bRepository 
{
    public function get($id): CustomersB2b    {
         if (! $customersB2b = CustomersB2b::findOne($id)) {
            throw new NotFoundException('CustomersB2b is not found.');
        }
    return  $customersB2b;
    }
    
    public function save(CustomersB2b  $customersB2b): void
    {
        if (! $customersB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CustomersB2b  $customersB2b): void
    {
        if (! $customersB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

