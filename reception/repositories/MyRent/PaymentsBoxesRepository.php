<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\PaymentsBoxes;
use reception\repositories\NotFoundException;

class PaymentsBoxesRepository 
{
    public function get($id): PaymentsBoxes    {
         if (! $paymentsBoxes = PaymentsBoxes::findOne($id)) {
            throw new NotFoundException('PaymentsBoxes is not found.');
        }
    return  $paymentsBoxes;
    }
    
    public function save(PaymentsBoxes  $paymentsBoxes): void
    {
        if (! $paymentsBoxes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(PaymentsBoxes  $paymentsBoxes): void
    {
        if (! $paymentsBoxes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

