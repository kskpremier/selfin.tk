<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CustomersPrices;
use reception\repositories\NotFoundException;

class CustomersPricesRepository 
{
    public function get($id): CustomersPrices    {
         if (! $customersPrices = CustomersPrices::findOne($id)) {
            throw new NotFoundException('CustomersPrices is not found.');
        }
    return  $customersPrices;
    }
    
    public function save(CustomersPrices  $customersPrices): void
    {
        if (! $customersPrices->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CustomersPrices  $customersPrices): void
    {
        if (! $customersPrices->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

