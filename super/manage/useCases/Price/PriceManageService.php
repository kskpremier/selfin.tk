<?php

namespace superuser\useCases\manage\Price;


use backend\models\ObjectsPricesDays;
use reception\forms\MyRent\PriceSetForm;
use superprice\repositories\Price\PriceRepository;

class PriceManageService
{
    private $repository;
    private $prices;

    /**
     * @var Newsletter
     */
    private $newsletter;

    public function __construct(
        PriceRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(PriceSetForm $form): ObjectsPricesDays
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
            $this->newsletter->subscribe($user->email);
        });
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email,
            $form->phone
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
        $this->newsletter->unsubscribe($user->email);
    }
}