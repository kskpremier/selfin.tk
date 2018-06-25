<?php

use backend\helpers\RentsHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model reception\entities\MyRent\FeefoSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feefo-schedule-form">
<!--    --><?php //Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'from')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'to')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'created')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'updated')->hiddenInput()->label(false) ?>

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
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar' =>  [
            ['content' =>" <div class=\"col-md-5\">".
                DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'from',
                    'options' => ['placeholder' => 'from'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ]).
                "</div>
                <div class=\"col-md-5\">".
                DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'to',
                    'options' => ['placeholder' => 'to'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ]).
                "</div>".
                Html::button('<i class="glyphicon  glyphicon-download-alt"></i>', ['type' => 'button', 'title' =>  'Add Sales', 'class' => 'btn btn-danger', 'onclick' =>
                    ' var keys = $("#grid").yiiGridView("getSelectedRows");
                        var $form =  $("#filter-form");
                        var start = $("#objectssearch-from").val();
                        var until = $("#objectssearch-to").val();
                       
                        if (!count(keys)){
                            alert("No one object checked");
                        }
                        else {
                            $.post({
                               url: "/feefo-schedule/created", // your controller action
                               dataType: "json",
                               data: {keylist: keys,  from: from, to: to},
                               success: function(data) {
                                  if (data.status === "success") {
//                                      alert("Added  " + data.total + " objects from Filter "+data.name);
                                  }
                               },
                          });
//                            $("input:checked").removeAttr("checked");
//                            $(".danger").removeClass("danger");
                             return false;
                    }'
                ])
            ],
            '{toggleData}',
        ],

        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => true,
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 20],
        'exportConfig' => true,
        'itemLabelSingle' => 'object',
        'itemLabelPlural' => 'objects',
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            [   'attribute'=>'searchString',
                'label'=>false,//'Apartment',
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
            ['attribute'=>'from',
                'label'=>'from',
                'filterType'=>GridView::FILTER_DATE,
                'format'=>'raw',
                'width'=>'170px',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
                'value'=>function($model) {
                    return ($model->from)? date("Y-m-d",$model->from): '-';
                }],
            ['attribute'=>'to',
                'label'=>'to',
                'filterType'=>GridView::FILTER_DATE,
                'format'=>'raw',
                'width'=>'170px',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
                'value'=>function($model) {
                    return ($model->from)? date("Y-m-d",$model->from): '-';
                }],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'link',
                'vAlign' => 'middle'
            ],

//            [
//                'class' => '\kartik\grid\ActionColumn',
//                'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"></i>'],
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//            ],

        ],
    ]); ?>
<!--    --><?php //Pjax::end(); ?>


    <?php ActiveForm::end(); ?>

</div>
