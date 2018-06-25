<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesCustomers;
use reception\repositories\NotFoundException;

class ObjectsPricesCustomersRepository 
{
    public function get($id): ObjectsPricesCustomers    {
         if (! $objectsPricesCustomers = ObjectsPricesCustomers::findOne($id)) {
            throw new NotFoundException('ObjectsPricesCustomers is not found.');
        }
    return  $objectsPricesCustomers;
    }
    
    public function save(ObjectsPricesCustomers  $objectsPricesCustomers): void
    {
        if (! $objectsPricesCustomers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesCustomers  $objectsPricesCustomers): void
    {
        if (! $objectsPricesCustomers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

