<?php

namespace reception\entities\User\events;

//use reception\entities\Booking\Guest;
//use reception\entities\MyRent\Owner;
use reception\entities\User\User;

class UserMobileCreated
{
    public $user;
    public $owner;
    public $guest;

    public function __construct(User $user, $owner, $guest)
    {
        $this->user = $user;
        $this->owner = $owner;
        $this->guest = $guest;
    }
}