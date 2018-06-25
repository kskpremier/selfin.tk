<?php

use backend\helpers\FeefoHelper;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel reception\entities\Feefo\FeefoSalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feefo Sales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Feefo Sales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [ 'style' => 'table-layout:fixed;' ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rent_id',
            ['attribute'=>'property',
                'label'=>'Object',
                'format'=>'raw',
                'value'=>function($model){
            if ($model->object_id)
                    $object_id = $model->object_id;
                    else {
                        $params = json_decode($model->params, true);
                        $object_id = $params['productsearchcode'];
                    }
                    return Html::a(FeefoHelper::getProductName($object_id),['/feefo-products/look','object_id'=>$object_id]);
                }
            ],
            ['attribute'=>'email',
                'value'=>function($model){
                    $params = json_decode($model->params,true);
                    return $params['email'];
                }
            ],
            ['attribute'=>'name',
                'value'=>function($model){
                    $params = json_decode($model->params,true);
                    return $params['name'];
                }
            ],
            ['attribute'=>'created',
             'value'=>function ($model) {return date("Y-M-d", $model->created); },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created',
                    'value'=> function($model){
                        return ($model->created == 0)? '':  $model->created;
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
                ],

            'log:ntext',
            ['attribute'=>'CSV file',
                'format'=>'raw',
            'value'=> function ($model) {
                        $fileName = Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",$model->created)."_vipholiday_rents.csv";
                        return ($model->log != "Not sent. Email is in stop list!")?Html::a(' Download',
                            ['/feefo/download','fileName'=>$fileName],
                            ['title'=>'Get CSV file', 'class'=>'glyphicon glyphicon-download-alt']):'';
                    },
                ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete} {upload}',
                'buttons' => [
                        'upload'=>  function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-success glyphicon glyphicon-upload"></span>',
                            ['/feefo/upload', 'id' => $model->id ],
                            ['class' => '',
                                'title'=>'Upload to Feefo']
                        );
                    },
                ]
            ]
        ],
    ]); ?>

</div>
