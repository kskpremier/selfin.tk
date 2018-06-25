<?php

namespace reception\repositories\Objects;

use Elasticsearch\Client;
use backend\models\Objects;
use reception\forms\MyRent\DetailFilterForm;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ObjectsReadRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function count(): int
    {
        return Objects::find()->active()->count();
    }

    public function getAllByRange(int $offset, int $limit): array
    {
        return Objects::find()->alias('p')->active('p')->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    public function getByUser($user){
        return Objects::find()->active()->forUsers($user)->all();
    }

    /**
     * @return iterable|Objects[]
     */
    public function getAllIterator(): iterable
    {
        return Objects::find()->alias('p')->active('p')->with('unit', 'pictures')->each();
    }

    public function getAll(): DataProviderInterface
    {
        $query = Objects::find()->alias('p')->active('p')->with('unit', 'pictures','prices');
        return $this->getProvider($query);
    }

    public function getAllByKeys($keys): DataProviderInterface
    {
        $query = \reception\entities\MyRent\Objects::find()->select("objects.*, objects_realestates_descriptions.short, objects_realestates_descriptions.language_id, 
            objects_realestates.name")->joinWith(['objectsRealestatesDescriptions','objectsRealestates'])
            ->where(['objects.id'=>$keys])->andWhere(['objects_realestates_descriptions.language_id'=>1])
            ->orderBy(['objects.id'=>SORT_ASC,'objects_realestates_descriptions.language_id'=>SORT_ASC]);

        return $this->getProvider($query);
    }

//    public function getAllByCategory(Category $category): DataProviderInterface
//    {
//        $query = Objects::find()->alias('p')->active('p')->with('mainPhoto', 'category');
//        $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
//        $query->joinWith(['categoryAssignments ca'], false);
//        $query->andWhere(['or', ['p.category_id' => $ids], ['ca.category_id' => $ids]]);
//        $query->groupBy('p.id');
//        return $this->getProvider($query);
//    }
//
//    public function getAllByBrand(Brand $brand): DataProviderInterface
//    {
//        $query = Objects::find()->alias('p')->active('p')->with('mainPhoto');
//        $query->andWhere(['p.brand_id' => $brand->id]);
//        return $this->getProvider($query);
//    }
//
//    public function getAllByTag(Tag $tag): DataProviderInterface
//    {
//        $query = Objects::find()->alias('p')->active('p')->with('mainPhoto');
//        $query->joinWith(['tagAssignments ta'], false);
//        $query->andWhere(['ta.tag_id' => $tag->id]);
//        $query->groupBy('p.id');
//        return $this->getProvider($query);
//    }
//
//    public function getFeatured($limit): array
//    {
//        return Objects::find()->active()->with('mainPhoto')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
//    }

    public function find($id): ?Objects
    {
        return Objects::find()->active()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.prices.price' => SORT_ASC],
                        'desc' => ['p.prices.price' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSizeLimit' => [15, 100],
            ]
        ]);
    }

    public function search(DetailFilterForm $form): DataProviderInterface
    {


        $pagination = new Pagination([
            'pageSizeLimit' => [15, 100],
            'validatePage' => false,
        ]);

        $sort = new Sort([
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'id',
                'name',
            ],
        ]);

        $response = $this->client->search([
            'index' => 'reception',
            'type' => 'objects',
            'body' => [
                '_source' => ['id'],
                'from' => $pagination->getOffset(),
                'size' => $pagination->getLimit(),
                'sort' => array_map(function ($attribute, $direction) {
                    return [$attribute => ['order' => $direction === SORT_ASC ? 'asc' : 'desc']];
                }, array_keys($sort->getOrders()), $sort->getOrders()),
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
                                count($form->stars) ? ['terms' => ['classification_star' => $form->stars]] : false,
                                $form->guests ? ['range' => ['can_sleep_max'=>['gte' => $form->guests]]] : false,
                                $form->space ? ['range' => ['space' =>['gte' => $form->space]]] : false,
                                $form->location ? [ 'multi_match' => [
                                    'query'=>$form->location,
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
                                                    'gt'=> $form->from ?? "2050-01-01",
                                                    'lt'=>$form->to?? "1970-01-01"
                                                ]
                                            ],
                                            'range'=> [
                                                'rents.to'=> [
                                                    'gt'=> $form->from ?? "2050-01-01",
                                                    'lt'=> $form->to?? "1970-01-01"
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

        $ids = ArrayHelper::getColumn($response['hits']['hits'], '_source.id');

        if ($ids) {
            $query = Objects::find()
                ->active()
                ->with('unit', 'pictures','prices')
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
