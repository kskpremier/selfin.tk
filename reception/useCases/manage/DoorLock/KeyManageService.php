<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:41
 */

namespace reception\useCases\manage\DoorLock;

use reception\entities\DoorLock\Key;
use reception\entities\Booking\Booking;
use reception\entities\User\events\UserKeySend;
use reception\entities\User\User;
use reception\forms\KeyEditForm;
use reception\forms\KeyForm;
use reception\forms\KeyForBookingForm;
use reception\forms\KeyFormForNewUser;
use reception\helpers\TTLHelper;
use reception\repositories\DoorLock\KeyRepository;
use reception\useCases\BusinessException;
use reception\useCases\manage\TTL\TTL;
use yii\mail\MailerInterface;


class KeyManageService
{
    private $keyRepository;
    private $mailer;

    public function __construct(KeyRepository $keyRepository, MailerInterface $mailer)
    {
        $this->keyRepository = $keyRepository;
        $this->mailer = $mailer;

    }
    public function generate(KeyForm $form): Key
    {
        $key = Key::create(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->bookingId,
            $form->doorLockId,
            $form->userId,
            $form->remarks
        );

        $this->keyRepository->save($key);
        return $key;
    }

    public function sendForNewUser(KeyFormForNewUser $form, User $parent): Key
    {
        $user = User::create($form->username, $form->email,$form->password);
        $user->setParent($user);

        $key = Key::create(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->bookingId,
            $form->doorLockId,
            $user,
            $form->remarks
        );
        $key->recordEvent(new UserKeySend($user));

        $this->keyRepository->save($key);
        $this->SendLetter($user);
//        $this->sendConfirmationLetter($user->email);
        return $key;
    }

    public function create(Booking $booking,$userId): array
    {
        $keys=[];
        foreach ($booking->apartment->doorLocks as $lock){
            $key = Key::create (
                strtotime($booking->start_date),
                strtotime($booking->end_date),
                TTL::TTL_KEY_PERIOD_TYPE,
                $booking->id,
                $lock->id,
                $userId,
                'robot'
            );
        $this->keyRepository->save($key);
           // $response=$key->sendEKeyByLocal();
        $keys[]=$key;
        }
        return $keys;
    }

    public function edit(KeyEditForm $form, Key $key): void
    {
        $key->edit(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->bookingId,
            $form->doorLockId,
            $form->userId,
            $form->remarks,
            $form->lastUpdateDate,
            $form->keyStatus,
            $form->keyId
        );
        $this->keyRepository->save($key);
    }
    public function generateForBooking(KeyForBookingForm $form): array
    {   $booking = Booking::findOne(['external_id'=>$form->bookingId]);
        if (!isset($booking))
            throw new BusinessException("Not found any booking with such Id");
        foreach($booking->apartment->doorLocks as $doorLock) {
            $key = Key::create(
                ($form->startDate) ? strtotime($form->startDate) : strtotime($booking->start_date),
                ($form->endDate) ? strtotime($form->endDate) : strtotime($booking->end_date),
                ($form->type) ? $form->type : TTLHelper::TTL_KEY_PERIOD_TYPE,
                $booking->id,
                $doorLock->id,
                $booking->author->user->id,
                $form->remarks
            );
            $this->keyRepository->save($key);
            $result[]=$key->id;
        }
        return $result;
    }



    public function SendLetter(User $user): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-key-html', 'text' => 'auth/signup/confirm-key-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('new user for e-Key was generated')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }
}