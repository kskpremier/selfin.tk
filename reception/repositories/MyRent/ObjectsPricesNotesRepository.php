<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesNotes;
use reception\repositories\NotFoundException;

class ObjectsPricesNotesRepository 
{
    public function get($id): ObjectsPricesNotes    {
         if (! $objectsPricesNotes = ObjectsPricesNotes::findOne($id)) {
            throw new NotFoundException('ObjectsPricesNotes is not found.');
        }
    return  $objectsPricesNotes;
    }
    
    public function save(ObjectsPricesNotes  $objectsPricesNotes): void
    {
        if (! $objectsPricesNotes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesNotes  $objectsPricesNotes): void
    {
        if (! $objectsPricesNotes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

