<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsDoorsLocks;
use reception\repositories\NotFoundException;

class RentsDoorsLocksRepository 
{
    public function get($id): RentsDoorsLocks    {
         if (! $rentsDoorsLocks = RentsDoorsLocks::findOne($id)) {
            throw new NotFoundException('RentsDoorsLocks is not found.');
        }
    return  $rentsDoorsLocks;
    }
    
    public function save(RentsDoorsLocks  $rentsDoorsLocks): void
    {
        if (! $rentsDoorsLocks->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsDoorsLocks  $rentsDoorsLocks): void
    {
        if (! $rentsDoorsLocks->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

