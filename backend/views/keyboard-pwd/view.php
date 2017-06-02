<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KeyboardPwd */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Keyboard Pwds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyboard-pwd-view">

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
            'keyboard_pwd_id',
            ['attribute'=>'start_day',
                'value'=>function($model){
                    return ($model->start_day)?date('Y-m-d H:i',$model->start_day):'-';
            }],
            ['attribute'=>'end_day',
                'value'=>function($model) {
                    return ($model->end_day) ? date('Y-m-d H:i', $model->end_day) : '-';
                }],
            'value',
            'door_lock_id',
            'booking_id',
            ['attribute'=>'keyboard_pwd_type',
                'value'=>function($model){
                    return ($model->keyboard_pwd_type == 2)? 'Permanent': 'Period';
                }],
            'keyboard_pwd_version',
        ],
    ]) ?>

</div>
