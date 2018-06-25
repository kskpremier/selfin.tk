<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersBraintree;
use reception\repositories\NotFoundException;

class UsersBraintreeRepository 
{
    public function get($id): UsersBraintree    {
         if (! $usersBraintree = UsersBraintree::findOne($id)) {
            throw new NotFoundException('UsersBraintree is not found.');
        }
    return  $usersBraintree;
    }
    
    public function save(UsersBraintree  $usersBraintree): void
    {
        if (! $usersBraintree->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersBraintree  $usersBraintree): void
    {
        if (! $usersBraintree->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

