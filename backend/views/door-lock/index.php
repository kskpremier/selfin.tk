<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'admin_pin',
            'type',
            'apartment_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {key} {pin}',
                'buttons' => [
                    'key' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-phone"></span>',
                            ['key/index', 'door_lock_id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'pin' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-th"></span>',
                            ['keyboard-pwd/create', 'booking_id' => $model->id ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],

    ]); ?>
</div>
