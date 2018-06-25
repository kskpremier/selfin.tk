<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersEmail;
use reception\repositories\NotFoundException;

class UsersEmailRepository 
{
    public function get($id): UsersEmail    {
         if (! $usersEmail = UsersEmail::findOne($id)) {
            throw new NotFoundException('UsersEmail is not found.');
        }
    return  $usersEmail;
    }
    
    public function save(UsersEmail  $usersEmail): void
    {
        if (! $usersEmail->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersEmail  $usersEmail): void
    {
        if (! $usersEmail->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

