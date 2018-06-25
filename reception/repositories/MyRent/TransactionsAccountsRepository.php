<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\TransactionsAccounts;
use reception\repositories\NotFoundException;

class TransactionsAccountsRepository 
{
    public function get($id): TransactionsAccounts    {
         if (! $transactionsAccounts = TransactionsAccounts::findOne($id)) {
            throw new NotFoundException('TransactionsAccounts is not found.');
        }
    return  $transactionsAccounts;
    }
    
    public function save(TransactionsAccounts  $transactionsAccounts): void
    {
        if (! $transactionsAccounts->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(TransactionsAccounts  $transactionsAccounts): void
    {
        if (! $transactionsAccounts->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

