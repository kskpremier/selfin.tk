<?php



namespace reception\useCases\manage\Apartment;

use reception\entities\Apartment\Owner;
use reception\forms\OwnerForm;
use reception\repositories\Apartment\OwnerRepository;
use reception\entities\User\User;



class OwnerManageService
{
    private $ownerRepository;

    public function __construct(OwnerRepository $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;

    }
// create new Owner and new User for mobile application
    public function create(OwnerForm $form): Owner
    {
        if ($owner = $this->ownerRepository->isOwnerExist($form->externalId, $form->contactEmail)){
            return $owner;
        }
        else {
            $user = User::findByEmail($form->contactEmail);
            if ( !isset($user) ){
                $password = (isset($form->password))?$form->password: User::generatePassword(6);
                $user= User::create(
                    $form->secondName.'_'.$form->firstName,
                    $form->contactEmail,
                    $password
                    // TODO add auto connecting with role -"owner"
                );
            }
            $owner = Owner::create(
                $form->externalId ,
                $form->apartments,
                $user
            );

            $this->ownerRepository->save($owner);
            return $owner;
        }

    }

    public function addApartment(Owner $owner, Apartment $apartment)
    {
        //$this->bookings = $apartment;

        $owner->updateApartment($apartment);
        $this->ownerRepository->save($owner);
        return $owner;
    }
} 