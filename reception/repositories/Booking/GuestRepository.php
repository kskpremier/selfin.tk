<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\entities\Booking\Guest;
use reception\forms\MyRent\ContactForm;
use reception\repositories\NotFoundException;

class GuestRepository
{
    public function get($id): Guest
    {
        if (!$guest = Guest::findOne($id)) {
            throw new NotFoundException('Guest is not found.');
        }
        return $guest;
    }
    public function isGuestExist($firstName, $secondName,$contactEmail): mixed
    {
        if ($guest = Guest::findOne(['first_name' => $firstName,'second_name'=>$secondName,'contact_email'=>$contactEmail])) {
            return $guest;
        }
        return false;
    }

    public function findByMyRent(ContactForm $form)
    {
        if ($guest = Guest::findOne(['contact_name' => $form->contact_name, 'contact_email'=>$form->contact_email])) {
            return $guest;
        }
        return false;
    }

        public function save(Guest $guest): void
    {
        if (!$guest->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Guest $guest): void
    {
        if (!$guest->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}