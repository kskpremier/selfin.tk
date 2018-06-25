<?php

use backend\helpers\RentsHelper;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchObjectModel backend\models\ObjectsSearch */
/* @var $objectDataProvider yii\data\ActiveDataProvider */

//$this->title = 'Superuser view';
//$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile(Url::to("@backend/web/scripts/search.js")); //  /Users/superbrodyaga/Sites/reception/backend/web/scripts/search.js

//$dataProvider->pagination->pageParam = 'rents-page';
//$dataProvider->sort->sortParam = 'rents-sort';
//
//$objectDataProvider->pagination->pageParam = 'object-page';
//$objectDataProvider->sort->sortParam = 'object-sort';


?>
<div class="pane panel-default">
<div class="col-md-10">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div class="rents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
                'id'=>"table_rents",
                 'class'=>"table table-hover datatable-responsive-row-control table-xxs"
],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

//            'id',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{edit}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        return Html::a('edit',
                            ['redirect', 'id' => $model->id ],
                            ['class'=>"label label-flat border-default text-default"]//,
                        //'disabled'=>(isset ($model->apartment->doorlocks))?false:true]
                        );
                    },

                ],

            ],
            [ 'attribute'=>'reception',
                'label'=>'Reception',
                'value'=> function ($model) {
                return  RentsHelper::getReception($model->reception);
                },
                'filter' => RentsHelper::getReceptionList($searchModel->reception)

            ],
            ['attribute'=>'object',
                'label'=>'Object',
                'value'=> function($model){
                    return $model->object->name;}
            ],
            'contact_name',
            ['attribute'=>'from_date',
                'label'=>'Date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'name' => 'start',
                    'value' => $searchModel->start,
                    'type' => DatePicker::TYPE_RANGE,
                    'name2' => 'until',
                    'value2' => $searchModel->until,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
                'format' => 'raw',
                'value'=> function($model){
                    $row1 = "<div class='row'>". $model->from_date ." >> ". $model->until_date ."</div>";
                    $row2 =  "<div class='row'>(". $model->getNights() ." nights) - ". date("H-i",strtotime($model->from_time)) ." h</div>";
                    return  $row1.$row2;
                },
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],


            ['attribute'=>'status',
                'format' => 'raw',
                'label'=>'Status',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value'=> function($model){
                    $row1 = "<div class='row'>".RentsHelper::statusLabel($model)."</div>";
                    $row2 =  "<div class='row'>".$model->getDaysBefore()."</div>";
                    return $row1.$row2;}
            ],
            ['attribute'=>'source',
                'label'=>'Source',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value'=> function($model){
                return RentsHelper::getSource($model);
                }
            ],
            ['attribute'=>'price',

                'value'=> function($model){
                return RentsHelper::getPrice($model);
                },
                'contentOptions' => ['class' => 'text-left'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]);
     ?>
    <?php Pjax::end(); ?>

<!--    --><?php //Pjax::begin(); ?>

<!--    --><?php //echo  $this->render('/objects/index', ['searchModel' => $searchObjectModel,'dataProvider' => $objectDataProvider]); ?>
<!--    --><?php //Pjax::end(); ?>
</div>

    </div>
</div>
</div>

