<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitsFiles;
use reception\repositories\NotFoundException;

class UnitsFilesRepository 
{
    public function get($id): UnitsFiles    {
         if (! $unitsFiles = UnitsFiles::findOne($id)) {
            throw new NotFoundException('UnitsFiles is not found.');
        }
    return  $unitsFiles;
    }
    
    public function save(UnitsFiles  $unitsFiles): void
    {
        if (! $unitsFiles->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitsFiles  $unitsFiles): void
    {
        if (! $unitsFiles->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

