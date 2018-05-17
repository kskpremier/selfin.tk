<?php

use backend\helpers\FiltersHelper;
use backend\models\Filters;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FiltersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Filters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filters-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Filters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            ['attribute'=>'name',

                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'name',
                    'data'=>ArrayHelper::map(Filters::find()->all(), 'name', 'name'),
                    'options' => ['placeholder' => 'Filter name...','multiple' => false],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10
                    ],
                ]),
                ],
            [
                'attribute'=>'ids',
                'format'=>'raw',

//                'filter' => Select2::widget([
//                    'model' => $searchModel,
//                    'attribute' => 'name',
//                        'data'=>ArrayHelper::map(Filters::find()->all(), 'name', 'name')
//                ]),
                'value'=> function($model) {
                    $array =  unserialize($model->ids);
                    return FiltersHelper::getNames($array);
                }
            ],
            [
                'attribute'=>'created_at',
                'format' => 'datetime',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'value'=> function($model){
                        return date ("Y-m-d", $model->created_at);
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'Y-m-d',
                    ],
                ]),
                'value'=> function($model) {
                    return date("Y-m-d", $model->created_at);
                }
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
