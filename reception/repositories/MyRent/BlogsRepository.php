<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Blogs;
use reception\repositories\NotFoundException;

class BlogsRepository 
{
    public function get($id): Blogs    {
         if (! $blogs = Blogs::findOne($id)) {
            throw new NotFoundException('Blogs is not found.');
        }
    return  $blogs;
    }
    
    public function save(Blogs  $blogs): void
    {
        if (! $blogs->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Blogs  $blogs): void
    {
        if (! $blogs->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

