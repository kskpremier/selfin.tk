<?php

namespace reception\useCases\manage\Myrent;

use reception\entities\Apartment\Apartment;
use reception\entities\Booking\Guest;
use reception\entities\DoorLock\DoorLock;
use reception\entities\MyRent\Owner;
use reception\entities\User\User;
use reception\forms\MyRent\MyRentUserForm;
use reception\forms\manage\User\UserCreateForm;
use reception\forms\manage\User\UserEditForm;
use reception\forms\MyRent\ApartmentForm;
use reception\repositories\Apartment\ApartmentRepository;
use reception\repositories\apartment\OwnerRepository;
use reception\repositories\Booking\GuestRepository;
use reception\repositories\DoorLock\DoorLockRepository;
use reception\repositories\UserRepository;
//use reception\services\newsletter\Newsletter;
use reception\services\MyRent\MyRent;
use reception\services\RoleManager;
//use reception\services\TransactionManager;

class MyRentManageService
{
    private $repository;
    private $doorlockRepository;
    private $apartmentRepository;
    private $ownerRepository;
    private $guestRepository;
    private $roles;
//    private $transaction;
    /**
     * @var Newsletter
     */
  //  private $newsletter;

    public function __construct(
        UserRepository $repository,
        DoorLockRepository $doorlockRepository,
        OwnerRepository $ownerRepository,
        ApartmentRepository $apartmentRepository,
        GuestRepository $guestRepository,
        RoleManager $roles//,
        //     TransactionManager $transaction//,
        //  Newsletter $newsletter
    )
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->doorlockRepository = $doorlockRepository;
        $this->ownerRepository = $ownerRepository;
        $this->guestRepository = $guestRepository;
        $this->apartmentRepository = $apartmentRepository;
        //     $this->transaction = $transaction;
        // $this->newsletter = $newsletter;
    }

    public function createMyRentUser(MyRentUserForm $form): User
    {
        $user = User::create($form->username, $form->contact_email, $form->password,
            $form->contact_name, $form->contact_tel, $form->id,
            $form->guid, strtotime($form->changed));
        // $this->transaction->wrap(function () use ($user, $form) {
        $this->repository->save($user);

        if ($form->role === "user") {
            $this->roles->assignRoles($user->id, ['mobile','mrz']);
            $this->updateMyRentUser($user);
            $this->repository->save($user);
        }
        elseif ($form->role === "owner") {
            $owner = Owner::create($form->id, $form->guid,$form->username, $form->country_id, $form->contact_tel, $form->contact_email,
                $form->contact_name, strtotime($form->created), strtotime($form->changed), null, $form->country_id,
                null, null,  $user->id, $apartments = null);
            $this->roles->assignRoles($user->id, ['owner','mrz']);
            $masterUser= $this->repository->getByExternalId($form->user_id);
            $this->updateMyRentUser($masterUser);
            $this->repository->save($masterUser);
            $this->ownerRepository->saveMyRentOwner($owner);
        }
        else {
            $this->roles->assignRoles($user->id, ['tourist']);
            //наверное следует создать гостя ???
            //$first_name, $second_name, $contact_email, $user=null, $booking=null,$contact_tel=null, $updatetime=null
            $guest = Guest::create(  '', $form->contact_name, $form->contact_email, $user, $booking=null, $form->contact_tel, time(), $form->guid);
            $this->guestRepository->save($guest);
        }
        return $user;
    }

    public function updateMyRentUser($user)
    {
        $updateTime = time(); //$apartments=$workers=$owners=$doorLocks=[];
        if (($user->myrent_update===null) || ($updateTime - $user->myrent_update > MyRent::MyRent_UPDATE_INTERVAL) ){
            //запросить список апартаментов
            $apartmentList = MyRent::getApartmentsForUser($user->external_id);
            foreach ($apartmentList as $apartmentData) {
                    $apartmentForm = new ApartmentForm();
                    $apartmentForm->load($apartmentData,'');
                    if ($apartmentForm->validate()) {
                        //ищем уже существующие апартаменты
                        $apartment = $this->apartmentRepository->findByMyRentId($apartmentForm->object_id);
                        if (!isset($apartment)) //если не найдены - создаем
                            $apartment = Apartment::addProperty($apartmentForm, $user->id, $updateTime);
                        else // если найдены - вносим испраления, если они были
                            $apartment = $apartment->edit($apartmentForm, $user->id, $updateTime);
                        $this->apartmentRepository->save($apartment);
                        foreach($apartmentForm->doorlocks as $doorLockForm) {
                            if ($doorLockForm) {
                                $doorlock = $this->doorlockRepository->findByMyrRentId($doorLockForm->id);
                                if ($doorlock) {
                                    $doorlock->installInApartment($apartment->id, $doorLockForm->name, $doorLockForm->id, $user->id,$updateTime);
                                    $this->doorlockRepository->save($doorlock);
                                }
                                else throw new \DomainException ('Failed to find door lock with id => ' . $doorLockForm->id);
                            }
                        }
                    } else throw new \DomainException ('Failed to create the object => ' . \GuzzleHttp\json_encode($apartmentForm->getFirstErrors()));
                    //записать owner новое время
            }
            $this->saveUpdateTime($user, $updateTime);
        }
    }

    public function saveUpdateTime(User $user, $updateTime)
    {
        $user->saveUpdate($updateTime);
        $this->repository->save($user);
    }


    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email //,
//            $form->phone
        );
   //     $this->transaction->wrap(function () use ($user, $form) {
           // $this->roles->assign($user->id, $form->existRoles);
            $this->roles->assignRoles($user->id, $form->existRoles);
            $this->repository->save($user);
           // $this->roles->assign($user->id, $form->role);
  //      });
    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }
    public function getRoles($id)
    {
        return $this->roles->getRoles($id);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
       // $this->newsletter->unsubscribe($user->email);
    }
}