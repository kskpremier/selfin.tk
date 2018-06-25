<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Customers;
use reception\repositories\NotFoundException;

class CustomersRepository 
{
    public function get($id): Customers    {
         if (! $customers = Customers::findOne($id)) {
            throw new NotFoundException('Customers is not found.');
        }
    return  $customers;
    }
    
    public function save(Customers  $customers): void
    {
        if (! $customers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Customers  $customers): void
    {
        if (! $customers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

