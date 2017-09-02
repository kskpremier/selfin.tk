<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoRealFace */

$this->title = 'Update Photo Real Face: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo Real Faces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="photo-real-face-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
