<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\GuestsEvisitor;
use reception\repositories\NotFoundException;

class GuestsEvisitorRepository 
{
    public function get($id): GuestsEvisitor    {
         if (! $guestsEvisitor = GuestsEvisitor::findOne($id)) {
            throw new NotFoundException('GuestsEvisitor is not found.');
        }
    return  $guestsEvisitor;
    }
    
    public function save(GuestsEvisitor  $guestsEvisitor): void
    {
        if (! $guestsEvisitor->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(GuestsEvisitor  $guestsEvisitor): void
    {
        if (! $guestsEvisitor->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

