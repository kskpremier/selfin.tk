<?php

use backend\helpers\RentsHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VacationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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


<div class="vacation-index">


    <?php Pjax::begin(); ?>
    <div class="filters-search">

        <?php $form = ActiveForm::begin([
            'id'=>'filter-form',
//            'method' => 'get',
        ]); ?>

        <?= $form->field($model, 'name') ?>

        <?php ActiveForm::end(); ?>

    </div>

    <?php
    $colorPluginOptions =  [
        'showPalette' => true,
        'showPaletteOnly' => true,
        'showSelectionPalette' => true,
        'showAlpha' => false,
        'allowEmpty' => false,
        'preferredFormat' => 'name',
        'palette' => [
            [
                "white", "black", "grey", "silver", "gold", "brown",
            ],
            [
                "red", "orange", "yellow", "indigo", "maroon", "pink"
            ],
            [
                "blue", "green", "violet", "cyan", "magenta", "purple",
            ],
        ]
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
            ['content' =>
                Html::button('<i class="glyphicon  glyphicon-plus"></i>', ['type' => 'button', 'title' =>  'Add to filter', 'class' => 'btn btn-success', 'onclick' =>
                    ' var keys = $("#grid").yiiGridView("getSelectedRows");
                        var $form =  $("#filter-form");
                        var name = $("#filters-name").val();
                        if (name==""){
                         alert("Name of filter should be set");
                        }
                        else {
                            $.post({
                               url: "/filters/build", // your controller action
                               dataType: "json",
                               data: {keylist: keys, name: name },
                               success: function(data) {
                                  if (data.status === "success") {
                                      alert("Added " + data.total + " objects to Filter "+data.name
                                  );
                                  }
                               },
                          });
                            $("input:checked").removeAttr("checked");
                            $(".danger").removeClass("danger");
                             return false;
                    }
                    ']).
                Html::button('<i class="glyphicon  glyphicon-minus"></i>', ['type' => 'button', 'title' =>  'Remove from filter', 'class' => 'btn btn-danger', 'onclick' =>
                    ' var keys = $("#grid").yiiGridView("getSelectedRows");
                        var $form =  $("#filter-form");
                        var name = $("#filters-name").val();
                        if (name==""){
                         alert("Name of filter should be set");
                        }
                        else {
                            $.post({
                               url: "/filters/remove", // your controller action
                               dataType: "json",
                               data: {keylist: keys, name: name },
                               success: function(data) {
                                  if (data.status === "success") {
                                      alert("Removed  " + data.total + " objects from Filter "+data.name);
                                  }
                               },
                          });
                            $("input:checked").removeAttr("checked");
                            $(".danger").removeClass("danger");
                             return false;
                    }
                    '])
//                .Html::checkbox('reception')

//                .
//                ' '.
//                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' =>'Reset Grid'])
            ],
//            '{export}',
            '{toggleData}',
        ],
        // set export properties
//        'export' => [
//            'fontAwesome' => true
//        ],
        // parameters from the demo form
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => true,
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'exportConfig' => true,
        'itemLabelSingle' => 'object',
        'itemLabelPlural' => 'objects',


//
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['attribute'=>'reception',
                'label'=>'Reception',
                'filterType'=>GridView::FILTER_SELECT2,
                'filterWidgetOptions'=>[
                    'pluginOptions' => [
//                        'allowClear' => true,
                    ],
                        'data'=> RentsHelper::getReceptionList(),
                        ],
                'value'=>function($model, $key, $index, $widget) {
                    return RentsHelper::getReception($model->user_id);
                },
                 'group'=>true,
                ],
//            [
//                'class' => 'kartik\grid\BooleanColumn',
//                'attribute' => 'link',
//                'vAlign' => 'middle'
//            ],
            ['attribute'=>'name',
                'label'=>'Apartment',
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

//            [
//                'class' => '\kartik\grid\ActionColumn',
//                'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"></i>'],
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<script>

    // $('body').on('hidden.bs.modal', '.modal', function () {
    //     $(this).removeData('bs.modal');
    // });
</script>