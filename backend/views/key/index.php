<?php

use yii\helpers\Html;
use reception\helpers\TTLHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KeySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Keys');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo  Html::a(Yii::t('app', 'Create Key'), ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'start_date',
                'label'=>'From',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start_date',
                    'value'=> function($model){
                        return ($model->start_date == 0)? '': date('dd-M-yyyy', $model->start_date);
                    },
                   // 'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_INPUT,
                    //'separator' => '-',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
                //'format' => 'datetime',
                'value'=> function($model){
                    return ($model->start_date == 0)? '': date('d-m-Y h:i', $model->start_date);
                }
            ],
            ['attribute'=>'end_date',
                'label'=>'To',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end_date',
                    'value'=> function($model){
                        return ($model->start_date == 0)? '': date('dd-M-yyyy', $model->start_date);
                    },
                    // 'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_INPUT,
                    //'separator' => '-',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
               // 'format' => 'datetime',
                'value'=> function($model){
                    return ($model->end_date == 0)? '': date('d-m-Y h:i', $model->end_date);
                },

            ],
            ['attribute'=>'type',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'type',
                    'data'=>TTLHelper::getKeyTypeList(),
                    'value'=> function($model){
                        return TTLHelper::getKeyTypeName($model->type);
                    },
                ]),
                'value'=> function($model){
                    return TTLHelper::getKeyTypeName($model->type);
                }
            ],
            [
                    'attribute'=>'booking_id',
                    'label'=>'Booking',
                    'format'=>'raw',
                    'value'=> function($model) {
                                if ($model->booking_id) {
                                    return HTML::a($model->booking_id, Url::to(['booking/view', 'id' => $model->booking_id]));
                                }
                                else return HTML::tag('span','-',['class'=>'danger']);
                    } ,
            ],
            [
                'attribute'=>'doorLockName',
                'label'=>'Door lock',
                'format'=>'raw',
                'value'=> function($model) {
                    return HTML::a($model->doorLock->alias, Url::to(['door-lock/view', 'id'=>$model->door_lock_id]) );
                } ,
            ],
            [
                'attribute'=>'username',
                'label'=>'Guest/Username',
                'format'=>'raw',
                'value'=> function($model) {
                    if ($model->user_id) {
                        return HTML::a($model->user->username, Url::to(['key/index', 'userId' => $model->user_id]));
                    }
                    else return HTML::tag('span','not set',['class'=>'danger']);
                } ,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['key/view', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['key/delete', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
