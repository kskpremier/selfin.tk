<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 12/14/17
 * Time: 2:36 PM
 */

namespace listeners\Booking;


use reception\entities\Booking\events\DocumentBadFaceMatching;
use reception\entities\Booking\Document;
use reception\entities\User\User;
use reception\repositories\UserRepository;
use yii\base\ErrorHandler;
use yii\mail\MailerInterface;

class DocumentRecognitionListener
{
    private $users;
    private $mailer;
    private $errorHandler;

    public function __construct(UserRepository $users, MailerInterface $mailer, ErrorHandler $errorHandler)
    {
        $this->users = $users;
        $this->mailer = $mailer;
        $this->errorHandler = $errorHandler;
    }

    public function handle(DocumentBadFaceMatching $event): void
    {
        foreach ($this->users->getAllUsersForBooking($event->document->booking) as $user) {
            if ($user->isActive()) {
                try {
                    $this->sendEmailNotification($user, $event->document, $event->maxProbability);
                } catch (\Exception $e) {
                    $this->errorHandler->handleException($e);
                }
            }
        }
    }

    private function sendEmailNotification(User $user, Document $document, $probability): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'reception/recognition/bad-html', 'text' => 'reception/recognition/bad-text'],
                ['user' => $user, 'document'=>$document,'probability' => $probability]
            )
            ->setTo($user->email)
            ->setSubject('Bad result of recognition document\'s images and selfy of guest')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error to ' . $user->email);
        }
    }
}