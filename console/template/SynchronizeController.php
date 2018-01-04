<?php

namespace console\controllers;

use reception\entities\EventTrait;
use reception\entities\User\events\UserMobileTimeToUpdate;
use reception\entities\User\User;
use reception\repositories\UserRepository;
use reception\useCases\manage\Booking\BookingManageService;
use reception\useCases\manage\MyRent\MyRentManageService;
use yii\console\Controller;

class SynchronizeController extends Controller
{
    use EventTrait;

    private $service;
    private $bookingService;
    private $users;
//    private $serviceUser;


    public function __construct($id, $module, MyRentManageService $service, BookingManageService $bookingService, UserRepository $users, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->service = $service;
        $this->bookingService = $bookingService;
        $this->users = $users;
//        $this->serviceUser = $serviceUser;

    }

    public function actionUpdateAll(): void
    {
        //получить список всех юзеров с ролью mobile
        $mobileUsers = $this->users->getMobileUsers();
        foreach($mobileUsers as $mobileUser){
            $this->recordEvent(new UserMobileTimeToUpdate($mobileUser));
        }
        //запросить изменения для каждого из них
        //сделать апдейт


    }

    public function actionUpdateUser(User $user): void
    {
        //получить список всех юзеров с ролью mobile
        //запросить изменения для каждого из них
        //сделать апдейт


    }
}