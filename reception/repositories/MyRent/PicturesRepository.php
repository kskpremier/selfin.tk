<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Pictures;
use reception\repositories\NotFoundException;

class PicturesRepository 
{
    public function get($id): Pictures    {
         if (! $pictures = Pictures::findOne($id)) {
            throw new NotFoundException('Pictures is not found.');
        }
    return  $pictures;
    }
    
    public function save(Pictures  $pictures): void
    {
        if (! $pictures->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Pictures  $pictures): void
    {
        if (! $pictures->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

