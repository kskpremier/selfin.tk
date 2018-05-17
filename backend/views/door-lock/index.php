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
            ['attribute' => 'lock_alias',
                'label'=> 'Door lock',
                 'format'=>'raw',
                'value'=> function($model) {
                        return HTML::a($model->lock_alias, Url::to(['door-lock/view', 'id' => $model->id]));
                } ,
            ],
            ['attribute' => 'lock_name',
                'label'=> 'Model',],

           'lock_mac',

            [
                'attribute'=>'owner',
                'label'=>'Owner',
                'format'=>'raw',
                'value'=> function($model) {
                    if ($model->user_id) {
                        return HTML::a($model->user->username, Url::to(['user/view', 'id' => $model->user_id]));
                    }
                    else return HTML::tag('span','unset',['class'=>'danger']);
                } ,
            ],
            ['attribute'=>'apartmentName',
                'label'=>'Apartment',

                'format'=>'raw',
                'value'=> function($model) {
                    $names ='';
                    foreach ($model->apartments as $apartment)
                    {
                        $names.= HTML::a($apartment->name. ' ', Url::to(['apartment/view', 'id' => $apartment->id]));
                    }

                    return ($names=='')?HTML::tag('span','-',['class'=>'danger']): $names;
                } ,
                ],

            [   'class' => 'yii\grid\ActionColumn',
                'template' => '{key} {pin} {install} {delete}',
                'buttons' => [
                    'key' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>',
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
                            ['door-lock/install', 'lock' => $model->id ],
                            ['class' => '',
                                'title'=>'Install into Apartment']
                        );
                    },
                ],
            ],
        ],

    ]); ?>
</div>
