<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersGeneralsTerms;
use reception\repositories\NotFoundException;

class UsersGeneralsTermsRepository 
{
    public function get($id): UsersGeneralsTerms    {
         if (! $usersGeneralsTerms = UsersGeneralsTerms::findOne($id)) {
            throw new NotFoundException('UsersGeneralsTerms is not found.');
        }
    return  $usersGeneralsTerms;
    }
    
    public function save(UsersGeneralsTerms  $usersGeneralsTerms): void
    {
        if (! $usersGeneralsTerms->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersGeneralsTerms  $usersGeneralsTerms): void
    {
        if (! $usersGeneralsTerms->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

