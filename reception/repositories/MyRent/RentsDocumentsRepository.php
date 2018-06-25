<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsDocuments;
use reception\repositories\NotFoundException;

class RentsDocumentsRepository 
{
    public function get($id): RentsDocuments    {
         if (! $rentsDocuments = RentsDocuments::findOne($id)) {
            throw new NotFoundException('RentsDocuments is not found.');
        }
    return  $rentsDocuments;
    }
    
    public function save(RentsDocuments  $rentsDocuments): void
    {
        if (! $rentsDocuments->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsDocuments  $rentsDocuments): void
    {
        if (! $rentsDocuments->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

