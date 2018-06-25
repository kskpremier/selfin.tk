<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\MyrentChangelog;
use reception\repositories\NotFoundException;

class MyrentChangelogRepository 
{
    public function get($id): MyrentChangelog    {
         if (! $myrentChangelog = MyrentChangelog::findOne($id)) {
            throw new NotFoundException('MyrentChangelog is not found.');
        }
    return  $myrentChangelog;
    }
    
    public function save(MyrentChangelog  $myrentChangelog): void
    {
        if (! $myrentChangelog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(MyrentChangelog  $myrentChangelog): void
    {
        if (! $myrentChangelog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

