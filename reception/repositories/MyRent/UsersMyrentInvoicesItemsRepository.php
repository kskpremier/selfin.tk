<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersMyrentInvoicesItems;
use reception\repositories\NotFoundException;

class UsersMyrentInvoicesItemsRepository 
{
    public function get($id): UsersMyrentInvoicesItems    {
         if (! $usersMyrentInvoicesItems = UsersMyrentInvoicesItems::findOne($id)) {
            throw new NotFoundException('UsersMyrentInvoicesItems is not found.');
        }
    return  $usersMyrentInvoicesItems;
    }
    
    public function save(UsersMyrentInvoicesItems  $usersMyrentInvoicesItems): void
    {
        if (! $usersMyrentInvoicesItems->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersMyrentInvoicesItems  $usersMyrentInvoicesItems): void
    {
        if (! $usersMyrentInvoicesItems->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

