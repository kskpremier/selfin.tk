<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FaceComparation */

$this->title = $model->origin_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Face Comparations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-comparation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'origin_id' => $model->origin_id, 'face_id' => $model->face_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'origin_id' => $model->origin_id, 'face_id' => $model->face_id], [
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
            'origin_id',
            'face_id',
            'probability',
            'created_at',
        ],
    ]) ?>

</div>
