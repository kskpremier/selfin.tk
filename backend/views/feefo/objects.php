<?php

use backend\helpers\FeefoHelper;
use backend\helpers\RentsHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VacationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('/css/js/feefo.js');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Modal "Добавить всадника" -->

<?php
yii\bootstrap\Modal::begin([
    'header' => 'Xml',
    'id' => 'myModal',
    'size' => 'modal-md',
]);
?>
<div id='modal-content'>Loading...</div>
<?php yii\bootstrap\Modal::end(); ?>


<div class="feefo-index">

    <?php Pjax::begin(); ?>

    <?php
    $colorPluginOptions =  [
        'showPalette' => false,
        'showPaletteOnly' => false,
        'showSelectionPalette' => false,
        'showAlpha' => false,
        'allowEmpty' => false,
        'preferredFormat' => 'name',

    ];

    echo GridView::widget([
        'id' => 'grid',
//        'options'=>['id'=>'dynagrid-1'] ,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar' =>  [
            ['content' => Html::button('<i class="glyphicon glyphicon-gift"></i>', ['type' => 'button', 'title' =>  'Add ProductCatalog', 'class' => 'btn btn-success', 'onclick' =>'addProductCatalog()']).
                 Html::button('<i class="glyphicon glyphicon-tasks"></i>', ['type' => 'button', 'title' =>  'Add in Schedule', 'class' => 'btn btn-success', 'onclick' =>'addSchedule()']).
                "<div class=''></div> <div class=\"col-md-4\">".
                   DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'start',
                        'options' => ['placeholder' => 'from'],
                        'type' => DatePicker::TYPE_INPUT ,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,]
                    ])."</div>
                <div class=\"col-md-4\">".
                    DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'until',
                        'options' => ['placeholder' => 'to'],
                        'type' => DatePicker::TYPE_INPUT ,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,]
                    ])."</div>".
                Html::button('<i class="glyphicon glyphicon-th-list"></i>', ['type' => 'button', 'title' =>  'Add Sales', 'class' => 'btn btn-default', 'onclick' =>'addSales()'])
            ],

            '{toggleData}',
            'options'=>['class'=> 'text-center col-lg-12']
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Objects fo Feefo integration</h3>',
            'before' =>  '<div style="padding-top: 7px;"><em>* You can set list for automatic uploads all rents to Feefo, build csv files for Product Catalog or for Sales</em></div>',
            'after' => false
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 20],
        'exportConfig' => true,
        'itemLabelSingle' => 'object',
        'itemLabelPlural' => 'objects',


        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            'id',
            [   'attribute'=>'searchString',
                'label'=>'Objects',
                'filterType'=>GridView::FILTER_SELECT2,
                'filterWidgetOptions'=>[
                    'options' => ['placeholder' => 'Property name...','multiple' => false],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10
                    ],
                    'data'=> ArrayHelper::map(RentsHelper::getApartments(), 'id','name'),
//                    'value'=> $model->property,
                ],
                'value'=>function($model, $key, $index, $widget) {
                    return ($model->name)? $model->name: '-';
                }],
            ['attribute'=>'scheduled',
                'label'=>'Scheduled',
//                'filterType'=>GridView::FILTER_DATE,
                'format'=>'raw',
                'width'=>'370px',
//                'filterWidgetOptions'=>[
//                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
//                ],
                'value'=>function($model) {
                    return FeefoHelper::getSchedule($model->id);
                }],
//            [
//                'class' => '\kartik\grid\ActionColumn',
//                'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"></i>'],
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
