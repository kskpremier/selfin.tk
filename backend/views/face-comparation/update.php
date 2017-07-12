<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FaceComparation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Face Comparation',
]) . $model->origin_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Face Comparations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->origin_id, 'url' => ['view', 'origin_id' => $model->origin_id, 'face_id' => $model->face_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="face-comparation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
