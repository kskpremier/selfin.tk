<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\PaymentMethods;
use reception\repositories\NotFoundException;

class PaymentMethodsRepository 
{
    public function get($id): PaymentMethods    {
         if (! $paymentMethods = PaymentMethods::findOne($id)) {
            throw new NotFoundException('PaymentMethods is not found.');
        }
    return  $paymentMethods;
    }
    
    public function save(PaymentMethods  $paymentMethods): void
    {
        if (! $paymentMethods->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(PaymentMethods  $paymentMethods): void
    {
        if (! $paymentMethods->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

