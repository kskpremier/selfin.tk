<?php

namespace reception\listeners\User;


use reception\entities\User\events\UserMobileTimeToUpdate;
use reception\entities\User\User;
use reception\useCases\manage\MyRent\MyRentManageService;


class UserMobileTimeToUpdateListener
{
    private $service;

    public function __construct(MyRentManageService $service)
    {
        $this->service = $service;
    }

    public function handle(UserMobileTimeToUpdate $event): void
    {
        $this->service->updateMyRentUser($event->user);
    }
}