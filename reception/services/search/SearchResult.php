<?php


namespace reception\services\search;

use yii\data\Pagination;

class SearchResult
{
    public $objects;
    public $prices;
    public $stars;

    public function __construct(Pagination $objects, array $regionsCounts, array $categoriesCounts)
    {
        $this->adverts = $adverts;
        $this->regionsCounts = $regionsCounts;
        $this->categoriesCounts = $categoriesCounts;
    }
}