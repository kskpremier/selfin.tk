<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPaymentMethods;
use reception\repositories\NotFoundException;

class ObjectsPaymentMethodsRepository 
{
    public function get($id): ObjectsPaymentMethods    {
         if (! $objectsPaymentMethods = ObjectsPaymentMethods::findOne($id)) {
            throw new NotFoundException('ObjectsPaymentMethods is not found.');
        }
    return  $objectsPaymentMethods;
    }
    
    public function save(ObjectsPaymentMethods  $objectsPaymentMethods): void
    {
        if (! $objectsPaymentMethods->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPaymentMethods  $objectsPaymentMethods): void
    {
        if (! $objectsPaymentMethods->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

