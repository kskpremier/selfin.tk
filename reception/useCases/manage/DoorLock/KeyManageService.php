<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:41
 */

namespace reception\useCases\manage\DoorLock;

use reception\entities\DoorLock\Key;
use reception\forms\KeyForm;
use reception\repositories\DoorLock\KeyRepository;


class KeyManageService
{
    private $keyRepository;
    public function __construct(KeyRepository $keyRepository)
    {
        $this->keyRepository = $keyRepository;

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
    public function edit(KeyEditForm $form): void
    {
        $key = Key::edit(
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
}