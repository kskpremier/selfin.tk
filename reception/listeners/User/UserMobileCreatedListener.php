<?php

namespace reception\listeners\User;

use reception\entities\User\events\UserMobileCreated;
use reception\useCases\manage\MyRent\MyRentManageService;


class UserMobileCreatedListener
{
    private $service;


    public function __construct(MyRentManageService $service)//, BookingManageService $bookingService)
    {
        $this->service = $service;
    }

    public function handle(UserMobileCreated $event): void
    {
        $this->service->updateMyRentUser($event->user);
        if ($event->user->owners)
            foreach ($event->user->owners as $owner) {
                $this->myRent->updateBookings($event->user, $owner->id);
            }
        else $this->myRent->updateBookings($event->user);
    }
}