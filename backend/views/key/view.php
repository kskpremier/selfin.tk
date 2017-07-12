<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Key */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Keys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute'=>'type',
                'value'=>function($model){
                    return ($model->type == '2')? 'Permanent': 'Period';
                }],
            ['attribute'=>'start_date',
                'value'=>function($model){
                    return ($model->start_date)?date('Y-m-d H:i',$model->start_date):'-';
                }],
            ['attribute'=>'end_date',
                'value'=>function($model) {
                    return ($model->end_date) ? date('Y-m-d H:i', $model->end_date) : '-';
                }],
//            'pin',
//            'e_key',
            'booking_id',
            'email',
        ],
    ]) ?>

</div>
