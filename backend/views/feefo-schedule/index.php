<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel reception\entities\MyRent\FeefoScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Feefo Schedules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Feefo Schedule'), ['/feefo/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'object_id',
            ['attribute'=>'from',
                'value'=>function ($model) {return date("Y-M-d", $model->from); },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created',
                    'value'=> function($model){
                        return ($model->from == 0)? '':  $model->from;
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
            ],
            ['attribute'=>'to',
                'value'=>function ($model) {return date("Y-M-d", $model->to); },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created',
                    'value'=> function($model){
                        return ($model->to == 0)? '':  $model->to;
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
