<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogRentsCards;
use reception\repositories\NotFoundException;

class LogRentsCardsRepository 
{
    public function get($id): LogRentsCards    {
         if (! $logRentsCards = LogRentsCards::findOne($id)) {
            throw new NotFoundException('LogRentsCards is not found.');
        }
    return  $logRentsCards;
    }
    
    public function save(LogRentsCards  $logRentsCards): void
    {
        if (! $logRentsCards->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogRentsCards  $logRentsCards): void
    {
        if (! $logRentsCards->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

