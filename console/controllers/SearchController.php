<?php

namespace console\controllers;

use backend\models\Objects;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use reception\services\search\ObjectsIndexer;
use const SORT_ASC;
use yii\console\Controller;

class SearchController extends Controller
{
    private $indexer;

    public function __construct($id, $module, ObjectsIndexer $indexer, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->indexer = $indexer;
    }

    public function actionReindex(): void
    {
        $query = Objects::find()
            ->active()
            ->withUnit()   //that have addresses etc.
            ->with(['rents', 'prices', 'facilities', 'realEstates','unit'])
            ->andFilterWhere(['user_id'=>611])
            ->orderBy(['id'=>SORT_ASC]);


        $this->stdout('Clearing' . PHP_EOL);
        try {
            $this->indexer->clear();
            $this->indexer->delete();
        } catch (Missing404Exception $e) {
            $this->stdout('Index is empty!' . PHP_EOL);
        }
        $this->indexer->create();
        $this->stdout('Indexing of objects' . PHP_EOL);

            foreach ($query->each() as $object) {
                /** @var Product $object */
                $this->stdout('Object #' . $object->id . PHP_EOL);
                $this->indexer->index($object);
            }


        $this->stdout('Done!' . PHP_EOL);
    }
}