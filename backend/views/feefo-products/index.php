<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel reception\entities\Feefo\FeefoProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Feefo Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-products-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('app', 'Create Feefo Products'), ['/feefo/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'object_id',
            ['attribute'=>'title',

                'value'=>function($model){
                    $params = json_decode($model->params,true);
                    return $params['title'];
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



            ['attribute'=>'CSV file',
                'format'=>'raw',
                'value'=> function ($model) {
                    $fileName = Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",$model->created)."_vipholiday_objects.csv";
                    return Html::a(' Download',
                        ['download','fileName'=>$fileName],
                        ['title'=>'Get CSV file', 'class'=>'glyphicon glyphicon-download-alt']);
                },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete}',

            ]
        ],
    ]); ?>

</div>
