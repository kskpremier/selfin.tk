<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DoorLockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Door Locks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="door-lock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Door Lock'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lock_name',
            'lock_mac',
            'lock_alias',

            // 'type',
            ['attribute'=>'apartmentName',
                'label'=>'Apartment',

                'format'=>'raw',
                'value'=> function($model) {
                    if ($model->apartment_id) {
                        return HTML::a($model->apartment->name, Url::to(['apartment/view', 'id' => $model->apartment_id]));
                    }
                    else return HTML::tag('span','-',['class'=>'danger']);
                } ,
            ],


            [   //'label'=>'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {key} {pin} {install}',
                'buttons' => [
                    'key' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-phone"></span>',
                            ['key/create-for-door-lock', 'doorLockId' => $model->id ],
                            ['class' => '',
                                'title'=>'Send E-key for guest']
                        );
                    },
                    'pin' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-th"></span>',
                            ['keyboard-pwd/create', 'doorLockId' => $model->id ],
                            ['class' => '',
                                'title'=>'Get Keyboard password']
                        );
                    },
                    'install' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-home"></span>',
                            ['door-lock/install', 'id' => $model->id ],
                            ['class' => '',
                                'title'=>'Install into Apartment']
                        );
                    },
                ],
            ],
        ],

    ]); ?>
</div>
