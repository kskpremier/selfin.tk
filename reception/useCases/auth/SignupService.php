<?php

namespace reception\useCases\auth;

use reception\access\Rbac;
use reception\dispatchers\EventDispatcher;
use reception\entities\User\User;
use reception\forms\auth\SignupForm;
use reception\repositories\UserRepository;
use reception\services\RoleManager;
use reception\services\TransactionManager;

class SignupService
{
    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}