<?php

namespace reception\services\search;

use Elasticsearch\Client;
use backend\models\Objects;
use const SORT_DESC;
use yii\helpers\ArrayHelper;

class ObjectsIndexer
{
    public $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function clear(): void
    {
        $this->client->deleteByQuery([
            'index' => 'reception',
            'type' => 'objects',
            'body' => [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
            ],
        ]);
    }

    public function create(){
        $params =[
            'index' => 'reception',
//            'type' => 'objects',
            'body' => [
                'mappings' => [
                    'objects'=>[
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'description' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'address' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'city' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'country' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'zip' => [
                                'type' => 'integer',
                            ],
                            'can_sleep_optimal'=> [
                                'type' => 'integer',
                            ],
                            'can_sleep_max'=> [
                                'type' => 'integer',
                            ],
                            'beds'=> [
                                'type' => 'float',
                            ],
                            'space'=> [
                                'type' => 'float',
                            ],
                            'space_yard'=> [
                                'type' => 'float',
                            ],
                            'parking'=> [
                                'type' => 'keyword',
                            ],
                            'swimming_pool'=> [
                                'type' => 'keyword',
                            ],
                            'pets' => [
                                'type' => 'keyword',
                            ],
                            'air_conditioning'=> [
                                'type' => 'keyword',
                            ],
                            'smoking'=> [
                                'type' => 'keyword',
                            ],
                            'classification_star'=> [
                                'type' => 'integer',
                            ],
                            'luxurius'=> [
                                'type' => 'keyword',
                            ],
                            'first_available_date'=>[
                                'type' => 'date'
                            ],
                            'rents' => [
                                'type' => 'nested',
                                'properties' => [
                                    'id'  => [
                                        'type' => 'integer'
                                    ],
                                    'from' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'to' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'price'=> [
                                        'type' => 'float',
                                    ]
                                ]
                            ],
                            'prices' =>[
                                'type' => 'nested',
                                'properties' => [
                                    'date' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'price' => [
                                        'type' => 'float',
                                    ],
                                    'min_stay' => [
                                        'type' => 'integer',
                                    ],
                                ]
                            ],
                            'facilities'=> [
                                'type' => 'nested',
                                'properties' => [
                                    "seaview" => [
                                        'type' => 'keyword',
                                    ],
                                    "babycot" => [
                                        'type' => 'keyword',
                                    ],
                                    "breakfast" => [
                                        'type' => 'keyword',
                                    ],
                                    "halfboard" => [
                                        'type' => 'keyword',
                                    ],
                                    "fullboard" => [
                                        'type' => 'keyword',
                                    ],
                                    "berth" => [
                                        'type' => 'keyword',
                                    ],
                                    "jacuzzi" => [
                                        'type' => 'keyword',
                                    ],
                                    "terrace" => [
                                        'type' => 'keyword',
                                    ],
                                    "tv_satelite" => [
                                        'type' => 'keyword',
                                    ],
                                    "wifi" => [
                                        'type' => 'keyword',
                                    ],
                                    "internet_fast" => [
                                        'type' => 'keyword',
                                    ],
                                    "internet" => [
                                        'type' => 'keyword',
                                    ],
                                    "smoking" => [
                                        'type' => 'keyword',
                                    ],
                                    "luxurious" => [
                                        'type' => 'keyword',
                                    ],
                                    "air_conditioning" => [
                                        'type' => 'keyword',
                                    ],
                                    "tv_lcd" => [
                                        'type' => 'keyword',
                                    ],
                                    "wheelchair_accessible" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_beach" => [
                                        'type' => 'keyword',
                                    ],
                                    "pets" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_country" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_city" => [
                                        'type' => 'keyword',
                                    ],
                                    "in_city" => [
                                        'type' => 'keyword',
                                    ],
                                    "in_country" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_indoor" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_indoor_heated" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_outdoor" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_outdoor_heated" => [
                                        'type' => 'keyword',
                                    ],
                                    "parking" => [
                                        'type' => 'keyword',
                                    ],
                                    "sauna" => [
                                        'type' => 'keyword',
                                    ],
                                    "gym" => [
                                        'type' => 'keyword',
                                    ],
                                    "separate_kitchen" => [
                                        'type' => 'keyword',
                                    ],
                                    "elevator" => [
                                        'type' => 'keyword',
                                    ],
                                    "heating" => [
                                        'type' => 'keyword',
                                    ],
                                    "towels" => [
                                        'type' => 'keyword',
                                    ],
                                    "linen" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_couples" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_family" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_friends" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_large_groups" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_wedings" => [
                                        'type' => 'keyword',
                                    ],
                                    "total_privacy" => [
                                        'type' => 'keyword',
                                    ],
                                    "created"  =>[
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    "changed"=>[
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"

                                    ],
                                ],
                            ]
                        ]
                    ]
                ],
                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 4,
                                'max_gram' => 6,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ];
        $response = $this->client->indices()->create($params);
        return $response;
    }

    public function delete(){
        $params =[
            'index' => 'reception',
        ];
        $response = $this->client->indices()->delete($params);
        return $response;
    }

    public function index(Objects $object): void
    {
        $params =[
            'index' => 'reception',
//            'type' => 'objects',
            'body' => [
                'mappings' => [
                    'objects'=>[
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'description' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'address' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'city' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'country' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'zip' => [
                                'type' => 'integer',
                            ],
                            'can_sleep_optimal'=> [
                                'type' => 'integer',
                            ],
                            'can_sleep_max'=> [
                                'type' => 'integer',
                            ],
                            'beds'=> [
                                'type' => 'float',
                            ],
                            'space'=> [
                                'type' => 'float',
                            ],
                            'space_yard'=> [
                                'type' => 'float',
                            ],
                            'parking'=> [
                                'type' => 'keyword',
                            ],
                            'swimming_pool'=> [
                                'type' => 'keyword',
                            ],
                            'pets' => [
                                'type' => 'keyword',
                            ],
                            'air_conditioning'=> [
                                'type' => 'keyword',
                            ],
                            'smoking'=> [
                                'type' => 'keyword',
                            ],
                            'classification_star'=> [
                                'type' => 'integer',
                            ],
                            'luxurius'=> [
                                'type' => 'keyword',
                            ],
                            'first_available_date'=>[
                                'type' => 'date',
                                'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                            ],
                            'rents' => [
                                'type' => 'nested',
                                'properties' => [
                                    'id'  => [
                                        'type' => 'integer'
                                            ],
                                    'from' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'to' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'price'=> [
                                        'type' => 'float',
                                    ]
                                ]
                            ],
//                            'rents' => [
//                                'type' => 'nested',
//                                'properties' => [
//                                    "rent" => [
//                                        'type'=>'nested',
//                                        'properties' => [
//                                            'id'  => [
//                                                'type' => 'integer'
//                                            ],
//                                            'from' => [
//                                                'type' => 'date'
//                                            ],
//                                            'to' => [
//                                                'type' => 'date',
//                                                'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
//                                            ],
//                                            'price'=> [
//                                                'type' => 'float',
//                                            ]
//                                        ]
//                                    ]
//
//                                ]
//                            ],
                            'prices' =>[
                                'type' => 'nested',
                                'properties' => [
                                    'date' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'price' => [
                                        'type' => 'float',
                                    ],
                                    'min_stay' => [
                                        'type' => 'integer',
                                    ],
                                ]
                            ],
                            'facilities'=> [
                                'type' => 'nested',
                                'properties' => [
                                    "seaview" => [
                                        'type' => 'keyword',
                                    ],
                                    "babycot" => [
                                        'type' => 'keyword',
                                    ],
                                    "breakfast" => [
                                        'type' => 'keyword',
                                    ],
                                    "halfboard" => [
                                        'type' => 'keyword',
                                    ],
                                    "fullboard" => [
                                        'type' => 'keyword',
                                    ],
                                    "berth" => [
                                        'type' => 'keyword',
                                    ],
                                    "jacuzzi" => [
                                        'type' => 'keyword',
                                    ],
                                    "terrace" => [
                                        'type' => 'keyword',
                                    ],
                                    "tv_satelite" => [
                                        'type' => 'keyword',
                                    ],
                                    "wifi" => [
                                        'type' => 'keyword',
                                    ],
                                    "internet_fast" => [
                                        'type' => 'keyword',
                                    ],
                                    "internet" => [
                                        'type' => 'keyword',
                                    ],
                                    "smoking" => [
                                        'type' => 'keyword',
                                    ],
                                    "luxurious" => [
                                        'type' => 'keyword',
                                    ],
                                    "air_conditioning" => [
                                        'type' => 'keyword',
                                    ],
                                    "tv_lcd" => [
                                        'type' => 'keyword',
                                    ],
                                    "wheelchair_accessible" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_beach" => [
                                        'type' => 'keyword',
                                    ],
                                    "pets" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_country" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_city" => [
                                        'type' => 'keyword',
                                    ],
                                    "in_city" => [
                                        'type' => 'keyword',
                                    ],
                                    "in_country" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_indoor" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_indoor_heated" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_outdoor" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_outdoor_heated" => [
                                        'type' => 'keyword',
                                    ],
                                    "parking" => [
                                        'type' => 'keyword',
                                    ],
                                    "sauna" => [
                                        'type' => 'keyword',
                                    ],
                                    "gym" => [
                                        'type' => 'keyword',
                                    ],
                                    "separate_kitchen" => [
                                        'type' => 'keyword',
                                    ],
                                    "elevator" => [
                                        'type' => 'keyword',
                                    ],
                                    "heating" => [
                                        'type' => 'keyword',
                                    ],
                                    "towels" => [
                                        'type' => 'keyword',
                                    ],
                                    "linen" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_couples" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_family" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_friends" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_large_groups" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_wedings" => [
                                        'type' => 'keyword',
                                    ],
                                    "total_privacy" => [
                                        'type' => 'keyword',
                                    ],
                                    "created"  =>[
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    "changed"=>[
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                ],
                            ]
                        ]
                    ]
                ],
                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 4,
                                'max_gram' => 6,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ];
        $this->client->index([
            'index' => 'reception',
            'type' => 'objects',
            'id' => $object->id,
            'body' => [
                'mappings' => [
                    'objects'=>[
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'description' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'address' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'city' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'country' => [
                                'type' => 'text',
                                'fielddata'=>true
                            ],
                            'zip' => [
                                'type' => 'integer',
                            ],
                            'can_sleep_optimal'=> [
                                'type' => 'integer',
                            ],
                            'can_sleep_max'=> [
                                'type' => 'integer',
                            ],
                            'beds'=> [
                                'type' => 'float',
                            ],
                            'space'=> [
                                'type' => 'float',
                            ],
                            'space_yard'=> [
                                'type' => 'float',
                            ],
                            'parking'=> [
                                'type' => 'keyword',
                            ],
                            'swimming_pool'=> [
                                'type' => 'keyword',
                            ],
                            'pets' => [
                                'type' => 'keyword',
                            ],
                            'air_conditioning'=> [
                                'type' => 'keyword',
                            ],
                            'smoking'=> [
                                'type' => 'keyword',
                            ],
                            'classification_star'=> [
                                'type' => 'integer',
                            ],
                            'luxurius'=> [
                                'type' => 'keyword',
                            ],
                            'first_available_date'=>[
                                'type' => 'date'
                            ],
                            'rents' => [
                                'type' => 'nested',
                                'properties' => [
                                    'id'  => [
                                        'type' => 'integer'
                                        ],
                                    'from' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'to' => [
                                        'type' => 'date',
                                        'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
                                    ],
                                    'price'=> [
                                        'type' => 'float',
                                    ]
                                ]
                            ],
//                            'rents' => [
//                                'type' => 'nested',
//                                'properties' => [
//                                    "rent" => [
//                                        'type'=>'nested',
//                                        'properties' => [
//                                            'id'  => [
//                                                'type' => 'integer'
//                                            ],
//                                            'from' => [
//                                                'type' => 'date',
//                                                'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
//                                            ],
//                                            'to' => [
//                                                'type' => 'date',
//                                                'format' =>  "yyyy-mm-dd HH:mm:ss||yyyy-mm-dd||epoch_millis"
//                                            ],
//                                            'price'=> [
//                                                'type' => 'float',
//                                            ]
//                                        ]
//                                    ]
//
//                                ]
//                            ],
                            'prices' =>[
                                'type' => 'nested',
                                'properties' => [
                                    'date' => [
                                        'type' => 'date'
                                    ],
                                    'price' => [
                                        'type' => 'float',
                                    ],
                                    'min_stay' => [
                                        'type' => 'integer',
                                    ],
                                ]
                            ],
                            'facilities'=> [
                                'type' => 'nested',
                                'properties' => [
                                    "seaview" => [
                                        'type' => 'keyword',
                                    ],
                                    "babycot" => [
                                        'type' => 'keyword',
                                    ],
                                    "breakfast" => [
                                        'type' => 'keyword',
                                    ],
                                    "halfboard" => [
                                        'type' => 'keyword',
                                    ],
                                    "fullboard" => [
                                        'type' => 'keyword',
                                    ],
                                    "berth" => [
                                        'type' => 'keyword',
                                    ],
                                    "jacuzzi" => [
                                        'type' => 'keyword',
                                    ],
                                    "terrace" => [
                                        'type' => 'keyword',
                                    ],
                                    "tv_satelite" => [
                                        'type' => 'keyword',
                                    ],
                                    "wifi" => [
                                        'type' => 'keyword',
                                    ],
                                    "internet_fast" => [
                                        'type' => 'keyword',
                                    ],
                                    "internet" => [
                                        'type' => 'keyword',
                                    ],
                                    "smoking" => [
                                        'type' => 'keyword',
                                    ],
                                    "luxurious" => [
                                        'type' => 'keyword',
                                    ],
                                    "air_conditioning" => [
                                        'type' => 'keyword',
                                    ],
                                    "tv_lcd" => [
                                        'type' => 'keyword',
                                    ],
                                    "wheelchair_accessible" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_beach" => [
                                        'type' => 'keyword',
                                    ],
                                    "pets" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_country" => [
                                        'type' => 'keyword',
                                    ],
                                    "near_city" => [
                                        'type' => 'keyword',
                                    ],
                                    "in_city" => [
                                        'type' => 'keyword',
                                    ],
                                    "in_country" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_indoor" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_indoor_heated" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_outdoor" => [
                                        'type' => 'keyword',
                                    ],
                                    "swimming_pool_outdoor_heated" => [
                                        'type' => 'keyword',
                                    ],
                                    "parking" => [
                                        'type' => 'keyword',
                                    ],
                                    "sauna" => [
                                        'type' => 'keyword',
                                    ],
                                    "gym" => [
                                        'type' => 'keyword',
                                    ],
                                    "separate_kitchen" => [
                                        'type' => 'keyword',
                                    ],
                                    "elevator" => [
                                        'type' => 'keyword',
                                    ],
                                    "heating" => [
                                        'type' => 'keyword',
                                    ],
                                    "towels" => [
                                        'type' => 'keyword',
                                    ],
                                    "linen" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_couples" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_family" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_friends" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_large_groups" => [
                                        'type' => 'keyword',
                                    ],
                                    "for_wedings" => [
                                        'type' => 'keyword',
                                    ],
                                    "total_privacy" => [
                                        'type' => 'keyword',
                                    ],
                                    "created"  =>[
                                        'type' => 'date'
                                    ],
                                    "changed"=>[
                                        'type' => 'date'
                                    ],
                                ],
                            ]
                        ]
                    ]
                ],
                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 4,
                                'max_gram' => 6,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
                'id' => $object->id,
                'name' => $object->name,
                'description' => strip_tags($object->description),
                'city'=>($object->unit)?($object->unit->city_name ?? null):new \stdClass(),
                'address'=>($object->unit)?(($object->unit->adress)??null):new \stdClass(),
                'country'=>($object->unit)?(($object->unit->country)? $object->unit->country->country??null:null):new \stdClass(),
                'zip'=>($object->unit)?(($object->unit->city_zip)?? null):new \stdClass(),
                'space'=> $object->realEstates->space??0,
                'space_yard'=> $object->realEstates->space_yard??0,
                'parking'=> $object->realEstates->parking??"N",
                'swimming_pool'=> $object->realEstates->swimming_pool??"N",
                'pets'=> $object->realEstates->pets??"N",
                'air_conditioning'=> $object->realEstates->air_conditioning??"N",
                'smoking'=> $object->realEstates->smoking??"N",
                'classification_star'=> $object->realEstates->classification_star?? new \stdClass(),
                'space'=> $object->realEstates->space,
                'luxurius'=> $object->realEstates->luxurius??"N",
                'beds'=>$object->realEstates->beds??2,
                'can_sleep_max'=> $object->realEstates->can_sleep_max??2,
                'can_sleep_optimal'=> $object->realEstates->can_sleep_optimal??2,
                'facilities'=>  array_map(function($facility) {
                    $array=[];
                        foreach($facility->attributes as $attribute=>$value)
                            $array = ArrayHelper::merge($array,[ $attribute=>$value?? new \stdClass() ]);
                    return $array;
                } ,$object->getFacilities()->all()),
                'prices' =>  array_map(function($price) {
                    return [
                        'id'=>$price->id,
                        'date' => $price->day,
                        'price' => $price->price,
                        'min_stay' => $price->min_stay,
                        ];
                    }, $object->prices, ArrayHelper::getColumn($object->prices,'id')),
                'first_available_date'=>($object->rents)?$object->rents[0]->until_date:"1970-01-01",
                'rents' => array_map(function($rent)
                    {  return [
                        'id'=>$rent->id,
                        'from' => $rent->from_date,
                        'to' => $rent->until_date,
                        'price' => $rent->price,
                    ];
                }, $object->rents,  ArrayHelper::getColumn($object->rents,'id')),

            ],
        ]);
    }

    public function remove(Objects $object): void
    {
        $this->client->delete([
            'index' => 'reception',
            'type' => 'objects',
            'id' => $object->id,
        ]);
    }

    private function getAvailability($object) {
       $availability=[];
                        $rents = $object->rents;
                        if (count($rents)==0) return  $availability[] =  [ 'from' => "1970-01-01", 'to' => "2050-01-01"];
                        elseif (count($rents)>1) {
                           for($i=0; $i < count($rents) - 1 ; $i++) {  //до последнего букинга, но не включая его
                               $availability[] = [ 'from' => $rents[$i]->until_date, 'to' => $rents[$i+1]->from_date];
                            }
                            $availability[] =  [ 'from' => $rents[count($rents)]->until_date, 'to' => "2050-01-01"];
                        }
                        else {
                            $availability[] =  [ 'from' => $rents[count($rents)]->until_date, 'to' => "2050-01-01"];
                        }
                        return $availability;
    }
}