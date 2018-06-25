<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\PaymentsRecive;
use reception\repositories\NotFoundException;

class PaymentsReciveRepository 
{
    public function get($id): PaymentsRecive    {
         if (! $paymentsRecive = PaymentsRecive::findOne($id)) {
            throw new NotFoundException('PaymentsRecive is not found.');
        }
    return  $paymentsRecive;
    }
    
    public function save(PaymentsRecive  $paymentsRecive): void
    {
        if (! $paymentsRecive->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(PaymentsRecive  $paymentsRecive): void
    {
        if (! $paymentsRecive->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

