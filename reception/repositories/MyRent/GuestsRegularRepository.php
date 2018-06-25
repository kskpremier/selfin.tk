<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\GuestsRegular;
use reception\repositories\NotFoundException;

class GuestsRegularRepository 
{
    public function get($id): GuestsRegular    {
         if (! $guestsRegular = GuestsRegular::findOne($id)) {
            throw new NotFoundException('GuestsRegular is not found.');
        }
    return  $guestsRegular;
    }
    
    public function save(GuestsRegular  $guestsRegular): void
    {
        if (! $guestsRegular->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(GuestsRegular  $guestsRegular): void
    {
        if (! $guestsRegular->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

