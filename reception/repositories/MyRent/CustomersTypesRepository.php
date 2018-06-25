<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CustomersTypes;
use reception\repositories\NotFoundException;

class CustomersTypesRepository 
{
    public function get($id): CustomersTypes    {
         if (! $customersTypes = CustomersTypes::findOne($id)) {
            throw new NotFoundException('CustomersTypes is not found.');
        }
    return  $customersTypes;
    }
    
    public function save(CustomersTypes  $customersTypes): void
    {
        if (! $customersTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CustomersTypes  $customersTypes): void
    {
        if (! $customersTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

