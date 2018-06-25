<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersMyrentInvoicesHeaders;
use reception\repositories\NotFoundException;

class UsersMyrentInvoicesHeadersRepository 
{
    public function get($id): UsersMyrentInvoicesHeaders    {
         if (! $usersMyrentInvoicesHeaders = UsersMyrentInvoicesHeaders::findOne($id)) {
            throw new NotFoundException('UsersMyrentInvoicesHeaders is not found.');
        }
    return  $usersMyrentInvoicesHeaders;
    }
    
    public function save(UsersMyrentInvoicesHeaders  $usersMyrentInvoicesHeaders): void
    {
        if (! $usersMyrentInvoicesHeaders->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersMyrentInvoicesHeaders  $usersMyrentInvoicesHeaders): void
    {
        if (! $usersMyrentInvoicesHeaders->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

