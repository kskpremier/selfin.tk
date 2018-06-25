<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersInvoices;
use reception\repositories\NotFoundException;

class UsersInvoicesRepository 
{
    public function get($id): UsersInvoices    {
         if (! $usersInvoices = UsersInvoices::findOne($id)) {
            throw new NotFoundException('UsersInvoices is not found.');
        }
    return  $usersInvoices;
    }
    
    public function save(UsersInvoices  $usersInvoices): void
    {
        if (! $usersInvoices->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersInvoices  $usersInvoices): void
    {
        if (! $usersInvoices->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

