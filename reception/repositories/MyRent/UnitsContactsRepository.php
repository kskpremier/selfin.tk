<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitsContacts;
use reception\repositories\NotFoundException;

class UnitsContactsRepository 
{
    public function get($id): UnitsContacts    {
         if (! $unitsContacts = UnitsContacts::findOne($id)) {
            throw new NotFoundException('UnitsContacts is not found.');
        }
    return  $unitsContacts;
    }
    
    public function save(UnitsContacts  $unitsContacts): void
    {
        if (! $unitsContacts->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitsContacts  $unitsContacts): void
    {
        if (! $unitsContacts->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

