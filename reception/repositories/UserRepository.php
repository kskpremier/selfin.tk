<?php

namespace reception\repositories;

//use reception\dispatchers\EventDispatcher;
use reception\entities\User\User;

class UserRepository
{
//    private $dispatcher;

//    public function __construct(EventDispatcher $dispatcher)
//    {
//        $this->dispatcher = $dispatcher;
//    }

    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    private function findByExternalId($externalId)
    {
        return User::find()->andWhere(['external_id' => $externalId])->one();
    }

    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByExternalId($user_id): User
    {
        return $this->getBy(['external_id' => $user_id]);
    }

    public function getByEmailConfirmToken($token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    public function getByEmail($email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken($token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }


    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }


    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}