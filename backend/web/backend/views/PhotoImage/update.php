<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoImage */

$this->title = 'Update Photo Image: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="photo-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
