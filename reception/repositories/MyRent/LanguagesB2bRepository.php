<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LanguagesB2b;
use reception\repositories\NotFoundException;

class LanguagesB2bRepository 
{
    public function get($id): LanguagesB2b    {
         if (! $languagesB2b = LanguagesB2b::findOne($id)) {
            throw new NotFoundException('LanguagesB2b is not found.');
        }
    return  $languagesB2b;
    }
    
    public function save(LanguagesB2b  $languagesB2b): void
    {
        if (! $languagesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LanguagesB2b  $languagesB2b): void
    {
        if (! $languagesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

