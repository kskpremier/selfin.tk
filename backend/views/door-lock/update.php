<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */

$this->title = 'Update Door Lock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Door Locks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="door-lock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
