<?php

use yii\helpers\Html;
use reception\helpers\TTLHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KeyboardPwdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Keyboard password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyboard-pwd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  echo Html::a(Yii::t('app', 'Create Keyboard Pwd'), ['keyboard-pwd/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'value',
            ['attribute'=>'start_date',
                'label'=>'From',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start_date',
                    'value'=> function($model) {
                        return ($model->start_date == 0)? '': date('yyyy-M-dd', $model->start_date);
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
                //'format' => 'datetime',
                'value'=> function($model){
                    return ($model->start_date == 0)? '': date('Y-m-d h:i', $model->start_date);
                }
            ],
            ['attribute'=>'end_date',
                'label'=>'To',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end_date',
                    'value'=> function($model){
                        return ($model->start_date == 0)? '': date('yyyy-M-dd', $model->start_date);
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
                    return ($model->end_date == 0)? '': date('Y-m-d h:i', $model->end_date);
                },

            ],
            ['attribute'=>'keyboard_pwd_type',
                'label'=>'Type',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'keyboard_pwd_type',
                    'data'=>TTLHelper::getKeyboardPwdTypeNameList(),
                    'value'=> function($model){
                        return TTLHelper::getKeyboardPwdTypeName($model->keyboard_pwd_type);
                    },
                ]),
                'value'=> function($model){
                    return TTLHelper::getKeyboardPwdTypeName($model->keyboard_pwd_type);
                }
            ],

//            [
//                'attribute'=>'booking_id',
//                'label'=>'Booking',
//                'format'=>'raw',
//                'value'=> function($model) {
//                    if ($model->booking_id) {
//                        return HTML::a($model->booking_id, Url::to(['booking/view', 'id' => $model->booking_id]));
//                    }
//                    else return HTML::tag('span','-',['class'=>'danger']);
//                } ,
//            ],
            [
                'attribute'=>'doorLockName',
                'label'=>'Door lock',
                'format'=>'raw',
                'value'=> function($model) {
                    return HTML::a($model->doorLock->lock_alias, Url::to(['door-lock/view', 'id'=>$model->door_lock_id]) );
                } ,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['keyboard-pwd/view', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['keyboard-pwd/update', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['keyboard-pwd/delete', 'id' => $model->id, ['data' =>
                                [
                                'confirm' => "Are you sure you want to delete keyboard passcode?",
                                'method' => 'DELETE',
                            ], ]
                                ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
