<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Reports;
use reception\repositories\NotFoundException;

class ReportsRepository 
{
    public function get($id): Reports    {
         if (! $reports = Reports::findOne($id)) {
            throw new NotFoundException('Reports is not found.');
        }
    return  $reports;
    }
    
    public function save(Reports  $reports): void
    {
        if (! $reports->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Reports  $reports): void
    {
        if (! $reports->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

