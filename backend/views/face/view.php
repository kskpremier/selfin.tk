<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Face */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-view">

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
            'face_id',
            'x',
            'y',
            'width',
            'angle',
            ['attribute'=>'file_name',
                'format' => 'raw',
                'value'=>function($model) {

                       // return Html::img($model->getImageFileUrl('file_name'));
                     return Html::a( Html::img($model->getThumbFileUrl('file_name', 'thumb')), $model->getImageFileUrl('file_name'), ['class' => 'thumbnail', 'target' => '_blank']  );

                },
                'label'=>'Preview']
        ],
    ]) ?>

</div>
