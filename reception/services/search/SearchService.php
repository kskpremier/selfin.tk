<?php

namespace reception\services\search;


use backend\models\Objects;
use Elasticsearch\Client;
use Monolog\Logger;

class SearchService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search($dataProvider, $location, $from, $to, $stars, $guests, $space, $priceRange, $perPage, $page)
    {
        $items=[];

//        $array = array_merge(
//            array_filter([
//                $stars ? ['term' => ['classification_star' => $stars]] : false,
//                $guests ? ['range' => ['can_sleep_max'=>['gte' => $guests]]] : false,
//                $space ? ['range' => ['space' =>['gte' => $space]]] : false,
//                $location ? [ 'multi_match' => [
//                    'query'=>$location,
//                    'fields'=>['city','address','country','zip','description']
//                ]
//                ] : false,
//            ])
//
//        );

        $response = $this->client->search([
            'index' => 'reception',
            'type' => 'objects',
            'body' => [
                '_source' => ['id'],
                'from' => ($page - 1) * $perPage,
                'size' => $perPage,
                 'sort' => [
                     ['id' => ['order' => 'asc']],
                 ],
                'aggs' => [
                    'group_by_stars' => [
                        'terms' => [
                            'field' => 'classification_star',
                        ],
                    ],
                    'types_count' => [
                        'value_count' => [
                            'field' => 'classification_star',
                        ],
                    ],
                    'prices' => [
                        "nested"=> [
                            "path"=>'prices'
                        ],
                        'aggs'=> [
                            'price_ranges' =>[
                                "range" =>[
                                    "field"=>"prices.price",
                                    'ranges'=>[
                                        ['to'=>25,],
                                        ['from'=>25, 'to'=>30,],
                                        ['from'=>30, 'to'=>35,],
                                        ['from'=>35, 'to'=>40,],
                                        ['from'=>40, 'to'=>45,],
                                        ['from'=>45, 'to'=>50,],
                                        ['from'=>50, 'to'=>60,],
                                        ['from'=>50, 'to'=>60,],
                                        ['from'=>60, 'to'=>70,],
                                        ['from'=>70, 'to'=>80,],
                                        ['from'=>80, ],
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'facilities' => [
                        "nested" => [
                            "path"=>'facilities',
                            ],
                        'aggs'=> [
                            'group_by_seaview' => [
                                'terms' => [ 'field' => 'facilities.seaview'],
                                 ],
                            ]
                        ],
                ],
                'query' => [
                    'bool' => [
                        'must' => array_merge(
                            array_filter([
                                count($stars) ? ['terms' => ['classification_star' => $stars]] : false,
                                $guests ? ['range' => ['can_sleep_max'=>['gte' => $guests]]] : false,
                                $space ? ['range' => ['space' =>['gte' => $space]]] : false,
                                $location ? [ 'multi_match' => [
                                        'query'=>$location,
                                        'fields'=>['city','address','country','zip','description']
                                        ]
                                    ] : false,
                            ])

                        ),
                        'filter'=> [
                            'nested'=>[
                                "path"=>'rents',
                                'query'=> [
                                    'bool' =>[
                                        'must_not' => [
                                                'range'=> [
                                                    'rents.from'=> [
                                                        'gt'=> $from ?? "2050-01-01",
                                                        'lt'=> $to?? "1970-01-01"
                                                    ]
                                                ],
                                                'range'=> [
                                                    'rents.to'=> [
                                                        'gt'=> $from ?? "2050-01-01",
                                                        'lt'=> $to?? "1970-01-01"
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                ],
        ]);

        $ids = array_column($response['hits']['hits'], '_id');

        if ($ids) {
            $query = Objects::find()
                ->active()
                ->with('mainPhoto')
                ->andWhere(['id' => $ids])
                ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'));
        } else {
            $query = Objects::find()->andWhere(['id' => 0]);
        }

        return new SimpleActiveDataProvider([
            'query' => $query,
            'totalCount' => $response['hits']['total'],
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
    }
}
