<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPaymentMethodsList;
use reception\repositories\NotFoundException;

class ObjectsPaymentMethodsListRepository 
{
    public function get($id): ObjectsPaymentMethodsList    {
         if (! $objectsPaymentMethodsList = ObjectsPaymentMethodsList::findOne($id)) {
            throw new NotFoundException('ObjectsPaymentMethodsList is not found.');
        }
    return  $objectsPaymentMethodsList;
    }
    
    public function save(ObjectsPaymentMethodsList  $objectsPaymentMethodsList): void
    {
        if (! $objectsPaymentMethodsList->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPaymentMethodsList  $objectsPaymentMethodsList): void
    {
        if (! $objectsPaymentMethodsList->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

