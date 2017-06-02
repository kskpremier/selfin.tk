<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?php // echo Html::a(Yii::t('app', 'Create Keyboard Pwd'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'start_day',
                'value'=> function($model){
                    return ($model->start_day == 0)? '-': date('Y-m-d H:i:s', $model->start_day);
                }
            ],
            ['attribute'=>'end_day',
                'value'=> function($model){
                    return ($model->end_day == 0)? '-': date('Y-m-d H:i:s', $model->end_day);
                },

            ],

            'value',
            ['attribute'=>'keyboard_pwd_type',
                'value'=>function($model){
                    $value = '-';
                    switch($model->keyboard_pwd_type){
                        case 2:  $value = 'Permanent';
                            break;
                        case 1: $value = 'One-time';
                            break;
                        case 3: $value = 'Period';
                            break;
                        case 5: $value = 'Cycle';
                            break;
                    }
                    return $value ;
                }],



            // 'keyboard_pwd_version',
             'door_lock_id',
             'booking_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['keyboard-pwd/view', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['keyboard-pwd/delete', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
