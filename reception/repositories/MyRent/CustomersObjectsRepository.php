<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CustomersObjects;
use reception\repositories\NotFoundException;

class CustomersObjectsRepository 
{
    public function get($id): CustomersObjects    {
         if (! $customersObjects = CustomersObjects::findOne($id)) {
            throw new NotFoundException('CustomersObjects is not found.');
        }
    return  $customersObjects;
    }
    
    public function save(CustomersObjects  $customersObjects): void
    {
        if (! $customersObjects->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CustomersObjects  $customersObjects): void
    {
        if (! $customersObjects->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

