<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPaymentOptions;
use reception\repositories\NotFoundException;

class ObjectsPaymentOptionsRepository 
{
    public function get($id): ObjectsPaymentOptions    {
         if (! $objectsPaymentOptions = ObjectsPaymentOptions::findOne($id)) {
            throw new NotFoundException('ObjectsPaymentOptions is not found.');
        }
    return  $objectsPaymentOptions;
    }
    
    public function save(ObjectsPaymentOptions  $objectsPaymentOptions): void
    {
        if (! $objectsPaymentOptions->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPaymentOptions  $objectsPaymentOptions): void
    {
        if (! $objectsPaymentOptions->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

