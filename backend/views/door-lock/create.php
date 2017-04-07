<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */

$this->title = 'Create Door Lock';
$this->params['breadcrumbs'][] = ['label' => 'Door Locks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="door-lock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
