<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:31
 */



namespace reception\useCases\manage\Booking;

use reception\entities\Booking\Guest;
use reception\entities\Booking\Booking;
use reception\forms\eVisitorForm;
use reception\forms\GuestForm;
use reception\repositories\Booking\GuestRepository;
use reception\useCases\BusinessException;

use reception\entities\User\User;
use yii\web\ServerErrorHttpException;


class GuestManageService
{
    private $guestRepository;

    public function __construct(GuestRepository $guestRepository)
    {
        $this->guestRepository = $guestRepository;

    }
// create new Guest and new User for mobile application
    public function createGuestAsUser(GuestForm $form): Guest
    {
        if ($guest = $this->guestRepository->isGuestExist($form->firstName,$form->secondName,$form->contactEmail)){
            return $guest;
        }
        else {
            $user = User::findByEmail($form->contactEmail);
            if ( !isset($user) ){
                $password = User::generatePassword(6);
                $user= User::create(
                    $form->secondName.'_'.$form->firstName,
                    $form->contactEmail,
                    $password
                );
            }
            $guest = Guest::create(
                $form->firstName ,
                $form->secondName,
                $form->contactEmail,
                $user
            );

            $this->GuestRepository->save($guest);
            return $guest;
        }

    }

    public function addToBooking(Booking $booking)
    {
        $this->bookings = $booking;
        return $this;
    }
}