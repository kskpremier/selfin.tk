<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogUsersLogin;
use reception\repositories\NotFoundException;

class LogUsersLoginRepository 
{
    public function get($id): LogUsersLogin    {
         if (! $logUsersLogin = LogUsersLogin::findOne($id)) {
            throw new NotFoundException('LogUsersLogin is not found.');
        }
    return  $logUsersLogin;
    }
    
    public function save(LogUsersLogin  $logUsersLogin): void
    {
        if (! $logUsersLogin->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogUsersLogin  $logUsersLogin): void
    {
        if (! $logUsersLogin->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

