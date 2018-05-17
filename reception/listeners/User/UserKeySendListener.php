<?php

namespace reception\listeners\User;

use reception\entities\User\events\UserKeySend;
use yii\mail\MailerInterface;

class UserKeySendListener
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(UserKeySend $event): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-key-html', 'text' => 'auth/signup/confirm-key-text'],
                ['user' => $event->user]
            )
            ->setTo($event->user->email)
            ->setSubject('new user for e-Key was generated')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }
}