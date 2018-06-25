<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Import;
use reception\repositories\NotFoundException;

class ImportRepository 
{
    public function get($id): Import    {
         if (! $import = Import::findOne($id)) {
            throw new NotFoundException('Import is not found.');
        }
    return  $import;
    }
    
    public function save(Import  $import): void
    {
        if (! $import->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Import  $import): void
    {
        if (! $import->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

