<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
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

        <?= Html::a(Yii::t('app', 'SendByEmail'), ['send-email'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'value',
            //'id',
//            ['attribute'=>'keyboard_pwd_id',
//              'label'=> 'Id'],
            ['attribute'=>'start_date',
                'value'=>function($model){
                    return ($model->start_date)?date('Y-m-d H:i',$model->start_date):'-';
            }],
            ['attribute'=>'end_date',
                'value'=>function($model) {
                    return ($model->end_date) ? date('Y-m-d H:i', $model->end_date) : '-';
                }],

            [
                'attribute'=>'doorLockName',
                'label'=>'Door lock',
                'format'=>'raw',
                'value'=> function($model) {
                    return HTML::a($model->doorLock->lock_alias, Url::to(['door-lock/view', 'id'=>$model->door_lock_id]) );
                } ,
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
            ['attribute'=>'keyboard_pwd_type',
                'value'=>function($model){
                    return ($model->keyboard_pwd_type == 2)? 'Permanent': 'Period';
                },
                'label'=> 'Type'],

//            'keyboard_pwd_version',
        ],
    ]) ?>

</div>
