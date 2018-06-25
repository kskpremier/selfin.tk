<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\GuestsImport;
use reception\repositories\NotFoundException;

class GuestsImportRepository 
{
    public function get($id): GuestsImport    {
         if (! $guestsImport = GuestsImport::findOne($id)) {
            throw new NotFoundException('GuestsImport is not found.');
        }
    return  $guestsImport;
    }
    
    public function save(GuestsImport  $guestsImport): void
    {
        if (! $guestsImport->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(GuestsImport  $guestsImport): void
    {
        if (! $guestsImport->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

