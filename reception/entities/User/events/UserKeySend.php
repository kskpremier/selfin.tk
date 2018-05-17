<?php

namespace reception\entities\User\events;

use reception\entities\User\User;

class UserKeySend
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}