<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsImports;
use reception\repositories\NotFoundException;

class RentsImportsRepository 
{
    public function get($id): RentsImports    {
         if (! $rentsImports = RentsImports::findOne($id)) {
            throw new NotFoundException('RentsImports is not found.');
        }
    return  $rentsImports;
    }
    
    public function save(RentsImports  $rentsImports): void
    {
        if (! $rentsImports->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsImports  $rentsImports): void
    {
        if (! $rentsImports->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

