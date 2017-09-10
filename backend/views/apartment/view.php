<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Apartment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-view">

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
            'location',
            'name',
            'external_id',
            ['attribute'=>'owner_id',
                'value' => $model->owner->user->username,
                'label'=>'Owner'],
            ['attribute'=>'doorLocks',
                'label'=>'Door Lock on object',
                'format'=>'raw',
                'value'=> function ($model) {
                    $doorLockList='';
                    foreach ($model->doorLocks as $doorLock){
                        $doorLockList .= '<p>'.Html::a($doorLock->lock_alias,
                                ['door-lock/view', 'id' => $doorLock->id],
                                ['class' => '']). PHP_EOL.'</p>';
                    }
                    return $doorLockList;
                },]
            
        ],
    ]) ?>

</div>
