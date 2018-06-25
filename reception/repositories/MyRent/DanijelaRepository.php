<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Danijela;
use reception\repositories\NotFoundException;

class DanijelaRepository 
{
    public function get($id): Danijela    {
         if (! $danijela = Danijela::findOne($id)) {
            throw new NotFoundException('Danijela is not found.');
        }
    return  $danijela;
    }
    
    public function save(Danijela  $danijela): void
    {
        if (! $danijela->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Danijela  $danijela): void
    {
        if (! $danijela->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

