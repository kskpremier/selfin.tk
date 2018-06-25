<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Files;
use reception\repositories\NotFoundException;

class FilesRepository 
{
    public function get($id): Files    {
         if (! $files = Files::findOne($id)) {
            throw new NotFoundException('Files is not found.');
        }
    return  $files;
    }
    
    public function save(Files  $files): void
    {
        if (! $files->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Files  $files): void
    {
        if (! $files->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

