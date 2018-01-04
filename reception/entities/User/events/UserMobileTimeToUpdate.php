<?php

namespace reception\entities\User\events;

use reception\entities\User\User;

class UserMobileTimeToUpdate
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}