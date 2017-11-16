<?php

namespace reception\useCases\manage;

use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\DoorLock;
use reception\entities\User\User;
use reception\forms\auth\MyRentUserForm;
use reception\forms\manage\User\UserCreateForm;
use reception\forms\manage\User\UserEditForm;
use reception\forms\MyRent\ApartmentForm;
use reception\repositories\UserRepository;
//use reception\services\newsletter\Newsletter;
use reception\services\MyRent\MyRent;
use reception\services\RoleManager;
//use reception\services\TransactionManager;

class UserManageService
{
    private $repository;
    private $roles;
//    private $transaction;
    /**
     * @var Newsletter
     */
    private $newsletter;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles//,
        //     TransactionManager $transaction//,
        //  Newsletter $newsletter
    )
    {
        $this->repository = $repository;
        $this->roles = $roles;
        //     $this->transaction = $transaction;
        // $this->newsletter = $newsletter;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
//            $form->phone,
            $form->password
        );
        // $this->transaction->wrap(function () use ($user, $form) {
        $this->repository->save($user);
        $this->roles->assignRoles($user->id, $form->role);
        // $this->newsletter->subscribe($user->email);
        //  });
        return $user;
    }

//    public function createMyRentUser(MyRentUserForm $form): User
//    {
//        $user = User::create($form->username, $form->contact_email, $form->password,
//            $form->contact_name, $form->contact_tel, $form->id,
//            $form->guid, $form->changed);
//        // $this->transaction->wrap(function () use ($user, $form) {
//        $this->repository->save($user);
//
//        if ($form->role === "user") {
//            $user->roles->assignRoles($user->id, 'owner');
//            $this->updateMyRentUser($user);
//        }
//        else {
//            $user->roles->assignRoles($user->id, 'tourist');
//            //наверное следует создать гостя ???
////            Guest::create();
//        }
//        $this->repository->save($user);
//        return $user;
//    }

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