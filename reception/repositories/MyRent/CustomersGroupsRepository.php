<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CustomersGroups;
use reception\repositories\NotFoundException;

class CustomersGroupsRepository 
{
    public function get($id): CustomersGroups    {
         if (! $customersGroups = CustomersGroups::findOne($id)) {
            throw new NotFoundException('CustomersGroups is not found.');
        }
    return  $customersGroups;
    }
    
    public function save(CustomersGroups  $customersGroups): void
    {
        if (! $customersGroups->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CustomersGroups  $customersGroups): void
    {
        if (! $customersGroups->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

