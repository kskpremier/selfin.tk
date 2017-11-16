<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use reception\helpers\TTLHelper;

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
//                    return ($model->type == '2')? 'Permanent': 'Period';
                    return TTLHelper::getKeyTypeName($model->type);
                }],
            ['attribute'=>'start_date',
                'value'=>function($model){
                    return ($model->start_date)?date('Y-m-d H:i',$model->start_date):'-';
                }],
            ['attribute'=>'end_date',
                'value'=>function($model) {
                    return ($model->end_date) ? date('Y-m-d H:i', $model->end_date) : '-';
                }],
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
                    return HTML::a($model->doorLock->lock_alias, Url::to(['door-lock/view', 'id'=>$model->door_lock_id]) );
                } ,
            ],
            ['attribute'=>'username',
            'label'=>'Guest/User',
            'format'=>'raw',
            'value'=> function($model) {
                if ($model->user_id) {
                    return HTML::a($model->user->username, Url::to(['key/index', 'userId' => $model->user_id]));
                }
                else return HTML::tag('span','not set',['class'=>'danger']);
            } ,
                ]
        ],

    ]); ?>

</div>
