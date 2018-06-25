<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Reviews;
use reception\repositories\NotFoundException;

class ReviewsRepository 
{
    public function get($id): Reviews    {
         if (! $reviews = Reviews::findOne($id)) {
            throw new NotFoundException('Reviews is not found.');
        }
    return  $reviews;
    }
    
    public function save(Reviews  $reviews): void
    {
        if (! $reviews->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Reviews  $reviews): void
    {
        if (! $reviews->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

