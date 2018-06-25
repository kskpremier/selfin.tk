<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VacationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacations';
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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Sync with MyRentReception', ['sync'], ['class' => 'btn btn-success']) ?>
    </p>

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
            Html::button('<i class="glyphicon  glyphicon-random"></i>', ['type' => 'button', 'title' =>  'Link Apartment', 'class' => 'btn btn-success', 'onclick' =>
                ' var keys = $("#grid").yiiGridView("getSelectedRows");
                    $.post({
                       url: "/vacation/link", // your controller action
                       dataType: "json",
                       data: {keylist: keys},
                       success: function(data) {
                          if (data.status === "success") {
                              alert("Connected" + data.total);
                          }
                       },
                  });
                     $("input:checked").removeAttr(\'checked\');
                    $(\'.danger\').removeClass(\'danger\');

                    '])

            . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' =>'Reset Grid'])
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],
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
    'itemLabelSingle' => 'property',
    'itemLabelPlural' => 'properties',


//
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['attribute'=>'id',
                'label'=>'My-Rent ID'],
            'name',
//            'XML:ntext',
//            'link',

            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'link',
                'vAlign' => 'middle'
            ],
            ['attribute'=>'keyId',
                 'label'=>'VacationKey ID',
                'value'=>function($model) {
                    return ($model->keyId)? $model->keyId: '-';
                }],
            ['attribute'=>'XML',
                'label'=>'xml',
                'format'=>'raw',
                'value'=>function($model) {

                    $string = Html::button('<span class="glyphicon glyphicon glyphicon-file">'.' '.$model->id.".xml".'</span>',
                            ['class' => '',
                                'onClick'=>'
                                $("#myModal").modal("show")
                                 .find("#modal-content")
                                 .load("http://backend.domouprav.local/vacation/view-ajax?id='.$model->id.'");
                                ']
                        );
                    return ($model->link)? $string : '-';
                }
            ],
            ['attribute'=>'xml',
                'label'=>'response',
                'format'=>'raw',
                'value'=>function($model) {
                    $string = Html::button('<span class="glyphicon glyphicon glyphicon-file">'.'Response_'.$model->id.".xml".'</span>',
                        ['class' => '',
                            'onClick'=>'
                                $("#myModal").modal("show")
                                 .find("#modal-content")
                                 .load("http://backend.domouprav.local/vacation/view-ajax-response?id='.$model->id.'");
                                ']
                    );
                    return ($model->response)? $string : '-';
                }
            ],

            [
                'class' => '\kartik\grid\ActionColumn',
                'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"></i>'],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<script>

    // $('body').on('hidden.bs.modal', '.modal', function () {
    //     $(this).removeData('bs.modal');
    // });
</script>
