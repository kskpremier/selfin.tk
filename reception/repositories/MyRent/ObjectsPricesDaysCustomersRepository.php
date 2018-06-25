<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesDaysCustomers;
use reception\repositories\NotFoundException;

class ObjectsPricesDaysCustomersRepository 
{
    public function get($id): ObjectsPricesDaysCustomers    {
         if (! $objectsPricesDaysCustomers = ObjectsPricesDaysCustomers::findOne($id)) {
            throw new NotFoundException('ObjectsPricesDaysCustomers is not found.');
        }
    return  $objectsPricesDaysCustomers;
    }
    
    public function save(ObjectsPricesDaysCustomers  $objectsPricesDaysCustomers): void
    {
        if (! $objectsPricesDaysCustomers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesDaysCustomers  $objectsPricesDaysCustomers): void
    {
        if (! $objectsPricesDaysCustomers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

